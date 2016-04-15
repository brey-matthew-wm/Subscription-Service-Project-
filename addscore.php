<!DOCTYPE html>
<html>
<head>
    <title>Top Speed Submit</title>
    <link rel="stylesheet" type="text/css" href="../styles.css" />
</head>

<body>
<h2 id="submithighspeed">Submit Your High Speed Here!!</h2>

<?php
//Establish Connections and Variables
require_once('AppVars.php');
require_once('Connect.php');

if (isset($_POST['submit'])) {
    // Grab the score data from the POST
    $name = $_POST['name'];
    $score = $_POST['score'];
    $screenshot = $_FILES['screenshot']['name'];
    $screenshot_size = $_FILES['screenshot']['size'];
    $screenshot_type = $_FILES['screenshot']['type'];

    if (!empty($name) && !empty($score) && !empty($screenshot)) {

        if ((($screenshot_type == 'image/gif') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/pjpeg') || ($screenshot_type == 'image/png')) && ($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)) {
            $target = GW_UPLOADPATH . $screenshot;
print_r($target);
            if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
                // Write the data to the database ** check (0, NOW(),
                $Query = $dbh->prepare("INSERT INTO topspeed VALUES (0, NOW(), :name, :score, :screenshot, 0)");

                $Result = $Query->execute(
                    array(
                        'name' => $name,
                        'score' => $score,
                        'screenshot' => $screenshot
                    )
                );

                // Confirm success with the user
                echo '<p>Thanks for adding your new high score!</p>';
                echo '<p><strong>Name:</strong> ' . $name . '<br />';
                echo '<strong>Score:</strong> ' . $score . '<br />';
                echo '<img src="' . $target . '" alt="Score image" /></p>'; echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';

                // Clear the score data to clear the form
                $name = "";
                $score = "";
            }

            else {
                echo '<p class="error">There was an error uploading your file to server</p>';
            }
        }

        else {
            echo '<p class="error">The file must be an image and must be under 10 MB.</p>';
        }
    }

    else {
        echo '<p class="error">Please enter all of the information to add your high score.</p>';
    }
}
?>

<hr/>

  <center>  <form id="formyo" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>" />
    <br />

    <label for="score">Score:</label>
    <input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>" />
    <br />
   <label id="screenid" for="screenshot">Screen shot:</label>
    <input type="file" id="screenshot" name="screenshot" />
    <hr />
    <input id="smtbttn" type="submit" value="Add" name="submit" />
</form>
</center>
</body>
</html>
