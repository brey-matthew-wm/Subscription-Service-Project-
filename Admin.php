<?php
require_once ('Authorize.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Guitar Wars - High Scores Administration</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<h2>Top Speeds Admin</h2>
<p>Here's all the top speeds, remove the spammers plz</p>
<hr />

<?php
require_once('Connect.php');

//Select Info from database
$stmt = $dbh->prepare("SELECT * FROM topspeed ORDER BY score DESC");
$stmt->execute();
$Result = $stmt->fetchAll();

echo '<table>';
foreach ($Result as $row) {
    echo '<tr class="scorerow"><td><strong>' . $row['name'] . '</strong></td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['score'] . '</td>';
    echo '<td><a href="RemoveScore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] . '&amp;name=' . $row['name'] . '&amp;score=' . $row['score'] . '&amp;screenshot=' . $row['screenshot'] . '">Remove</a></td></tr>';
}
echo '</table>';
?>
</body>
</html>
