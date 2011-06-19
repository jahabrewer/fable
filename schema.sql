CREATE DATABASE IF NOT EXISTS fable2;

USE fable2

DROP TABLE IF EXISTS cake_sessions;
CREATE TABLE cake_sessions (
	id varchar(255) PRIMARY KEY NOT NULL DEFAULT '',
	data text,
	expires int(11)
);

DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id int PRIMARY KEY AUTO_INCREMENT,
	username varchar(255),
	password char(40),
	user_type_id int,
	first_name varchar(32),
	middle_initial char(1),
	last_name varchar(32),
	email_address varchar(128),
	last_login datetime DEFAULT '0000-00-00 00:00:00',
	school_id int,
	created datetime,
	modified datetime
);

DROP TABLE IF EXISTS absences;
CREATE TABLE absences (
	id int AUTO_INCREMENT PRIMARY KEY,
	absentee_id int,
	fulfiller_id int,
	school_id int,
	room varchar(16),
	start datetime,
	end datetime,
	comment text,
	created datetime,
	modified datetime
);

DROP TABLE IF EXISTS schools;
CREATE TABLE schools (
	id int AUTO_INCREMENT PRIMARY KEY,
	name varchar(256),
	street_address text
);

DROP TABLE IF EXISTS user_types;
CREATE TABLE user_types (
	id int AUTO_INCREMENT PRIMARY KEY,
	name varchar(32)
);

-- the application depends on admin being id 1
INSERT INTO user_types (name) VALUES
	('Admin'),
	('Teacher'),
	('Substitute');
