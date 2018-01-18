<?php


  DEFINE('DB_USERNAME', 'root');
  DEFINE('DB_PASSWORD', 'root');
  DEFINE('DB_HOST', 'localhost');
  DEFINE('DB_DATABASE', 'cisnejos-db');

  $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

  if (mysqli_connect_error()) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
  }

  // echo 'Connected successfully.';


if(!($stmt = $mysqli->prepare("SELECT id, firstName, lastName, major FROM student WHERE id = ?"))){
  echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_GET['id']))){
  echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
  echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $firstName, $lastName, $major)){
  echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo '<div>
  <form method="post" action="submitupdatestudent.php"> 
    <fieldset>
      <legend>Update Student</legend>
      <input type="hidden" name="id" value ="' . $id . '"/>
      <p>First Name: <input type="text" name="firstName" value ="' . $firstName . '"/></p>
      <p>Last Name: <input type="text" name="lastName" value="' . $lastName . '"/></p>
      <p>Major: <input type="text" name="major" value="' . $major . '"/></p>
    </fieldset>
    <p><input type="submit" /></p>
  </form>
</div>';
}
$stmt->close();
?>
