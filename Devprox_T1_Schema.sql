DROP DATABASE IF EXISTS devprox_db;
CREATE DATABASE devprox_db;
USE devprox_db;

CREATE TABLE user
(
	name varchar(20) NOT NULL,
	surname varchar(20) NOT NULL,
    id_number varchar(13) ,
    date_of_birth varchar(10) NOT NULL,
    PRIMARY KEY(id_number)
)
ENGINE=InnoDB;