/*
    This php code check whether the database exists or not.
*/

<?php

$con = mysqli_connect("localhost","root","12345","database-twitter");

if(!$con)
{
    die("Not connected");
}

?>