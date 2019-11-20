/*
SQL STATEMENTS USED
use for DB setup

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
    notes MEDIUMTEXT
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
);

CREATE TABLE app_type
(
    app_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    app_type VARCHAR(100) NOT NULL
);

CREATE TABLE affiliates
(
    affiliate_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    email VARCHAR(254) NOT NULL
);

CREATE TABLE notes
(
    applicant_id INT NOT NULL,
    affiliate_notes MEDIUMTEXT,
    state_notes MEDIUMTEXT,
    FOREIGN KEY(applicant_id) references applicants(applicant_id)
);

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

INSERT INTO app_type(app_type)
VALUES
('Family Support Group');