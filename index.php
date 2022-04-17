<?php

$username = $password = "";
$dbname = "formation";

function checkCredentials($username, $password) {
    // Create connection
    $dbname = "formation";
    $conn = new mysqli("localhost", "root", "", $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT username, password FROM user WHERE username = '" . $username . "' AND password = '" . $password . "'";
    $result = $conn->query($sql);

    $ret = false;
    if ($result->num_rows > 0) {
        $ret = true;
    }
    $conn->close();
    return $ret;  
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (checkCredentials($_POST["username"], $_POST["password"])) {
        print "Logged in successfully";
    } else {
        print "Invalid username / password";
    }
} else {
    print "
    <html>
    <body>
    
        <form method=\"post\" action=\"".$_SERVER['PHP_SELF']."\">
            Username: <input type=\"text\" name=\"username\" /><br/>
            Password: <input type=\"password\" name=\"password\" /><br/>
            <input type=\"submit\" />
        </form>
    </body>
    </html>
    ";
}

?>
