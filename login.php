<?php
require "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $u = $_POST["username"] ?? "";
  $p = $_POST["password"] ?? "";

  if (isset($admins[$u]) && $admins[$u] === $p) {
    $_SESSION["admin"] = $u;
    header("Location: admin.php");
    exit;
  } else {
    $error = "يوزر أو باسورد غلط 😈";
  }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>تسجيل دخول الأدمن</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<h1>لوحة الشيطان 🔥</h1>
<div class="container">
  <form method="post">
    <input type="text" name="username" placeholder="اسم المستخدم">
    <input type="password" name="password" placeholder="كلمة المرور">
    <button type="submit">دخول</button>
  </form>
  <p style="color:red;"><?php echo $error; ?></p>
</div>
</body>
</html>