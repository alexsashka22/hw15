<?php
header ("Content-Type: text/html; charset=utf-8");

include_once 'config.php';

if (isset($_POST['create'])) {
      $sql = "CREATE TABLE `new one` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(50) NOT NULL,
        `description` text NOT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
      $sth = $pdo->prepare($sql);
      $sth->execute();

      header("Location: index.php", true, 302);
}


 ?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Создание таблицы</title>
  </head>
  <body>
    <h1>Создайте таблицу</h1>

    <form method="post">
      <input type="submit" name="create" value="Создать">
    </form>
  </body>
</html>
