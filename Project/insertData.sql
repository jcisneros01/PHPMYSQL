INSERT INTO student (firstName, lastName, major) values ("Marc", "Zuckerberg", "Psychology"),("Keith", "Richards", "Music"), ("Steve", "Jobs", "Design"); 

INSERT INTO department (departmentName) values ("Economics"), ("Political Science"), ("Computer Science"), ("Psychology"), ("Mathematics"), ("Business"), ("Transborder Studies");

INSERT INTO instructor (firstName, lastName) values ("Lisa", "Magana"), ("Lawrence", "Mayer"), ("Allan", "DeSerpa");

INSERT INTO 1 (courseName, instructor, credits, term, department) values ("Microeconomics", 3, 3, "Fall", 1), ("Healthcare Economics", 2, 3, "Spring", 1), ("Statistics", 2, 3, "Summer", 5), ("Immigration Politics", 1, 3, "Fall", 2);

INSERT INTO studentcourse (studentId, courseId) values 
(1, 1), (2, 2 ), (3, 3), (1,2);

INSERT INTO instructordepartment (instructorId, departmentId) values (1, 2), (2, 1), (2, 5), (3, 1);

INSERT INTO course (courseName, instructor, credits, term, department) values ("Immigration Politics", 1, 3, "Fall", 2);


