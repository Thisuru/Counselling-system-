<?php
/**
 * Created by PhpStorm.
 * User: aparna_ravihari
 * Date: 6/30/19
 * Time: 11:35 PM
 */

class ChatMessage
{
    private $counsellor;
    private $patient;
    private $message;
    private $timestamp;

    public function __construct()
    {
    }

    public function withInfo($counsellor, $patient, $message, $timestamp) {
        $chat_rec = new ChatMessage();
        $chat_rec->setCounsellor($counsellor);
        $chat_rec->setPatient($patient);
        $chat_rec->setMessage($message);
        $chat_rec->setTimestamp($timestamp);
        return $chat_rec;
    }

    /**
     * @return mixed
     */
    public function getCounsellor()
    {
        return $this->counsellor;
    }

    /**
     * @param mixed $counsellor
     */
    public function setCounsellor($counsellor)
    {
        $this->counsellor = $counsellor;
    }

    /**
     * @return mixed
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * @param mixed $patient
     */
    public function setPatient($patient)
    {
        $this->patient = $patient;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }


}

?>