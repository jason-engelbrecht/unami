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

    if (!validDOB($f3->get('dateOfBirth')))
    {
        $isValid = false;
        $f3->set("errors['dateOfBirth']", "Please enter your date of birth in the format MM/DD/YYY");
    }

    if (!alphabetical($f3->get('member')))
    {
        $isValid = false;
        $f3->set("errors['member']", "Please enter a valid member selection");
    }

    if (empty($f3->get('affiliate')) || $f3->get('affiliate') == 'none')
    {
        $isValid = false;
        $f3->set("errors['affiliate']", "Please enter a valid affiliate");
    }

    if (empty($f3->get('address')))
    {
        $isValid = false;
        $f3->set("errors['address']", "Please enter a valid street address");
    }

    if (!alphabetical($f3->get('city')))
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

    if (!numeric($f3->get('primary_phone')))
    {
        $isValid = false;
        $f3->set("errors['primary_phone']", "Please enter a valid primary phone number");
    }

    if ((!numeric($f3->get('alternate_phone')) && ($f3->get('alternate_phone') != ' ')))
    {
        $isValid = false;
        $f3->set("errors['primary_phone']", "Please enter a valid alternate phone number");
    }

    if (empty($f3->get('primary_time')))
    {
        $isValid = false;
        $f3->set("errors['primary_time']", "Please enter a primary time to call");
    }

    if (!validEmail($f3->get('email')))
    {
        $isValid = false;
        $f3->set("errors['email']", "Please enter a valid email address");
    }

    if ($f3->get('preference') != 'phone' && $f3->get('preference') != 'email')
    {
        $isValid = false;
        $f3->set("errors['preference']", "Please choose a best way to contact you");
    }

    if (!alphabetical($f3->get('emergency_name')))
    {
        $isValid = false;
        $f3->set("errors['emergency_name']", "Please enter a valid emergency contact");
    }

    if (!numeric($f3->get('emergency_phone')))
    {
        $isValid = false;
        $f3->set("errors['emergency_phone']", "Please enter a valid emergency contact phone number");
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

    if($f3->get('needAccommodations') == 'true')
    {
        if($f3->get('singleRoom') == 'true')
        {
            if (!alphabetical($f3->get('gender')))
            {
                $isValid = false;
                $f3->set("errors['gender']", "Please enter a gender");
            }

            if (!alphabetical($f3->get('roommateGender')))
            {
                $isValid = false;
                $f3->set("errors['roommateGender']", "Please enter a gender for your roommate");
            }

            if (!validDaysRooming($f3->get('daysRooming')))
            {
                $isValid = false;
                $f3->set("errors['daysRooming']", "Please select at least 1 day to room");
            }
        }
    }

    return $isValid;
}

/** Checks if the long answer form is valid
 * @return bool if the long answers is valid
 */
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

/** Checks if the not required form is valid
 * @return bool if the not required form is valid
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

/** Checks if the Date of Birth is valid
 * @param $dob String Date of Birth
 * @return bool if its valid
 */
function validDOB($dob)
{
    $nums = explode("/", $dob);
    foreach ($nums as $datePiece)
    {
        if(!numeric($datePiece))
        {
            return false;
        }
    }
    //check month is valid
    if($nums[0] < 1 || $nums[0] > 12)
    {
        return false;
    }

    //check if days are valid
    if($nums[1] < 1 || $nums[1] > 31)
    {
        return false;
    }

    //check if year is valid
    if($nums[2] < 1920 || $nums[2] > 2020)
    {
        return false;
    }
    return true;
}

/**
 * Checks if the days rooming given was valid
 * @param array the days the applicant is staying
 * @return bool if the name was valid
 */
function validDaysRooming($days)
{
    return $days[0] != 'N/A';
}

/** Checks if the applicant wrote something
 * @param $textarea String if something is written
 * @return bool if the textarea
 */
function validRequiredTextarea($textarea)
{
    return !empty($textarea) && $textarea != "";
}

/**
 * Checks if the String given was valid
 * @param String $value the value given
 * @return bool if the name was valid
 */
function alphabetical($value)
{
    return !empty($value) && ctype_alpha(str_replace(array(' ', "'", '-', '.', '/', ','), '', $value));
}

/**
 * Checks if the number given was valid
 * @param String $value the value given
 * @return bool if the name was valid
 */
function numeric($value)
{
    return !empty($value) && ctype_digit(str_replace(array('-', '(', ')', ' '), '', $value));
}

/**
 * Checks if the email is valid
 * @param String $email the email given
 * @return bool if the email was valid ot not
 */
function validEmail($email)
{
    //global $db;
    //$emailValid = $db->checkEmail($email);
    /**
    if (empty($emailValid))
    {
    }
    return false;
     * */

    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}

//////////////////admin portal validation////////////////////////////

/**
 * Check if admin create account input is all valid
 *
 * @param $fname
 * @param $lname
 * @param $email
 * @param $password
 * @param $passwordRepeat
 * @return bool
 */
function validAccount($fname, $lname, $email, $password, $passwordRepeat) {

    $isValid = true;

    if(!validAdminName($fname)) {
        $isValid = false;
    }

    if(!validAdminName($lname)) {
        $isValid = false;
    }

    if(!validAdminEmail($email)) {
        $isValid = false;
    }

    if(!validPassword($password, $passwordRepeat)) {
        $isValid = false;
    }

    return $isValid;
}

/**
 * Check for valid admin password
 *
 * @param $password
 * @param $passwordRepeat
 * @return bool
 */
function validPassword($password, $passwordRepeat) {
    global $f3;

    //regexes
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);

    //make sure password has uppercase, lowercase, number and is between 8 and 20 character
    if(!$uppercase || !$lowercase || !$number || (strlen($password) < 8 && strlen($password) > 20)) {
        $f3->set("adminErrors['passwordSpec']", "Please enter a password following the recommendations");
        return false;
    }

    //if password is good, check for matching
    if(!($password === $passwordRepeat)) {
        $f3->set("adminErrors['passwordMatch']", "Your passwords do not match");
        return false;
    }

    return true;
}

/**
 * Check for valid admin email
 *
 * @param $email
 * @return bool
 */
function validAdminEmail($email) {
    global $f3;
    global $db;

    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $f3->set("adminErrors['email']", "Please enter a valid email");
        return false;
    }

    //check if email is already in use
    if($db->getAdminEmail($email) != false) {
        $f3->set("adminErrors['email']", "This email is already in use");
        return false;
    }

    return true;
}

/**
 * Check for valid admin name
 *
 * @param $name
 * @return bool
 */
function validAdminName($name) {
    global $f3;

    if(!alphabetical($name)) {
        $f3->set("adminErrors['name']", "Please enter a valid name");
        return false;
    }

    return true;
}
