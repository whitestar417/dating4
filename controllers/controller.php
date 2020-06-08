<?php

/**
 * Class Controller
 */
class Controller
{
    private $_f3; //router
    private $_validator; //validation object

    /**
     * Controller constructor.
     * @param $f3
     * @param $validator
     */
    public function __construct($f3, $validator)
    {
        $this->_f3 = $f3;
        $this->_validator = $validator;
    }

    /**
     * Display the default route
     */
    public function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Process the personal information
     */
    public function personal_info()
    {
        //Check if the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset($_POST['membership'])) {
                $_SESSION['profile'] = new PremiumMember();
            }
            else {
                $_SESSION['profile'] = new Member();
            }

            $_SESSION['profile']->setGender($_POST['gender']);

            if ($GLOBALS['validator']->validName($_POST['fName'], $_POST['lName'])) {
                $_SESSION['profile']->setFname($_POST['fName']);
                $_SESSION['profile']->setLname($_POST['lName']);
            }
            else
            {
                //Data is invalid
                $this->_f3->set("errors['name']", "Please enter a valid name.");
            }

            if ($GLOBALS['validator']->validAge($_POST['age'])) {
                $_SESSION['profile']->setAge($_POST['age']);
            }
            else
            {
                //Data is invalid
                $this->_f3->set("errors['age']", "Please enter a valid age.");
            }

            if ($GLOBALS['validator']->validPhone($_POST['phone'])) {
                $_SESSION['profile']->setPhone($_POST['phone']);
            }
            else
            {
                //Data is invalid
                $this->_f3->set("errors['phone']", "Please enter a valid phone number.");
            }

            if (empty($this->_f3['errors'])) {

                //Redirect to the profile route
                $this->_f3->reroute("profile");
            }
        }

        $this->_f3->set('genders', getGenders());

        $view = new Template();
        echo $view->render('views/personal_info.html');
    }

    /**
     * Process the profile information
     */
    public function profile()
    {
        global $profile;
        $states = getStates();

        //Check if the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['profile']->setState($_POST['state']);
            $_SESSION['profile']->setSeeking($_POST['seeking']);
            $_SESSION['profile']->setBio($_POST['bio']);

            if ($GLOBALS['validator']->validEmail($_POST['email'])) {
                //Data is valid
                $_SESSION['profile']->setEmail($_POST['email']);

                if (isset($_POST['membership'])) {
                    //Redirect members to the interests
                    $this->_f3->reroute("interests");
                }
                else {
                    //Redirect non-members to the summary
                    $this->_f3->reroute("summary");
                }

            }
            else
            {
                //Data is invalid
                $this->_f3->set("errors['email']", "Please enter a valid email address.");
            }
        }

        $this->_f3->set('genders', getGenders());
        $this->_f3->set('states', $states);
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    /**
     * Process the interests
     */
    public function interests()
    {
        global $profile;
        $indoors = getIndoorInterests();
        $outdoors = getOutdoorInterests();

        //Check if the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->_validator->validIndoor($_POST['indoors'])) {
                $_SESSION['profile']->setInDoorIntersts($_POST['indoors']);
            }
            else
            {
                //Data is invalid
                $this->_f3->set("errors['indoors']", "Please do not spoof me.");
            }

            if ($this->_validator->validOutdoor($_POST['outdoors'])) {
                $_SESSION['profile']->setOutDoorIntersts($_POST['outdoors']);
            }
            else
            {
                //Data is invalid
                $this->_f3->set("errors['outdoors']", "Please do not spoof me.");
            }

            if (empty($f3['errors'])) {
                //Redirect to the profile route
                $this->_f3->reroute("summary");
            }
        }

        $this->_f3->set('indoors', $indoors);
        $this->_f3->set('outdoors', $outdoors);

        $view = new Template();
        echo $view->render('views/interests.html');
    }

    /**
     * Print a summary of the profile
     */
    public function summary()
    {
        global $profile;
        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
    }
}