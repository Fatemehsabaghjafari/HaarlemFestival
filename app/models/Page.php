<?php
class Page {
    private $id;
    private $name;
    private $title;
    private $body;

    public function __construct($id = null, $name = null, $title = null, $body = null) {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->body = $body;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getBody() {
        return $this->body;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setBody($body) {
        $this->body = $body;
    }
}
?>