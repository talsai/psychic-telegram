<html>
  <head>
    <link rel="stylesheet" type="text/css" href="dashboardstyle.css">
    <title>
      Notification Dashboard
    </title>
  </head>
<body>
  <!--
  <div class="row">
    <th><div class="column"> Name </div></th>
    <th><div class="column"> Contact Information </div></th>
    <th><div class="column"> Status </div></th>
    <th><div class="column"> Action </div></th>
  </div>
  -->

<table>
  <tbody>
    <div class="row">
      <tr>
        <th><div class="column">Name</th>
        <th><div class="column">Contact Information</th>
        <th><div class="column">Application Status</th>
        <th><div class="column">Action</th>
      </tr>
    </div>
<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die("Fatal Error");

$sql = "SELECT * FROM all_contacts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
  $fname = $row["name"];
  $email = $row["contact_information"];
  $status = $row["status"];
  $id = $row["id"];
  ?>
  <tr>
    <td> <?php echo $fname; ?> </td>
    <td> <?php echo $email; ?> </td>
    <td> <?php echo $status; ?> </td>
    <td> <?php echo '<button id="myBtn">Change Status</button>'; ?> </td>
  </tr>
<?php
}
} else {
  echo "It's empty. You have to add people to the database.";
}

$conn->close();
?>
  </tbody>
</table>

<!--The Modal-->
<div id="myModal" class="modal">
  <!--Modal content-->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>
      <?php
      require_once 'login.php';
      $conn = new mysqli($hn, $un, $pw, $db);
      if ($conn->connect_error) die("Fatal Error");

      $sql = "SELECT * FROM all_contacts";
      $result = $conn->query($sql);

      $row = $result->fetch_assoc();
      $status = $row["status"];
      $id = $row["id"];
      echo "<a href='received.php?id=".$id."'>Received</a><br>" . " " . "<a href='processing.php?id=".$id."'>Processing</a><br>" . " " . "<a href='in_review.php?id=".$id."'>In Review</a><br>" . " " . "<a href='approved.php?id=".$id."'>Approved</a><br>" . " " . "<a href='denied.php?id=".$id."'>Denied</a><br>" . " " . "<a href='delete.php?id=".$id."'>Delete</a><br>";

      $conn->close();
      ?>
    </p>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>
