<?php
/**
 * Created by PhpStorm.
 * User: tharinduranaweera
 * Date: 5/19/19
 * Time: 2:24 PM
 */

class MusicRecord
{
    private $music_id;
    private $music_path;
    private $admin_email;
    private $admin_name;
    private $title;
    private $description;
    private $date_time;
    private $category;

    /**
     * MusicRecord constructor.
     */
    public function __construct()
    {
    }

    public function withMusicId($music_id, $music_path, $admin_email, $admin_name, $title, $description, $date_time, $category) {
        $music_rec = new MusicRecord();
        $music_rec->setMusicId($music_id);
        $music_rec->setMusicPath($music_path);
        $music_rec->setAdminEmail($admin_email);
        $music_rec->setAdminName($admin_name);
        $music_rec->setTitle($title);
        $music_rec->setDescription($description);
        $music_rec->setDateTime($date_time);
        $music_rec->setCategory($category);
        return $music_rec;
    }

    public function withoutMusicId($music_path, $admin_email, $admin_name, $title, $description, $date_time, $category) {
        $music_rec = new MusicRecord();
        $music_rec->setMusicPath($music_path);
        $music_rec->setAdminEmail($admin_email);
        $music_rec->setAdminName($admin_name);
        $music_rec->setTitle($title);
        $music_rec->setDescription($description);
        $music_rec->setDateTime($date_time);
        $music_rec->setCategory($category);
        return $music_rec;
    }

    /**
     * @return mixed
     */
    public function getMusicId()
    {
        return $this->music_id;
    }

    /**
     * @param mixed $music_id
     */
    public function setMusicId($music_id)
    {
        $this->music_id = $music_id;
    }

    /**
     * @return mixed
     */
    public function getMusicPath()
    {
        return $this->music_path;
    }

    /**
     * @param mixed $music_path
     */
    public function setMusicPath($music_path)
    {
        $this->music_path = $music_path;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }


}