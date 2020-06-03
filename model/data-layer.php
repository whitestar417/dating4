<?php

/* getIndoorInterests()
 *   returns an array of indoor interests
 *   @return array
 */
function getIndoorInterests()
{
    $indoors = array("tv", "movies", "cooking", "board games", "puzzles", "reading", "playing cards", "video games");
    return $indoors;
}

/* getOutdoorInterests()
 *   returns an array of outdoor interests
 *   @return array
 */
function getOutdoorInterests()
{
    $outdoors = array("hiking", " biking", "swimming", "collecting", "walking", "climbing");
    return $outdoors;
}

/*
 * getState()
 * returns an array of statES
 * @return array
 */
function getStates()
{
    $states = array("Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia",
        "Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota",
        "Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina",
        "North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas",
        "Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming");
    return $states;
}

function getGenders()
{
    $genders = array("male", "female");
    return $genders;
}
