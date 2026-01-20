<?php
require "config.php";

if (!isset($_SESSION["admin"])) {
  die("ممنوع الدخول");
}

$id = $_GET["id"] ?? "";

$videos = json_decode(file_get_contents($data_file), true);

$new = [];
foreach ($videos as $v) {
  if ($v["id"] === $id) {
    if (file_exists($upload_dir . $v["file"])) {
      unlink($upload_dir . $v["file"]);
    }
  } else {
    $new[] = $v;
  }
}

file_put_contents($data_file, json_encode($new, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
header("Location: admin.php");
exit;