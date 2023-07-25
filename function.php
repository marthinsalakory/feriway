<?php

if (!session_id()) session_start();
date_default_timezone_set('Asia/Jayapura');
setlocale(LC_ALL, 'id_ID');

function db_conn()
{
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'feriway';

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    return $conn;
}


$SCRIPT_FILENAME = explode('/', $_SERVER['SCRIPT_FILENAME']);
$FILENAME = explode('.', end($SCRIPT_FILENAME))[0];

function navon($nav)
{
    $SCRIPT_FILENAME = explode('/', $_SERVER['SCRIPT_FILENAME']);
    $FILENAME = explode('.', end($SCRIPT_FILENAME));
    if ($FILENAME[0] == $nav) {
        return 'active';
    }
}

function db_query($query)
{
    return mysqli_query(db_conn(), $query);
}

function db_insert($table, $array = [])
{
    $keys = array_keys($array);
    $columns = implode('`, `', $keys);
    $values = implode('\', \'', $array);
    $query = "INSERT INTO `$table` (`$columns`) VALUES ('$values')";
    return db_query($query);
}


function db_update($table, $array1, $array2)
{
    $conditions = [];
    foreach ($array1 as $k => $v) {
        $conditions[] = "`$k`='$v'";
    }
    $conditionString = implode(' AND ', $conditions);

    $updates = [];
    foreach ($array2 as $k => $v) {
        $updates[] = "`$k`='$v'";
    }
    $updateString = implode(', ', $updates);

    return db_query("UPDATE `$table` SET $updateString WHERE $conditionString");
}


function db_delete($table, $array)
{
    $conditions = array();
    foreach ($array as $key => $val) {
        $conditions[] = "$key = '$val'";
    }
    $query = "DELETE FROM `$table` WHERE " . implode(' AND ', $conditions);
    return db_query($query);
}


function setFlash($pesan)
{
    $_SESSION['flash'][] = ucfirst($pesan);
}


function flash()
{
    if (isset($_SESSION['flash'])) {
        $pesan = '';
        foreach ($_SESSION['flash'] as $flash) {
            $pesan = $pesan . '<li>' . $flash . '</li>';
        }
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Perhatian!</strong>
            <ul>
                ' . $pesan . '
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['flash']);
    }
}

function isFlash()
{
    if (isset($_SESSION['flash'])) {
        return true;
    }
    return false;
}

function db_findAll($table, $array = [])
{
    if (empty($array)) {
        return db_query("SELECT * FROM $table");
    } else {
        $conditions = [];
        foreach ($array as $key => $val) {
            $conditions[] = "$key = '$val'";
        }
        $conditionString = implode(' && ', $conditions);
        return db_query("SELECT * FROM $table WHERE $conditionString");
    }
}


function db_find($table, $where)
{
    $conditions = [];
    foreach ($where as $key => $val) {
        $conditions[] = "$key = '$val'";
    }
    $conditionString = implode(' AND ', $conditions);
    $query = "SELECT * FROM `$table` WHERE $conditionString";
    $result = db_query($query);
    return $result->fetch_object();
}


function db_findOr($table, $where)
{
    $conditions = [];
    foreach ($where as $key => $val) {
        $conditions[] = "$key = '$val'";
    }
    $conditionString = implode(' OR ', $conditions);
    $query = "SELECT * FROM `$table` WHERE $conditionString";
    $result = db_query($query);
    return $result->fetch_object();
}


function db_count($table, $array = null)
{
    $result = '';
    if ($array != null) {
        $conditions = [];
        foreach ($array as $key => $val) {
            $conditions[] = "$key = '$val'";
        }
        $result = implode(' AND ', $conditions);
    } else {
        $result = '1';
    }
    $query = "SELECT COUNT(*) as count FROM `$table` WHERE $result";
    $result = db_query($query);
    $row = $result->fetch_assoc();
    return $row['count'];
}


function redirect($link)
{
    header("Location: $link");
    exit;
}

function redirectBack()
{
    redirect($_SERVER["HTTP_REFERER"]);
}

function old($key)
{
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return false;
}

function ubahHari($hari)
{
    $hari = strtolower($hari);
    $daftarHari = array(
        'monday' => 'Senin',
        'tuesday' => 'Selasa',
        'wednesday' => 'Rabu',
        'thursday' => 'Kamis',
        'friday' => 'Jumat',
        'saturday' => 'Sabtu',
        'sunday' => 'Minggu'
    );

    if (array_key_exists($hari, $daftarHari)) {
        return $daftarHari[$hari];
    } else {
        return 'Hari tidak valid';
    }
}

function isLogin()
{
    if (isset($_SESSION['login_maedonor'])) {
        redirect('admin');
    }
}
