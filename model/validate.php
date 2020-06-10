<?php

class Validate
{
    function validName($fName, $lName)
    {
        $name = $fName . $lName;
        $name = str_replace(' ', '', $name);

        if (empty($name) || !ctype_alpha($name)) {
            return false;
        }
        return true;
    }

    /* Return a value indicating if age is valid
       Valid age is between 18 and 118
       @param String $age
       @return boolean
    */
    function validAge($age)
    {
        return !empty($age) && $age >= 18 && $age <= 118;
    }

    /* Return a value indicating if phone is valid
       @param String $phone
       @return boolean
    */
    function validPhone($phone)
    {
        return !empty($phone) && strlen($phone) >= 7;
    }

    /* Return a value indicating if email is valid
       @param String $email
       @return boolean
    */
    function validEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /* Return a value indicating if outdoors is valid
       Valid indoors include hiking, biking, swimming,
       collectings, walking, or climbing
       @param String $outdoors
       @return boolean
    */
    function validOutdoor($outdoor)
    {
        $outdoors = getOutdoorInterests();
        if (!empty($outdoor)) {
            if (count(array_diff($outdoor, $outdoors)) > 0) {
                return false;
            }
        }
        return true;
    }

    /* Return a value indicating if indoors is valid
       Valid indoors include tv, movies, cooking, board
       games, puzzles, reading, playing cards, or video
       games
       @param String $indoors
       @return boolean
    */
    function validIndoor($indoor)
    {
        $indoors = getIndoorInterests();
        if (!empty($indoor)) {
            if (count(array_diff($indoor, $indoors)) > 0) {
                return false;
            }
        }
        return true;
    }
}