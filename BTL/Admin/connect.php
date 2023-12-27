
<?php
    $servername = "localhost";
    $username = "root";
    $passwork = ""; //không có pass
    $db = "docsach";
    //Crearte connection
    $conn = new mysqli($servername, $username, $passwork, $db);
    //Check connection
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }
?>
