<?php

class blog
{
    private ?int $id = null;
    private ?string $title = null;
    private ?string $content = null;

    public function __construct( $id = null, $title, $content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
     
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
}