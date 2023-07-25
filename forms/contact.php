<?php

include '../function.php';

if (db_insert('kontak', [
  'nama' => $_POST['nama'],
  'email' => $_POST['email'],
  'judul' => $_POST['judul'],
  'pesan' => $_POST['pesan'],
])) {
  echo 'OK';
} else {
  echo 'Gagal mengirim pesan';
}
