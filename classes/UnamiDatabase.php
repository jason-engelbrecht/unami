<?php /** @noinspection SqlResolve */
/* SQL STATEMENTS USED
//status:   0 is denied,
            1 is submitted,
            2 is approved,
            3 is complete

//category: 0 is archive,
            1 is active,
            2 is waitlist
CREATE TABLE applicants
(
	applicant_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	date_submitted VARCHAR(10) NOT NULL,
	app_status INT NOT NULL,
    category INT NOT NULL,
    app_type INT NOT NULL,
    fname VARCHAR(60) NOT NULL,
	lname VARCHAR(70) NOT NULL,
	pronouns VARCHAR(50) NOT NULL,
	birthdate VARCHAR(10) NOT NULL,
	NAMI_member boolean NOT NULL,
	affiliate VARCHAR(50) NOT NULL,
	address VARCHAR(70) NOT NULL,
	city VARCHAR(70) NOT NULL,
	address2 VARCHAR(70),
	state VARCHAR(30) NOT NULL,
	zip VARCHAR(12) NOT NULL,
	primary_phone VARCHAR(15) NOT NULL,
	primary_time VARCHAR(100) NOT NULL,
	alternate_phone VARCHAR(15),
	alternate_time VARCHAR(100),
	email VARCHAR(254) NOT NULL,
	preference VARCHAR(5) NOT NULL,
	emergency_name VARCHAR(120),
	emergency_phone VARCHAR(15),
    special_needs boolean NOT NULL,
	service_animal boolean NOT NULL,
	mobility_need boolean NOT NULL,
	need_rooming boolean NOT NULL,
	single_room boolean DEFAULT false,
	days_rooming VARCHAR(200) DEFAULT 'N/A',
	gender VARCHAR(50) DEFAULT 'N/A',
	roommate_gender VARCHAR(50) DEFAULT 'N/A',
	cpap_user boolean DEFAULT false,
	roommate_cpap boolean DEFAULT false,
	heard_about_training MEDIUMTEXT,
	other_classes MEDIUMTEXT,
	certified MEDIUMTEXT,
    FOREIGN KEY(app_type) references app_type(app_id),
    FOREIGN KEY(affiliate) references affiliates(affiliate_id)
);

CREATE TABLE adminUser
(
	admin_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    fname VARCHAR(60) NOT NULL,
	lname VARCHAR(70) NOT NULL,
	email VARCHAR(254) NOT NULL,
    password VARCHAR(255) NOT NULL
)

CREATE TABLE app_type
(
    app_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    app_type VARCHAR(100) NOT NULL
)

CREATE TABLE affiliates
(
    affiliate_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    email VARCHAR(254) NOT NULL
)

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
            //echo 'connected';
        } catch (PDOException $e) {
            //echo $e->getMessage();
        }
    }

    /**
     * @param $personalInfo PersonalInfo
     * @param $accommodations AdditionalInfo
     * @param $notRequired NotRequired
     */
    function addApplicant($personalInfo, $accommodations, $notRequired)
    {
        //prepare SQL statement
        $sql = "INSERT INTO applicants(date_submitted, app_status, category, app_type, fname, lname, pronouns, birthdate, NAMI_member, 
                affiliate, address, city, address2, state, zip, primary_phone, primary_time, alternate_phone, 
                alternate_time, email, preference, emergency_name, emergency_phone, special_needs, service_animal, 
                mobility_need, need_rooming, single_room, days_rooming, gender, roommate_gender, cpap_user, 
                roommate_cpap, heard_about_training, other_classes, certified) 
                VALUES (:date_submitted, :app_status, :category, :app_type, :fname, :lname, :pronouns, :birthdate, :NAMI_member, 
                :affiliate, :address, :city, :address2, :state, :zip, :primary_phone, :primary_time, 
                :alternate_phone, :alternate_time, :email, :preference, :emergency_name, :emergency_phone, 
                :special_needs, :service_animal, :mobility_need, :need_rooming, :single_room, :days_rooming, 
                :gender, :roommate_gender, :cpap_user, :roommate_cpap, :heard_about_training, :other_classes, 
                :certified)";

        // save prepared statement
        $statement = $this->_dbh->prepare($sql);

        // assign values
        $rawDate = getdate();
        $date = $rawDate['mon'] . '/' . $rawDate['mday'] . '/' . $rawDate['year'];
        $status = 1;
        $category = 1;
        $app_type = 1;

        //personal info
        $fname = $personalInfo->getFname();
        $lname = $personalInfo->getLname();
        $pronouns = $personalInfo->getPronouns();
        $birthdate = $personalInfo->getDobMonth() . '/' . $personalInfo->getDobDay() . '/' . $personalInfo->getDobYear();
        if ($personalInfo->getMember() == 'yes') {
            $NAMI_member = true;
        } else {
            $NAMI_member = false;
        }

        //Have to change to use foreign key: it does
        $NAMI_affiliate = $personalInfo->getAffiliate();
        $address = $personalInfo->getAddress();
        $city = $personalInfo->getCity();
        $address2 = $personalInfo->getAddress2();
        $state = $personalInfo->getState();
        $zip = $personalInfo->getZip();
        $primary_phone = $personalInfo->getPrimaryPhone();
        $primary_time = $personalInfo->getPrimaryTime();
        $alternate_phone = $personalInfo->getAlternatePhone();
        $alternate_time = $personalInfo->getAlternateTime();
        $email = $personalInfo->getEmail();
        $preference = $personalInfo->getPreference();
        $emergency_name = $personalInfo->getEmergencyName();
        $emergency_phone = $personalInfo->getEmergencyPhone();

        //accommodations
        $special_needs = $accommodations->getSpecialNeeds();
        $service_animal = $accommodations->getServiceAnimal();
        $mobility_need = $accommodations->getMovementDisability();
        $need_rooming = $accommodations->getNeedAccommodations();
        $single_room = $accommodations->getSingleRoom();

        $daysAsString = '';
        foreach ($accommodations->getDaysRooming() as $day) {
            $daysAsString += $day;
        }
        $days_rooming = $daysAsString;
        $gender = $accommodations->getGender();
        $roommate_gender = $accommodations->getRoommateGender();
        $cpap_user = $accommodations->getCpap();
        $roommateCpap = $accommodations->getCpapRoommate();

        //not required
        $heard_about_training = $notRequired->getHeardAboutTraining();
        $other_classes = 'Not trained in any other classes';
        if ($notRequired->getTrained() == 'yes') {
            $other_classes = $notRequired->getTrainedText();
        }
        $certified = 'Not certified to train any other classes';
        if ($notRequired->getCertified() == 'yes') {
            $certified = $notRequired->getCertifiedText();
        }

        // bind params
        $statement->bindParam(':date_submitted', $date, PDO::PARAM_STR);
        $statement->bindParam(':app_status', $status, PDO::PARAM_INT);
        $statement->bindParam(':category', $category, PDO::PARAM_INT);
        $statement->bindParam(':app_type', $app_type, PDO::PARAM_INT);

        //personal info
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
        $statement->bindParam(':pronouns', $pronouns, PDO::PARAM_STR);
        $statement->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
        $statement->bindParam(':NAMI_member', $NAMI_member, PDO::PARAM_BOOL);
        $statement->bindParam(':affiliate', $NAMI_affiliate, PDO::PARAM_STR);
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

        //accommodations
        $statement->bindParam(':special_needs', $special_needs, PDO::PARAM_BOOL);
        $statement->bindParam(':service_animal', $service_animal, PDO::PARAM_BOOL);
        $statement->bindParam(':mobility_need', $mobility_need, PDO::PARAM_BOOL);
        $statement->bindParam(':need_rooming', $need_rooming, PDO::PARAM_BOOL);
        $statement->bindParam(':single_room', $single_room, PDO::PARAM_BOOL);
        $statement->bindParam(':days_rooming', $days_rooming, PDO::PARAM_STR);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->bindParam(':roommate_gender', $roommate_gender, PDO::PARAM_STR);
        $statement->bindParam(':cpap_user', $cpap_user, PDO::PARAM_BOOL);
        $statement->bindParam(':roommate_cpap', $roommateCpap, PDO::PARAM_BOOL);

        //not required
        $statement->bindParam(':heard_about_training', $heard_about_training, PDO::PARAM_STR);
        $statement->bindParam(':other_classes', $other_classes, PDO::PARAM_STR);
        $statement->bindParam(':certified', $certified, PDO::PARAM_STR);

        // execute insert into users
        $statement->execute();

        //$lastID = $this->_dbh->lastInsertId();
    }

    function insertAdminUser($fname, $lname, $email, $password) {

        //hash password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //define query
        $query = 'INSERT INTO adminUser
                  (fname, lname, email, password)
                  VALUES
                  (:fname, :lname, :email, :password)';

        //prepare statement
        $statement = $this->_dbh->prepare($query);

        //bind parameters
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);

        //execute statement
        $statement->execute();

        return $this->_dbh->lastInsertId();
    }

    function getAdminPassword($email) {
        //define query
        $query = "SELECT password, fname, lname 
                  FROM adminUser
                  WHERE email = :email";

        //prepare statement
        $statement = $this->_dbh->prepare($query);

        //bind parameter
        $statement->bindParam(':email', $email, PDO::PARAM_STR);

        //execute
        $statement->execute();

        //get result
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    function getAffiliates()
    {
        //define query
        $query = "SELECT name FROM affiliates";

        //prepare statement
        $statement = $this->_dbh->prepare($query);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}