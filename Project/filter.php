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

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<body>
<div>
	<strong>Student Schedule</strong>
	<table>
		<tr>
			<td>Student</td>
			<td>Course</td>
		</tr>
<?php

if(!($stmt = $mysqli->prepare('SELECT table1.student, table2.courseName FROM studentcourse
INNER JOIN (SELECT id, CONCAT_WS(" ", firstName, lastName) AS student FROM student
) AS table1 ON studentcourse.studentId = table1.id
INNER JOIN (SELECT id, courseName FROM course
) AS table2 on studentcourse.courseId = table2.id WHERE table1.id = ?'))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i",$_POST['studentId']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!$stmt->bind_result($student, $courseName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $student . "\n</td>\n<td>\n" . $courseName . "\n</td></tr>";
}
$stmt->close();
?>
	</table>
</div>

</body>
</html>