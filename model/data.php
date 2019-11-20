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

//app types
$f3->set('application_types', $db->getAppTypes());

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