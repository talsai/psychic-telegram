<?php

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db); //Connect DB
$id = $_GET['id'];
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()); // Check connection
  }

//Create query based on the ID passed from table
// sql to update a record
$sql = "UPDATE all_contacts SET status='Approved' WHERE id = '$id'"; //query : update where id = $id

$url = 'https://stage-tms.govdelivery.com/messages/email';
$data = array(
  "subject" => "Hello!",
  "body" => "hi",
  "recipients" => array (
    "email" => "talal.said@granicus.com")
  );
$data_string = json_encode($data);
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "X-AUTH-TOKEN: xxxxx",
    "Content-Length: ". strlen($data_string)));


$result = curl_exec($ch);
echo $result;
print_r(curl_getinfo($ch));
curl_close($ch);

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header("Location: dashboard.php"); // on success delete : redirect the page to original page using header() method
    exit;
} else {
    echo "Error changing status";
}

?>
