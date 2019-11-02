<?php
/* SQL STATEMENTS USED

 * CREATE TABLE applicant
(
	applicant_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	date_submitted DATE NOT NULL,
	status VARCHAR(50) NOT NULL
);

CREATE TABLE personal_info
(
	applicant_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	fname VARCHAR(60) NOT NULL,
	lname VARCHAR(70) NOT NULL,
	pronouns VARCHAR(50) NOT NULL,
	birthdate VARCHAR(10) NOT NULL,
	NAMI_member boolean NOT NULL,
	NAMI_affiliate VARCHAR(50) NOT NULL,
	address VARCHAR(70) NOT NULL,
	city VARCHAR(70) NOT NULL,
	address2 VARCHAR(70),
	state VARCHAR(2) NOT NULL,
	zip VARCHAR(12) NOT NULL,
	primary_phone VARCHAR(15) NOT NULL,
	primary_time VARCHAR(100) NOT NULL,
	alternate_phone VARCHAR(15),
	alternate_time VARCHAR(100),
	email VARCHAR(254) NOT NULL,
	preference VARCHAR(5) NOT NULL,
	emergency_name VARCHAR(120),
	emergency_phone VARCHAR(15)
);

CREATE TABLE accomodations
(
	applicant_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	special_needs boolean NOT NULL,
	service_animal boolean NOT NULL,
	mobility_need boolean NOT NULL,
	need_rooming boolean NOT NULL,
	single_room boolean DEFAULT false,
	days_rooming VARCHAR(200) DEFAULT 'N/A',
	gender VARCHAR(50) DEFAULT 'N/A',
	roommate_gender VARCHAR(50) DEFAULT 'N/A',
	cpap_user boolean DEFAULT false,
	roommate_cpap boolean DEFAULT false
);

CREATE TABLE not_required
(
	applicant_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	heard_about_training MEDIUMTEXT,
	other_classes MEDIUMTEXT,
	certified MEDIUMTEXT
);
 */
$user = $_SERVER['USER'];
require "/home/$user/config_UNAMI.php";

/**
 * Class Database
 * @author Max Lee
 * @version 11/2/2019
 */
class Database
{
    private $_dbh;

    /**
     * Database constructor. connects to the database when made
     * @return void
     */
    function __construct()
    {
        $this->connect();
    }

    /**
     * Connects to the database
     * @return void
     */
    function connect()
    {
        try {
            // Instantiate a db object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
    }


}