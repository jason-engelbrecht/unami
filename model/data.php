<?php
/**
 * Various data used
 *
 * @author Jason Engelbrecht
 * Date: 11/18/2019
 */
global $f3;
global $db;

//states
$f3->set('states', array('Alabama','Alaska','Arizona','Arkansas','California',
    'Colorado','Connecticut','Delaware','District of Columbia','Florida','Georgia',
    'Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana',
    'Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri',
    'Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York',
    'North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island',
    'South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington',
    'West Virginia','Wisconsin','Wyoming'));

//affiliates
$f3->set('affiliates', $db->getAffiliates());

//app types/training types
$f3->set('application_types', $db->getAppTypes());

//training descriptions
$f3->set('training_descriptions', array(
    1 => 'A support group for family members, partners and friends (age 18+) of people with mental health conditions.',
    2 => 'For anyone who is experiencing or has experienced the challenges of a mental health condition.',
    3 => 'A presentation about mental health conditions in youth. Available for 3 audiences: students, families and school staff.',
    4 => 'A support group for people (age 18+) with mental health conditions.',
    5 => 'A presentation for the general public, using personal stories to promote awareness of mental health conditions.',
    6 => 'A staff development program for health care professionals who work directly with people with mental health conditions.',
    7 => 'For families, partners and friends of people who have mental health conditions.',
    8 => 'For families, partners and friends who provide care for Service Members or Veterans experiencing mental health symptoms.',
    9 => 'For parents, guardians and other family who provide care for youth with mental health symptoms.',
    10 => 'Smarts'
));

//categories
$f3->set('applicationCategories',
    array(
        0 =>'Archive',
        1 => 'Active',
        2 => 'Waitlist'
    )
);

//statuses
$f3->set('applicationStatuses',
    array(
        0 => 'Denied',
        1 => 'Submitted',
        2 => 'Approved',
        3 => 'Complete'
    )
);