<?php

class Book {
    private $id;
    private $title;
    private $author;
    private $category;
    private $copies;
    private $status;

    public function __construct($title = null, $author = null, $category = null, $copies = null, $status = null) {
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
        $this->copies = $copies;
        $this->status = $status;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getCopies() {
        return $this->copies;
    }

    public function getStatus() {
        return $this->status;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setCopies($copies) {
        $this->copies = $copies;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * Display book information in an HTML table row
     * @return string HTML table row
     */
    public function show() {
        return "<tr>
                    <td>" . htmlspecialchars($this->id) . "</td>
                    <td>" . htmlspecialchars($this->title) . "</td>
                    <td>" . htmlspecialchars($this->author) . "</td>
                    <td>" . htmlspecialchars($this->category) . "</td>
                    <td>" . htmlspecialchars($this->copies) . "</td>
                    <td>" . htmlspecialchars($this->status) . "</td>
                </tr>";
    }
}
?>
