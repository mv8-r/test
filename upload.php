<?php
require "config.php";

if (!isset($_SESSION["admin"])) {
  die("ممنوع الدخول 😈");
}

if (!isset($_FILES["video"])) {
  die("ماكو فيديو");
}

$video = $_FILES["video"];
$desc = $_POST["desc"] ?? "";
$comment = $_POST["comment"] ?? "";

$ext = pathinfo($video["name"], PATHINFO_EXTENSION);
$newname = time() . "_" . rand(1000,9999) . "." . $ext;

move_uploaded_file($video["tmp_name"], $upload_dir . $newname);

$videos = [];
if (file_exists($data_file)) {
  $videos = json_decode(file_get_contents($data_file), true);
}

$videos[] = [
  "id" => uniqid(),
  "file" => $newname,
  "desc" => $desc,
  "comment" => $comment,
  "time" => time()
];

file_put_contents($data_file, json_encode($videos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

header("Location: admin.php");
exit;