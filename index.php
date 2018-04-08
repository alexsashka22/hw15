<?php
header ("Content-Type: text/html; charset=utf-8");

include_once 'config.php';

$sql = "SHOW TABLES";
$stm = $pdo->prepare($sql);
$stm->execute();

$tables = [];
$tableList = $stm->fetchAll();
foreach ($tableList as $item) {
    $tables[] = $item[0];
}

$table = null;
if (!empty($_POST['table'])) {
    $sql = "DESCRIBE " . $_POST['table'];
    $stm = $pdo->prepare($sql);
    $stm->execute();

    $table = $stm->fetchAll();
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Работа с таблицами</title>
    <style>
        table {
            border-spacing: 0;
            border-collapse: collapse;
        }

        table td, table th {
            border: 1px solid #ccc;
            padding: 5px;
        }

        table th {
            background: #eee;
        }

        form {
            margin: 0;
        }
    </style>
  </head>
  <body>
    <h1>Содержание таблиц в базе данных:</h1>
    <div style="margin-bottom: 20px;">
        <form method="POST">
            <label for="table">Выберите таблицу:</label>
            <select name="table">
                <?php foreach ($tables as $key => $item): ?>
                    <option value="<?php echo $item?>"><?php echo $item?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Показать таблицу" />
        </form>
    </div>
    <div style="clear: both"></div>
    <table>
        <tr>
            <th>Поле</th>
            <th>Тип данных</th>
        </tr>
    <?php if (!empty($table)): ?>
    <?php foreach ($table as $row): ?>
    <tr>
      <td><?php echo $row['Field']; ?></td>
      <td><?php echo $row['Type']; ?></td>
    </tr>
  <?php endforeach; ?>
<?php endif; ?>
    </table>

    <p><a href="create.php">Создать таблицу</a></p>
  </body>
</html>
