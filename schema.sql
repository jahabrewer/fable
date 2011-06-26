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
	id int unsigned PRIMARY KEY AUTO_INCREMENT,
	username varchar(255),
	password char(40),
	user_type_id int unsigned,
	first_name varchar(32),
	middle_initial char(1),
	last_name varchar(32),
	primary_phone char(12),
	secondary_phone char(12),
	email_address varchar(128),
	education_level_id int unsigned,
	certification date,
	absence_change_notify boolean DEFAULT 0,
	last_login datetime DEFAULT '0000-00-00 00:00:00',
	school_id int unsigned,
	created datetime,
	modified datetime
);

DROP TABLE IF EXISTS absences;
CREATE TABLE absences (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	absentee_id int unsigned,
	fulfiller_id int unsigned,
	school_id int unsigned,
	room varchar(16),
	start datetime,
	end datetime,
	comment text,
	created datetime,
	modified datetime
);

DROP TABLE IF EXISTS schools;
CREATE TABLE schools (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	name varchar(256),
	street_address text
);

DROP TABLE IF EXISTS schools_users;
CREATE TABLE schools_users (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	school_id int,
	user_id int
);

DROP TABLE IF EXISTS user_types;
CREATE TABLE user_types (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	name varchar(32)
);

DROP TABLE IF EXISTS education_levels;
CREATE TABLE education_levels (
	id int unsigned AUTO_INCREMENT PRIMARY KEY,
	name varchar(64)
);

-- the application depends on this ordering
INSERT INTO user_types (name) VALUES
	('Admin'),
	('Teacher'),
	('Substitute');

INSERT INTO education_levels (name) VALUES
	('Some High School'),
	('High School'),
	("Associate's Degree"),
	("Bachelor's Degree"),
	("Master's Degree"),
	('Doctorate');
