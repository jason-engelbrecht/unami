/*
SQL STATEMENTS USED
use for DB setup
*/

/*
General application fields
status:   0 is denied,
          1 is submitted,
          2 is approved,
          3 is complete

category: 0 is archive,
          1 is active,
          2 is waitlist
*/
CREATE TABLE applicants
(
    applicant_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    date_submitted DATE NOT NULL,
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
    notes MEDIUMTEXT,
    member_expiration VARCHAR(50),
    info_id INT NOT NULL,
    FOREIGN KEY(app_type) references app_type(app_id),
    FOREIGN KEY(affiliate) references affiliates(affiliate_id),
    FOREIGN KEY(info_id) references app_type_info(info_id)
);

/* specific application tables */
CREATE TABLE FSG
(
    FSG_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    applicant_id INT NOT NULL,
    training_info VARCHAR(100),
    relative_mental MEDIUMTEXT,
    conviction MEDIUMTEXT,
    why_want MEDIUMTEXT,
    experience MEDIUMTEXT,
    whom_co MEDIUMTEXT,
    where_co MEDIUMTEXT,
    FOREIGN KEY(applicant_id) references applicants(applicant_id)
);

CREATE TABLE P2P
(
    P2P_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    applicant_id INT NOT NULL,
    training_info VARCHAR(100),
    conviction MEDIUMTEXT,
    why_want MEDIUMTEXT,
    describe_recovery MEDIUMTEXT,
    give_back MEDIUMTEXT,
    FOREIGN KEY(applicant_id) references applicants(applicant_id)
);

CREATE TABLE ETS
(
    ETS_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    applicant_id INT NOT NULL,
    training_info VARCHAR(100),
    conviction MEDIUMTEXT,
    availability MEDIUMTEXT,
    education VARCHAR(200),
    experience VARCHAR(200),
    languages VARCHAR(200),
    age VARCHAR(100),
    description VARCHAR(200),
    diagnosis VARCHAR(200),
    self_disclosure CHAR(10),
    positive_outlook CHAR(10),
    background_check CHAR(10),
    why_want MEDIUMTEXT,
    mental_experience MEDIUMTEXT,
    support_experience MEDIUMTEXT,
    recovery MEDIUMTEXT,
    view_roles MEDIUMTEXT,
    FOREIGN KEY(applicant_id) references applicants(applicant_id)
);

/* application/training type tables */
CREATE TABLE app_type
(
    app_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    app_type VARCHAR(100) NOT NULL,
    ref_name VARCHAR(50)
);

-- active 1, inactive 0
CREATE TABLE app_type_info
(
    info_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    date VARCHAR(200),
    location VARCHAR(200),
    deadline VARCHAR(200),
    app_type INT,
    date2 VARCHAR(200),
    active INT,
    FOREIGN KEY(app_type) references app_type(app_id)
);

/* affiliates table */
CREATE TABLE affiliates
(
    affiliate_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    email VARCHAR(254) NOT NULL
);

/* admin portal user */
CREATE TABLE adminUser
(
    admin_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    fname VARCHAR(60) NOT NULL,
    lname VARCHAR(70) NOT NULL,
    email VARCHAR(254) NOT NULL,
    password VARCHAR(255) NOT NULL
);

/* setup basic data for tables */
INSERT INTO affiliates(name)
VALUES
('NAMI Chelan-Douglas'),
('NAMI Clallam County'),
('NAMI Eastside'),
('NAMI Jefferson County'),
('NAMI Kitsap County'),
('NAMI Lewis County'),
('NAMI Pierce County'),
('NAMI Seattle'),
('NAMI Skagit'),
('NAMI Snohomish County'),
('NAMI South King County'),
('NAMI Southwest Washington'),
('NAMI Spokane'),
('NAMI Thurston-Mason'),
('NAMI Tri-Cities'),
('NAMI Walla Walla'),
('NAMI Washington Coast'),
('NAMI Whatcom'),
('NAMI Yakima');

INSERT INTO app_type(app_type, ref_name)
VALUES
('Family Support Group', 'familySupportGroup'),
('Peer-to-Peer', 'peer2peer'),
('Ending the Silence', 'endingTheSilence'),
('Connection', 'connection'),
('In Our Own Voice', 'inOurOwnVoice'),
('Provider Education', 'providerEducation'),
('Family-to-Family', 'family2family'),
('Homefront', 'homefront'),
('Basics', 'basics'),
('Smarts', 'smarts');