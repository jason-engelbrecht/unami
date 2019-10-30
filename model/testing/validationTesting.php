<?php

$test = new Test;

//test validDOB
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

//valid days rooming
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

//valid textarea testing
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

$test->expect(
    is_callable('alphabetical'),
    'alphabetical is callable'
);

$test->expect(
    !alphabetical('123'),
    "doesn't allow numbers"
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