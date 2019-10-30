<?php
/**
 * Validation file for user input
 * @author Max Lee
 * @copyright 10/27/2019
 */

/**
 * used to validate the personal info form
 * @return bool if everything was valid or not
 */
function validPersonalInfoForm()
{
    global $f3;
    $isValid = true;

    if (!alphabetical($f3->get('fname')))
    {
        $isValid = false;
        $f3->set("errors['fname']", "Please enter a valid first name");
    }

    if (!alphabetical($f3->get('lname')))
    {
        $isValid = false;
        $f3->set("errors['lname']", "Please enter a valid last name");
    }

    if (!alphabetical($f3->get('pronouns')))
    {
        $isValid = false;
        $f3->set("errors['pronouns']", "Please enter a valid pronoun");
    }

    if (!numeric($f3->get('dateOfBirth')))
    {
        $isValid = false;
        $f3->set("errors['dateOfBirth']", "Please enter your date of birth in the format DD/MM/YYY");
    }

    if (!alphabetical($f3->get('member')))
    {
        $isValid = false;
        $f3->set("errors['lname']", "Please enter a valid member selection");
    }

    if (empty($f3->get('affiliate') || $f3->get('affiliate') == 'none'))
    {
        $isValid = false;
        $f3->set("errors['affiliate']", "Please enter a valid affiliate");
    }

    if (empty($f3->get('address')))
    {
        $isValid = false;
        $f3->set("errors['address']", "Please enter your street address");
    }

    if (!numeric($f3->get('city')))
    {
        $isValid = false;
        $f3->set("errors['city']", "Please enter a valid city");
    }

    if (empty($f3->get('state')) || $f3->get('state') == 'none')
    {
        $isValid = false;
        $f3->set("errors['state']", "Please enter a valid state");
    }

    if (!numeric($f3->get('zip')))
    {
        $isValid = false;
        $f3->set("errors['zip']", "Please enter a valid zip");
    }

    if (empty($f3->get('primary_phone')))
    {
        $isValid = false;
        $f3->set("errors['primary_phone']", "Please enter a phone number");
    }

    if (empty($f3->get('primary_time')))
    {
        $isValid = false;
        $f3->set("errors['primary_time']", "Please enter a time to call");
    }

    /*if (!validEmail($f3->get('email')))
    {
        $isValid = false;
        $f3->set("errors['email']", "Please enter a valid email address");
    }*/

    if (!alphabetical($f3->get('preference')))
    {
        $isValid = false;
        $f3->set("errors['preference']", "Please choose a best way to contact you");
    }

    if (!alphabetical($f3->get('emergency_name')))
    {
        $isValid = false;
        $f3->set("errors['emergency_name']", "Please choose a best way to contact you");
    }

    if (empty($f3->get('emergency_phone')))
    {
        $isValid = false;
        $f3->set("errors['emergency_phone']", "Please enter your emergency contacts phone number");
    }

    return $isValid;
}

/**
 * used to validate the accommodations form
 * @return bool if everything was valid or not
 */
function validAccommodationsForm()
{
    global $f3;
    $isValid = true;

    if (!numeric($f3->get('gender')))
    {
        $isValid = false;
        $f3->set("errors['gender']", "Please enter a gender");
    }

    if (!numeric($f3->get('roommateGender')))
    {
        $isValid = false;
        $f3->set("errors['roommateGender']", "Please enter a gender for your roommate");
    }

    if (!validDaysRooming($f3->get('daysRooming')))
    {
        $isValid = false;
        $f3->set("errors['daysRooming']", "Please select at least 1 day to room");
    }

    return $isValid;
}

function validLongAnswersForm()
{
    global $f3;
    $isValid = true;

    if($f3->get('relativeMentalIllness') == 'yes')
    {
        if (!validRequiredTextarea($f3->get('relativeMentalIllnessText')))
        {
            $isValid = false;
            $f3->set("errors['relativeMentalIllness']", "Please type something about your relative");
        }
    }

    if($f3->get('convict') == 'yes')
    {
        if (!validRequiredTextarea($f3->get('convictText')))
        {
            $isValid = false;
            $f3->set("errors['convict']", "Please type something about your conviction");
        }
    }

    if (!validRequiredTextarea($f3->get('whyFacilitator')))
    {
        $isValid = false;
        $f3->set("errors['whyFacilitator']", "Please type something about why you want to become a facilitator");
    }

    if (!validRequiredTextarea($f3->get('experience')))
    {
        $isValid = false;
        $f3->set("errors['experience']", "Please type something about your experiences in support groups");
    }

    if($f3->get('coFacWhom') == 'yes')
    {
        if (!validRequiredTextarea($f3->get('coFacWhomText')))
        {
            $isValid = false;
            $f3->set("errors['coFacWhom']", "Please type something who you want to co-facilitate with");
        }
    }

    if($f3->get('coFacWhere') == 'yes')
    {
        if (!validRequiredTextarea($f3->get('coFacWhereText')))
        {
            $isValid = false;
            $f3->set("errors['coFacWhere']", "Please type something about where you want to co-facilitate");
        }
    }

    return $isValid;
}

/**
 * Used to check if they should fill something out on the not required.
 *
 */
function validNotRequiredForm()
{
    global $f3;
    $isValid = true;

    if($f3->get('trained') == 'yes')
    {
        if (!validRequiredTextarea($f3->get('trainedText')))
        {
            $isValid = false;
            $f3->set("errors['trained']", "Please type about your training");
        }
    }

    if($f3->get('certified') == 'yes')
    {
        if (!validRequiredTextarea($f3->get('certifiedText')))
        {
            $isValid = false;
            $f3->set("errors['certified']", "Please type about your certifications");
        }
    }

    return $isValid;
}

/**
 * Checks if the days rooming given was valid
 * @param array the days the applicant is staying
 * @return bool if the name was valid
 */
function validDaysRooming($days)
{
    return $days[0] != '1';
}

function validRequiredTextarea($textarea)
{
    return !empty($textarea) && $textarea != "";
}

/**
 * Checks if the name given was valid
 * @param String $value the value given
 * @return bool if the name was valid
 */
function alphabetical($value)
{
    return !empty($value) && ctype_alpha($value);
}

/**
 * Checks if the name given was valid
 * @param String $value the value given
 * @return bool if the name was valid
 */
function numeric($value)
{
    return !empty($value) && ctype_digit($value);
}

/**
 * Checks if password was valid
 * @param String $password the password given
 * @return bool if the password was 7 characters or longer
 */
function validPassword($password)
{
    return !empty($password) && strlen($password) >= 7;
}

/**
 * Checks if the email is valid
 * @param String $email the email given
 * @return bool if the email was valid ot not
 */
function validEmail($email)
{
    global $db;
    $emailValid = $db->checkEmail($email);
    if (empty($emailValid))
    {
        return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    return false;
}

/**
 * Checks if the passwords given match
 * @param String $pass the first password
 * @param String $pass1 the second password
 * @return bool if the passwords match
 */
function validSamePass($pass, $pass1)
{
    if(!empty($pass) == !empty($pass1))
    {
        return $pass == $pass1;
    }
    return false;
}

