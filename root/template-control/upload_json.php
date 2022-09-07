<?php
include $_SERVER['DOCUMENT_ROOT']."/functions.php";
// echo $_FILES;
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/data/';

$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

$file_url_name = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/data/json_url.json');
$name = json_decode($file_url_name);
$name->URL = basename($_FILES['userfile']['name']);
file_put_contents($_SERVER['DOCUMENT_ROOT'].'/data/json_url.json',json_encode($name,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

?>