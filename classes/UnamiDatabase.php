<?php /** @noinspection SqlResolve */
/* SQL STATEMENTS USED

CREATE TABLE applicant
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
class UnamiDatabase
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

    function addApplicant($personalInfo, $accommodations, $notRequired)
    {
        //prepare SQL statement
        $sql = "INSERT INTO applicant(date_submitted, status)
        VALUES (:date_submitted, :status)";

        // save prepared statement
        $statement = $this->_dbh->prepare($sql);

        // assign values
        $rawDate = getdate();
        $date = $rawDate['year'].'-'.$rawDate['mon'].'-'.$rawDate['mday'];
        $status = "submitted";

        // bind params
        $statement->bindParam(':date', $date);
        $statement->bindParam(':status', $status);

        // execute insert into users
        $statement->execute();

        $lastID = $this->_dbh->lastInsertId();
        $this->addPersonalInfo($personalInfo, $lastID);
    }

    function addPersonalInfo($personalInfo, $ID)
    {
        // prepare sql statement
        $sql = "INSERT INTO users(applicant_id, fname, lname, pronouns, birthdate, NAMI_member, NAMI_affiliate, address, 
                  city, address2, state, zip, primary_phone, primary_time, alternate_phone, alternate_time, email, 
                  preference, emergency_name, emergency_phone)
        VALUES (:applicant_id, :fname, :lname, :pronouns, :birthdate, :NAMI_member, :NAMI_affiliate, :address, 
                  :city, :address2, :state, :zip, :primary_phone, :primary_time, :alternate_phone, :alternate_time, :email, 
                  :preference, :emergency_name, :emergency_phone)";

        // save prepared statement
        $statement = $this->_dbh->prepare($sql);

        // assign values
        $applicant_id = $ID;
        $fname = $personalInfo->getFname();
        $lname = $personalInfo->getLname();
        $pronouns = $personalInfo->getPronouns();
        $birthdate = $personalInfo->getDobMonth() .'/'. $personalInfo->getDobDay() .'/'. $personalInfo->getDobYear();
        if($personalInfo->getMember() == 'yes')
        {
            $NAMI_member = true;
        }
        else
        {
            $NAMI_member = false;
        }
        $NAMI_affiliate = $personalInfo->getAffiliate();
        $address = $personalInfo->getAddress();
        $city = $personalInfo->getCity();
        $address2 = $personalInfo->getAddress2();
        $state = $personalInfo->getState();
        $zip = $personalInfo->getZip();
        $primary_phone = $personalInfo->getPrimaryPhone();
        $primary_time = $personalInfo->getPrimaryTime();
        $alternate_phone = $personalInfo->getAlternatePhone();
        $alternate_time =$personalInfo->getAlternateTime();
        $email = $personalInfo->getEmail();
        $preference = $personalInfo->getPreference();
        $emergency_name = $personalInfo->getEmergencyName();
        $emergency_phone = $personalInfo->getEmergencyPhone();

        // bind params
        $statement->bindParam(':applicant_id', $applicant_id, PDO::PARAM_INT);
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
        $statement->bindParam(':pronouns', $pronouns, PDO::PARAM_STR);
        $statement->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
        $statement->bindParam(':NAMI_member', $NAMI_member);
        $statement->bindParam(':NAMI_affiliate', $NAMI_affiliate, PDO::PARAM_STR);
        $statement->bindParam(':address', $address, PDO::PARAM_STR);
        $statement->bindParam(':city', $city, PDO::PARAM_STR);
        $statement->bindParam(':address2', $address2, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':zip', $zip, PDO::PARAM_STR);
        $statement->bindParam(':primary_phone', $primary_phone, PDO::PARAM_STR);
        $statement->bindParam(':primary_time', $primary_time, PDO::PARAM_STR);
        $statement->bindParam(':alternate_phone', $alternate_phone, PDO::PARAM_STR);
        $statement->bindParam(':alternate_time', $alternate_time, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':preference', $preference, PDO::PARAM_STR);
        $statement->bindParam(':emergency_name', $emergency_name, PDO::PARAM_STR);
        $statement->bindParam(':emergency_phone', $emergency_phone, PDO::PARAM_STR);

        // execute insert into users
        $statement->execute();
    }
}