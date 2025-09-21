<?php

require_once "../classes/book.php";
$bookObj = new Book();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Book</title>
</head>
<body>
    <h1>Book list</h1>
    <a href="../book/addBook.php">
        <button>Add Book</button>
    </a>
    <br><br>
    <table border="1" cellspacing="0" cellpadding="8">
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Date published</th>
        </tr>
        <?php
        $books = $bookObj->viewBook(); 

        if ($books) {
        foreach ($books as $book) {
        echo "<tr>
                <td>{$book['id']}</td>
                <td>{$book['title']}</td>
                <td>{$book['author']}</td>
                <td>{$book['genre']}</td>
                <td>{$book['published']}</td>
              </tr>";
        }
        } else {
        echo "<tr><td colspan='5'>No books found</td></tr>";
        }
        ?>
    </table>
</body>
</html>