<?php
//initialize testing
$test = new Test;

/////////////////validDOB/////////////////
//doesnt allow characters
$test->expect(
    !validDOB('ad/sd/sdqw'),
    'Letters are not allowed'
);
//valid for a valid one
$test->expect(
    validDOB('11/12/2018'),
    'Valid for valid birthdays'
);
//doesn't allow insane birthdays
$test->expect(
    !validDOB('91/12/2018'),
    'Invalid for invalid numeric birthdays'
);
//doesn't allow symbols in birthdays
$test->expect(
    !validDOB('91/&&/2018'),
    'Invalid for invalid with symbols birthdays'
);


////////////////daysRooming///////////////
//returns invalid for 'N/A'
$test->expect(
    !validDaysRooming(array('N/A')),
    'Returns invalid for N/A'
);
//returns valid for any day
$test->expect(
    validDaysRooming(array('Friday')),
    'Returns valid for anything else'
);


///////////validRequiredTextarea////////////
//returns invalid for an empty response
$test->expect(
    !validRequiredTextarea(''),
    'Returns invalid for empty response'
);
//returns valid for any response
$test->expect(
    validRequiredTextarea('Hello'),
    'Returns valid for any response'
);


///////////alphabetical////////////
//no numbers
$test->expect(
    !alphabetical('123'),
    "doesn't allow numbers"
);

//no symbols(except -, ., ', /, and ,)
$test->expect(
    !alphabetical('!@#$%^&*()_+={}[]|:;\'<>?"'),
    "doesn't allow symbols(except -, ., ', /, and ,)"
);

//allowed symbols
$test->expect(
    alphabetical("ya - . ' / ,"),
    "allows - . ' / ,"
);

//allows normal alphabetical input
$test->expect(
    alphabetical("hello world"),
    "allows normal alphabetical input with spaces"
);


/////////////numeric//////////////
//no alphabetical characters
$test->expect(
    !numeric("hello world"),
    "doesn't allow alphabetical characters"
);

//no symbols
$test->expect(
    !numeric("!@#$%^&*_+={}[]|:;'<>,.?/"),
    "doesn't allow symbols (except( - ( ) ))"
);

//numbers
$test->expect(
    numeric("98042"),
    "allows numbers"
);

//numbers with symbols and space allowed
$test->expect(
    numeric("980 42-456()"),
    "allows numbers with - ( ) and space"
);


//////////////validEmail//////////////
//allow normal email address
$test->expect(
    validEmail("email@email.com"),
    "allows normal email address"
);

//no @
$test->expect(
    !validEmail("emailemail.com"),
    "no @"
);

//no .
$test->expect(
    !validEmail("email@emailcom"),
    "no ."
);

//no . and @
$test->expect(
    !validEmail("emailemailcom"),
    "no @ or ."
);

// Display the results; not MVC but let's keep it simple
foreach ($test->results() as $result) {
    echo $result['text'].'<br>';
    if ($result['status'])
        echo 'Pass';
    else
        echo 'Fail ('.$result['source'].')';
    echo '<br><br>';
}