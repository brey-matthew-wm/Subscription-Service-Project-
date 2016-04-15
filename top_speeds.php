
<!DOCTYPE html>
<html>
<head>
    <title>Tops Speeds!</title>
    <link rel="stylesheet" type="text/css" href="../styles.css" />
</head>

<body>

<div id='cssmenu'>
    <ul>

        <li><a href='../index.php'>Home</a></li>
        <li><a href='../gallery.html'>Gallery</a></li>
        <li class='active'><a href='top_speeds.php'>Top Speeds</a></li>
        <li><a href='../about.html'>About Us</a></li>
        <li><a href='../signup.php'>Sign Up</a></li>
    </ul>
</div>

<h2>Top Speed central!</h2>
<p>Welcome to the Top Speed section!</p>
<p>Click here to add your own speed! --> <a href="addscore.php">(Click Here!)</a>   </p>
<p><a href="Admin.php">Admins click here</a> </p>
<hr/>

<?php
//Establish Connections and Variables
require_once('AppVars.php');
require_once('Connect.php');

// Retrieve the score data from MySQL
$Query = $dbh->prepare("SELECT * FROM topspeed ORDER BY score DESC");
$Query->execute();
$Result = $Query->fetchAll();

// Loop through the array of score data, formatting it as HTML
echo '<table>';

$i = 0;

foreach ($Result as $row) {
    $filepath = GW_UPLOADPATH . $row['screenshot'];

    if ($i == 0) {
        echo '<tr><td colspan="2" class="topscoreheader">Top Speed: ' . $row['score'] . '</td></tr>';
    }

    echo '<tr><td class="scoreinfo">';
    echo '<span class="score">' . $row['score'] . '</span><br />';
    echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
    echo '<strong>Date:</strong> ' . $row['date'] . '</td></tr>';

    if (is_file($filepath) && filesize($filepath) > 0) {
        echo'<td><img src="'. $filepath .'"alt="Scoreimage"/></td></tr>';
    }

    else {
        echo '<td><img src="images/unverified.gif" alt="Unverified score" /></td></tr>';
    }
    $i++;
}
echo '</table>';
?>
</body>
</html>