<?php

include("/xampp/htdocs/EmpCrud/db/dbconnection.php");

$username = $_POST['username'];
$password = $_POST['password'];

if ($username == 'admin' && $password == "1234") {
    echo "<script>window.location.href='viewData.php' </script>";
}
else
{
    echo "<h2>Login Failed..!</h2>";
}

?>