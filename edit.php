<?php
require "config.php";

if (!isset($_SESSION["admin"])) {
  die("ممنوع الدخول");
}

$id = $_GET["id"] ?? "";
$videos = json_decode(file_get_contents($data_file), true);

$video = null;
foreach ($videos as $v) {
  if ($v["id"] === $id) {
    $video = $v;
    break;
  }
}

if (!$video) die("ما لقيت الفيديو");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  foreach ($videos as &$v) {
    if ($v["id"] === $id) {
      $v["desc"] = $_POST["desc"];
      $v["comment"] = $_POST["comment"];
    }
  }

  file_put_contents($data_file, json_encode($videos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
  header("Location: admin.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>تعديل فيديو</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h1>تعديل الفيديو 🔥</h1>
<div class="container">
  <form method="post">
    <textarea name="desc"><?php echo htmlspecialchars($video["desc"]); ?></textarea>
    <input type="text" name="comment" value="<?php echo htmlspecialchars($video["comment"]); ?>">
    <button type="submit">حفظ التعديل</button>
  </form>
</div>
</body>
</html>