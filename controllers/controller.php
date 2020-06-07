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
     * Process the order route
     */
    public function personal_info()
    {
        //Check if the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_SESSION['gender'] = $_POST['gender'];

            if ($GLOBALS['validator']->validName($_POST['fName'], $_POST['lName']))
            {
                $_SESSION['fName'] = $_POST['fName'];
                $_SESSION['lName'] = $_POST['lName'];
            }
            else
            {
                //Data is invalid
                $this->_f3->set("errors['name']", "Please enter a valid name.");
            }

            if ($GLOBALS['validator']->validAge($_POST['age']))
            {
                $_SESSION['age'] = $_POST['age'];
            }
            else
            {
                //Data is invalid
                $this->_f3->set("errors['age']", "Please enter a valid age.");
            }

            if ($GLOBALS['validator']->validPhone($_POST['phone']))
            {
                $_SESSION['phone'] = $_POST['phone'];
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
     *
     */
    public function profile()
    {
        $states = getStates();

        //Check if the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_SESSION['state'] = $_POST['state'];
            $_SESSION['seeking'] = $_POST['seeking'];
            $_SESSION['bio'] = $_POST['bio'];

            if ($GLOBALS['validator']->validEmail($_POST['email']))
            {
                //Data is valid
                $_SESSION['email'] = $_POST['email'];

                //Redirect to the interests route
                $this->_f3->reroute("interests");
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
     *
     */
    public function interests()
    {
        $indoors = getIndoorInterests();
        $outdoors = getOutdoorInterests();

        //Check if the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if ($this->_validator->validIndoor($_POST['indoors']))
            {
                $_SESSION['indoors'] = $_POST['indoors'];
            }
            else
            {
                //Data is invalid
                $this->_f3->set("errors['indoors']", "Please do not spoof me.");
            }

            if ($this->_validator->validOutdoor($_POST['outdoors']))
            {
                $_SESSION['outdoors'] = $_POST['outdoors'];
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
     *
     */
    public function summary()
    {
        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
    }
}