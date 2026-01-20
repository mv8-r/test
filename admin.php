<?php
require "config.php";

if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit;
}

$videos = [];
if (file_exists($data_file)) {
  $videos = json_decode(file_get_contents($data_file), true);
}

usort($videos, function($a, $b) {
  return $b["time"] - $a["time"];
});
?>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>لوحة التحكم</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h1>لوحة تحكم سكسي عراقي 😈</h1>
<div class="container">

<form action="upload.php" method="post" enctype="multipart/form-data">
  <input type="file" name="video" required>
  <textarea name="desc" placeholder="وصف الفيديو"></textarea>
  <input type="text" name="comment" placeholder="تعليق جوه الفيديو">
  <button type="submit">نشر فيديو 🔥</button>
</form>

<hr>

<?php foreach($videos as $v): ?>
  <div class="video-card">
    <video controls>
      <source src="videos/<?php echo htmlspecialchars($v["file"]); ?>">
    </video>
    <div class="comment"><?php echo htmlspecialchars($v["comment"]); ?></div>
    <div class="desc"><?php echo htmlspecialchars($v["desc"]); ?></div>
    <a href="edit.php?id=<?php echo $v["id"]; ?>">✏️ تعديل</a> |
    <a href="delete.php?id=<?php echo $v["id"]; ?>" onclick="return confirm('تحذف الفيديو؟');">🗑 حذف</a>
  </div>
<?php endforeach; ?>

<p><a href="logout.php">تسجيل خروج</a></p>

</div>
</body>
</html>