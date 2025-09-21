<?php
require_once "database.php";

class Book {
    public $id = "";
    public $title = "";
    public $author = "";
    public $genre = "";
    public $published = "";

    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addBooks() {
        $sql = "INSERT INTO book (title, author, genre, published) 
                VALUES (:title, :author, :genre, :published)";
        $query = $this->db->connect()->prepare($sql);

        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":published", $this->published);

        return $query->execute();
    }

    public function viewBook() {
        $sql = "SELECT * FROM book ORDER BY title ASC";
        $query = $this->db->connect()->prepare($sql);

        if ($query->execute()) {
            return $query->fetchAll();
        } else {
            return null;
        }
    }
}


$obj = new Book();
?>
