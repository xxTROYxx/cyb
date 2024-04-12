<!DOCTYPE html>
<html>
<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
 if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"])) 
 {
 $email = $_POST["email"];
 $password = $_POST["password"];
 $confirm_password = $_POST["confirm_password"];
 $hash = hash('sha256', $password);

 if ($password !== $confirm_password) 
    {
    echo "Пароли не совпадают!";
    exit;
    }

 include("settings.php");
 $link = mysqli_connect($DB_SERVER, $DB_USER, $DB_PWD, $DB_NAME);
 

 $query = "INSERT INTO logins (Login, PwdHash) VALUES (?, ?)";
 $stmt = mysqli_prepare($link, $query);
 mysqli_stmt_bind_param($stmt, "ss", $email, $hash);
 mysqli_stmt_execute($stmt);
 $result = mysqli_stmt_get_result($stmt);

  $_SESSION["user_id"] = mysqli_insert_id($link);
  header("Location: http://localhost/cyb/login.php");
  exit;
 mysqli_close($link);
 }
}
?>

<h1>Введите ваши данные</h1>
<form action="" method="POST">
<label for="email">Логин</label>
<input name="email">
<label for="password">Придумайте пароль</label>
 <input name="password" type="password">
 <label for="confirm_password">Подтвердите пароль</label>
 <input name="confirm_password" type="password">
 <input type="submit">
</form>

</body>
</html>