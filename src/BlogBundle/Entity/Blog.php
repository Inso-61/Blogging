<?php

namespace BlogBundle\Entity;

class Blog
{

    private $id;
    private $name;
    private $subtitle;
    private $description;
    private $about;
    private $image;
    private $logo;

    public function getId()
    {
        return $this->id;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    public function getAbout()
    {
        return $this->about;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }


}

