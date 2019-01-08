<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db); //Connect DB
$id = $_GET['id'];
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); // Check connection
  }

//Create query based on the ID passed from table
// sql to delete a record
$sql = "DELETE FROM all_contacts WHERE id = '$id'"; //query : delete where id = $id

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header("Location: dashboard.php"); // on success delete : redirect the page to original page using header() method
    exit;
} else {
    echo "Error deleting record";
}

?>
