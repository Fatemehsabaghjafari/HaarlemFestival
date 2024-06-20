<?php

namespace App\Repositories;
use PDO;

require_once __DIR__ . '/../models/Page.php';

class PagesRepository
{
    private $db;
    public function __construct() {
        include(__DIR__ . '/../config/dbconfig.php');
        $this->db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    }

    public function listAllPages()
    {
        $stmt = $this->db->prepare('SELECT * FROM pages');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Page');
        $pages = $stmt->fetchAll();
        return $pages;
    }

    public function getPage($name)
    {
        $stmt = $this->db->prepare('SELECT * FROM pages WHERE name = ?');
        $stmt->execute([$name]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Page');
        $page = $stmt->fetch();
        return $page;
    }

    public function getPageByName($name) {
        $stmt = $this->db->prepare('SELECT * FROM pages WHERE name = :name');
        $stmt->execute(['name' => $name]);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Page');
        return $stmt->fetch();
    }

    public function updatePage($id, $name, $title, $body): bool
    {
        $stmt = $this->db->prepare('UPDATE pages SET title = ?, name = ?, body = ? WHERE id = ?');
        return $stmt->execute([$title, $name, $body, $id]);
    }

    public function addPage($name, $title, $body): bool
    {
        $stmt = $this->db->prepare('INSERT INTO pages (name, title, body) VALUES (?, ?, ?)');
        return $stmt->execute([$name, $title, $body]);
    }

    public function deletePage($id)
    {
        $stmt = $this->db->prepare('DELETE FROM pages WHERE id = ?');
        return $stmt->execute([$id]);
    }
}