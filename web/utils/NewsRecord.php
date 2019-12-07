<?php
/**
 * Created by PhpStorm.
 * User: aparna_ravihari
 * Date: 5/18/19
 * Time: 9:45 AM
 */

class NewsRecord
{
    private $article_no;
    private $admin_email;
    private $admin_name;
    private $description;
    private $photo_path;
    private $date_time;

    /**
     * NewsRecord constructor.
     */
    public function __construct()
    {
    }

    public function withoutArtNo($admin_email, $admin_name, $description, $photo_path, $date_time) {
        $record = new NewsRecord();
        $record->setAdminEmail($admin_email);
        $record->setAdminName($admin_name);
        $record->setDescription($description);
        $record->setPhotoPath($photo_path);
        $record->setDateTime($date_time);
        return $record;
    }

    public function withArtNo($article_no, $admin_email, $admin_name, $description, $photo_path, $date_time) {
        $record = new NewsRecord();
        $record->setArticleNo($article_no);
        $record->setAdminEmail($admin_email);
        $record->setAdminName($admin_name);
        $record->setDescription($description);
        $record->setPhotoPath($photo_path);
        $record->setDateTime($date_time);
        return $record;
    }


    /**
     * @return mixed
     */
    public function getArticleNo()
    {
        return $this->article_no;
    }

    /**
     * @param mixed $article_no
     */
    public function setArticleNo($article_no)
    {
        $this->article_no = $article_no;
    }

    /**
     * @return mixed
     */
    public function getAdminEmail()
    {
        return $this->admin_email;
    }

    /**
     * @param mixed $admin_email
     */
    public function setAdminEmail($admin_email)
    {
        $this->admin_email = $admin_email;
    }

    /**
     * @return mixed
     */
    public function getAdminName()
    {
        return $this->admin_name;
    }

    /**
     * @param mixed $admin_name
     */
    public function setAdminName($admin_name)
    {
        $this->admin_name = $admin_name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPhotoPath()
    {
        return $this->photo_path;
    }

    /**
     * @param mixed $photo_path
     */
    public function setPhotoPath($photo_path)
    {
        $this->photo_path = $photo_path;
    }

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->date_time;
    }

    /**
     * @param mixed $date_time
     */
    public function setDateTime($date_time)
    {
        $this->date_time = $date_time;
    }


}