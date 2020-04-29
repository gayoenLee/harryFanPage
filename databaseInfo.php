<?
$connection = mysqli_connect("127.0.0.1", "root", "Dldmsgh0607", "imageBoard");
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}


// Selecting a database 

$db_select = mysqli_select_db($connection, "root");
if (!$db_select) {
    die("Database selection failed: " . mysqli_connect_error());
}
?>