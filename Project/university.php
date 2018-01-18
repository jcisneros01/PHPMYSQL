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
<head>
<head>
<html>
<body>

<!-- Students-->
 <div>
 	<strong>Students</strong>
	<table>
		<tr>
			<td>First Name</td>
			<td>Last Name</td>
 			<td>Major</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT id, firstName, lastName, major FROM student"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $firstName, $lastName, $major)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $firstName . "\n</td>\n<td>\n" . $lastName . "\n</td>\n<td>\n" . $major . "\n</td>\n<td>\n" ."\n</td>\n<td><a href=\"delete.php?id=". $id ."\">Withdraw</a></td>" . "\n</td>\n<td>\n" ."\n</td>\n<td><a href=\"updatestudent.php?id=". $id ."\">Update</a></td></tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="addstudent.php"> 
		<fieldset>
			<legend>Add Student</legend>
			<p>First Name: <input type="text" name="firstName" /></p>
			<p>Last Name: <input type="text" name="lastName" /></p>
			<p>Major: <input type="text" name="major" /></p>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<!-- department -->
<div>
 	<strong>Departments</strong>
	<table>
	
<?php
if(!($stmt = $mysqli->prepare("SELECT departmentName FROM department"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($departmentName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $departmentName . "\n</td></tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<div>
		<form method="post" action="adddepartment.php"> 
			<fieldset>
				<legend>Add Department</legend>
				<p>Name: <input type="text" name="departmentName" /></p>
			</fieldset>
			<p><input type="submit" /></p>
		</form>
	</div>
</div>

<!-- instructors-->
 <div>
 	<strong>Instructors</strong>
	<table>
		<tr>
			<td>First Name</td>
			<td>Last Name</td>
		</tr>
<?php
if(!($stmt = $mysqli->prepare("SELECT firstName, lastName FROM instructor"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($firstName, $lastName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $firstName . "\n</td>\n<td>\n" . $lastName . "\n</td></tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="addinstructor.php"> 
		<fieldset>
			<legend>Add Instructor</legend>
			<p>First Name: <input type="text" name="firstName" /></p>
			<p>Last Name: <input type="text" name="lastName" /></p>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<!-- courses-->
 <div>
 	<strong>Courses</strong>
	<table>
		<tr>
			<td>Name</td>
			<td>Insructor</td>
			<td>Credits</td>
			<td>Term</td>
			<td>Department</td>
		</tr>
<?php

if(!($stmt = $mysqli->prepare('SELECT table1.courseName, table2.instructor, table1.credits, table1.term, table1.departmentName FROM
(SELECT courseName, instructor, credits, term, departmentName FROM course 
INNER JOIN department ON course.department = department.id) as table1
INNER JOIN (SELECT id, CONCAT_WS(" ", firstName, lastName) AS instructor FROM instructor) as table2 ON table1.instructor = table2.id'))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($courseName, $instructor, $credits, $term, $departmentName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $courseName . "\n</td>\n<td>\n" . $instructor . "\n</td>\n<td>\n" . $credits . "\n</td>\n<td>\n" . $term . "\n</td>\n<td>\n" . $departmentName   . "\n</td></tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="addcourse.php"> 
		<fieldset>
			<legend>Add Course</legend>
			<p>Name: <input type="text" name="courseName" /></p>
			<p>Instructor: <select name="instructor">
							<?php
							if(!($stmt = $mysqli->prepare('SELECT id, CONCAT_WS(" ", firstName, lastName) AS instructor FROM instructor'))){
								echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
							}

							if(!$stmt->execute()){
								echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							if(!$stmt->bind_result($instructorId, $instructor)){
								echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while($stmt->fetch()){
							 echo '<option value=" '. $instructorId . ' "> ' . $instructor . '</option>\n';
							}
							$stmt->close();
							?>
						</select></p>
			<p>Credits: <input type="number" name="credits" /></p>
			<p>Term: <input type="text" name="term" /></p>
 			<p>Department: <select name="departmentName">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT id, departmentName FROM department"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($departmentId, $departmentName)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo '<option value=" '. $departmentId . ' "> ' . $departmentName . '</option>\n';
				}
				$stmt->close();
				?>
			</select></p>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<!-- Course Enrollment-->
 <div>
 	<strong>Course Enrollment</strong>
	<table>
		<tr>
			<td>Student</td>
			<td>Course</td>
		</tr>
<?php

if(!($stmt = $mysqli->prepare('SELECT table1.student, table2.courseName, table1.id, table2.id FROM studentcourse
INNER JOIN (SELECT id, CONCAT_WS(" ", firstName, lastName) AS student FROM student
) AS table1 ON studentcourse.studentId = table1.id
INNER JOIN (SELECT id, courseName FROM course
) AS table2 on studentcourse.courseId = table2.id'))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($student, $course, $studentId, $courseId)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $student . "\n</td>\n<td>\n" . $course  ."\n</td>\n<td><a href=\"unenrollstudent.php?studentId=". $studentId ."&courseId=" . $courseId ."\">Unenroll</a></td>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="enrollstudent.php"> 
		<fieldset>
			<legend>Enroll Student in Course</legend>
 				<p>Student: <select name="studentId">
				<?php
				if(!($stmt = $mysqli->prepare('SELECT id, CONCAT_WS(" ", firstName, lastName) AS student FROM student'))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($studentId, $student)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo '<option value=" '. $studentId . ' "> ' . $student . '</option>\n';
				}
				$stmt->close();
				?>
			</select></p>
			<p>Course: <select name="courseId">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT id, courseName FROM course"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($studentId, $courseName)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo '<option value=" '. $studentId . ' "> ' . $courseName . '</option>\n';
				}
				$stmt->close();
				?>
			</select></p>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

<!-- filter student-->
<div>
	<form method="post" action="filter.php">
		<fieldset>
			<legend>Get Student's Schedule</legend>
				<p>Student: <select name="studentId">
				<?php
				if(!($stmt = $mysqli->prepare('SELECT id, CONCAT_WS(" ", firstName, lastName) AS student FROM student'))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($studentId, $student)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo '<option value=" '. $studentId . ' "> ' . $student . '</option>\n';
				}
				$stmt->close();
				?>
			</select></p>
		</fieldset>
		<input type="submit" value="Run Filter"/>
	</form>
</div> 

<!--  Academic Assignments-->
 <div>
 	<strong>Academic Assignments</strong>
	<table>
		<tr>
			<td>Instructor</td>
			<td>Department</td>
		</tr>
<?php

if(!($stmt = $mysqli->prepare('SELECT table1.instructor, table2.departmentName FROM instructordepartment
INNER JOIN (SELECT id, CONCAT_WS(" ", firstName, lastName) AS instructor FROM instructor
) AS table1 ON instructordepartment.instructorId = table1.id
INNER JOIN (SELECT id, departmentName FROM department
) AS table2 on instructordepartment.departmentId = table2.id'))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($instructorId, $departmentId)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $instructorId . "\n</td>\n<td>\n" . $departmentId . "\n</td></tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="assigninstructor.php"> 
		<fieldset>
			<legend>Assign Instructor</legend>
 				<p>Instructor: <select name="instructorId">
				<?php
				if(!($stmt = $mysqli->prepare('SELECT id, CONCAT_WS(" ", firstName, lastName) AS instructor FROM instructor'))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($instructorId, $instructor)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo '<option value=" '. $instructorId . ' "> ' . $instructor . '</option>\n';
				}
				$stmt->close();
				?>
			</select></p>
			<p>Department: <select name="departmentId">
				<?php
				if(!($stmt = $mysqli->prepare("SELECT id, departmentName FROM department"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($departmentId, $departmentName)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
				 echo '<option value=" '. $departmentId . ' "> ' . $departmentName . '</option>\n';
				}
				$stmt->close();
				?>
			</select></p>
		</fieldset>
		<p><input type="submit" /></p>
	</form>
</div>

</body>
</html>