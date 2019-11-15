<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/13/19
 * Time: 3:03 PM
 */

class User
{
    private $name;
    private $dob;
    private $gender;
    private $account_type;
    private $email;

    /**
     * User constructor.
     */
    public function __construct()
    {
    }

    public function withData($name, $dob, $gender, $account_type, $email) {
        $user = new User();
        $user->setName($name);
        $user->setDob($dob);
        $user->setGender($gender);
        $user->setAccountType($account_type);
        $user->setEmail($email);
        return $user;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param mixed $dob
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getAccountType()
    {
        return $this->account_type;
    }

    /**
     * @param mixed $account_type
     */
    public function setAccountType($account_type)
    {
        $this->account_type = $account_type;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }



}

?>