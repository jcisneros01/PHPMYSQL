-- student table
SELECT firstName, lastName, gpa, major FROM student;

-- department table
SELECT departmentName FROM department;

-- instructor table
SELECT firstName, lastName FROM instructor;

-- course table
SELECT table1.courseName, table2.instructor, table1.credits, table1.term, table1.departmentName FROM
(SELECT courseName, instructor, credits, term, departmentName FROM course 
INNER JOIN department ON course.department = department.id) as table1
INNER JOIN (SELECT id, CONCAT_WS(" ", firstName, lastName) AS instructor FROM instructor) as table2 ON table1.instructor = table2.id;

-- student course
SELECT table1.student, table2.courseName FROM studentcourse
INNER JOIN (SELECT id, CONCAT_WS(" ", firstName, lastName) AS student FROM student
) AS table1 ON studentcourse.studentId = table1.id
INNER JOIN (SELECT id, courseName FROM course
) AS table2 on studentcourse.courseId = table2.id;

-- instructor department
SELECT table1.instructor, table2.departmentName FROM instructordepartment
INNER JOIN (SELECT id, CONCAT_WS(" ", firstName, lastName) AS instructor FROM instructor
) AS table1 ON instructordepartment.instructorId = table1.id
INNER JOIN (SELECT id, departmentName FROM department
) AS table2 on instructordepartment.departmentId = table2.id;



