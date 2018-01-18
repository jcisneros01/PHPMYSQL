CREATE TABLE student (
  id int NOT NULL AUTO_INCREMENT,
  firstName varchar(255) NOT NULL,
  lastName varchar(255) NOT NULL,
  major varchar(255),
  PRIMARY KEY (id)
);

CREATE TABLE department (
id int NOT NULL AUTO_INCREMENT,
departmentName varchar(255) NOT NULL,
PRIMARY Key (id),
UNIQUE (departmentName)
);

CREATE TABLE instructor (
id int NOT NULL AUTO_INCREMENT,
firstName varchar(255) NOT NULL,
lastName varchar(255) NOT NULL,
PRIMARY Key (id)
);

CREATE TABLE course (
id int NOT NULL AUTO_INCREMENT,
courseName varchar(255) NOT NULL,
instructor int,
credits int NOT NULL, 
term varchar(255) NOT NULL, 
department int NOT NULL,
PRIMARY Key (id),
CONSTRAINT FOREIGN KEY(instructor) REFERENCES instructor(id) ON DELETE SET NULL ON UPDATE CASCADE,
CONSTRAINT FOREIGN KEY(department) REFERENCES department(id) ON UPDATE CASCADE
);

CREATE TABLE studentcourse (
  studentId int NOT NULL,
  courseId int NOT NULL,
  PRIMARY KEY (studentId, courseId),
  CONSTRAINT FOREIGN KEY(studentId) REFERENCES student(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY(courseId) REFERENCES course(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE instructordepartment (
  instructorId int NOT NULL,
  departmentId int NOT NULL,
  PRIMARY KEY (instructorId, departmentId),
  CONSTRAINT FOREIGN KEY(instructorId) REFERENCES instructor(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY(departmentId) REFERENCES department(id) ON DELETE CASCADE ON UPDATE CASCADE
);


