CREATE DATABASE prjwebcir2;
USE prjwebcir2;
CREATE USER 'prjwebcir2'@'localhost' IDENTIFIED BY 'userproject';
grant ALL PRIVILEGES ON prjwebcir2.* TO 'prjwebcir2'@'localhost';
FLUSH PRIVILEGES;
