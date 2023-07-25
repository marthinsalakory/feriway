<?php
include 'function.php';

if (isset($_GET['logout'])) {
    unset($_SESSION['login']);
    redirect('index.php');
}

if (isset($_POST['login'])) {
    if (db_count('pengguna', ['username' => $_POST['username'], 'password' => $_POST['password']])) {
        $_SESSION['login'] = db_find('pengguna', ['username' => $_POST['username'], 'password' => $_POST['password']])->id;
        if (db_find('pengguna', ['username' => $_POST['username'], 'password' => $_POST['password']])->level) {
            redirect('admin');
        } else {
            redirectBack();
        }
    } else {
        $_SESSION['error_login'] = "Username / Password Salah";
        redirectBack();
    }
}

if (isset($_POST['register'])) {
    if (db_count('pengguna', ['username' => $_POST['username']])) {
        $_SESSION['error_register'] = "Username sudah terdaftar";
        redirectBack();
    }
    if (db_count('pengguna', ['email' => $_POST['email']])) {
        $_SESSION['error_register'] = "Email sudah terdaftar";
        redirectBack();
    }
    if (db_count('pengguna', ['nomor_telepon' => $_POST['nomor_telepon']])) {
        $_SESSION['error_register'] = "Nomor telepon sudah terdaftar";
        redirectBack();
    }

    if (db_insert('pengguna', [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'level' => 0,
        'nama_lengkap' => $_POST['nama_lengkap'],
        'email' => $_POST['email'],
        'nomor_telepon' => $_POST['nomor_telepon'],
        'status' => 1,
    ])) {
        $_SESSION['login'] = db_find('pengguna', [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        ])->id;
        redirectBack();
    } else {
        $_SESSION['error_register'] = "Gagal mendaftar, silahkan coba lagi.";
        redirectBack();
    }
}


redirectBack();
