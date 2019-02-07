<?php
//we define all the specifics of the webbserver that we use from phpmyadmin
$host = 'localhost';
$dbname = 'lab3';
$user = 'Admin';
$password = 'meme';

//Define variable with attributes for our PDO-object
$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC );
//creates a variable called dsn that defines the swebbserver settings that are used in pdo
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
//Create our new pdo object
$pdo = new PDO($dsn, $user, $password, $attr);

//Tests our connection
if ($pdo) {

//creates a variable called sql and fills it with the info we need from the webbserver
$sql = "SELECT p.Slug, p.Headline, u.Username, p.Creation_time, p.Text FROM posts AS p JOIN users AS u ON p.User_ID = u.ID ORDER BY Creation_time DESC";

    //define $model array
    $model = array();

// Fill our pre defined $model-array
    foreach($pdo->query($sql) as $row) {
        $model += array(
            $row['Slug'] => array(
                'title' => $row['Headline'],
                'author' => $row['Username'],
                'date' => $row['Creation_time'],
                'text' => $row['Text']
            )
        );
    }
}
// error message
else {
    print_r($pdo->errorInfo());
}

?>
