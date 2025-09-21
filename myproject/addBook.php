<?php
require_once "../classes/book.php";

$books = ["title"=>"", "author"=>"","genre"=>"", "published"=>""];
$errors = ["title"=>"", "author"=>"","genre"=>"", "published"=>""];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $books["title"] = trim(htmlspecialchars($_POST["title"]));
    $books["author"] = trim(htmlspecialchars($_POST["author"]));
    $books["genre"] = trim(htmlspecialchars($_POST["genre"]));
    $books["published"] = trim(htmlspecialchars($_POST["published"]));

    // Validation
    if (empty($books["title"])) {
        $errors["title"] = "Title is required";
    }
    if (empty($books["author"])) {
        $errors["author"] = "Author is required";
    }
    if (empty($books["genre"])) {
        $errors["genre"] = "Genre is required";
    }
    if (empty($books["published"])) {
        $errors["published"] = "Publication date is required";
    } elseif (strtotime($books["published"]) > strtotime(date("Y-m-d"))) {
        $errors["published"] = "Publication date cannot be in the future";
    }

    // If no errors, save to database
    if (!array_filter($errors)) {
        $bookObj = new Book();
        $bookObj->title = $books["title"];
        $bookObj->author = $books["author"];
        $bookObj->genre = $books["genre"];
        $bookObj->published = $books["published"];

        if ($bookObj->addBooks()) {
            header("Location: viewBook.php");
            exit();
        } else {
            echo "<p style='color:red'>Error: Failed to save book.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        label { display: block; margin-top: 10px; }
        input, select { margin-top: 5px; padding: 5px; width: 250px; }
        .errors { color: red; margin: 0; font-size: 14px; }
        span { color: red; }
    </style>
</head>
<body>
    <h1>Add Book</h1>
    <form action="" method="post">
        <label>Title <span>*</span></label>
        <input type="text" name="title" value="<?= $books["title"] ?>">
        <p class="errors"><?= $errors["title"] ?></p>

        <label>Author <span>*</span></label>
        <input type="text" name="author" value="<?= $books["author"] ?>">
        <p class="errors"><?= $errors["author"] ?></p>

        <label>Genre <span>*</span></label>
        <select name="genre">
            <option value="">--SELECT--</option>
            <option value="history" <?= ($books["genre"] == "history")? "selected": "" ?>>History</option>
            <option value="science" <?= ($books["genre"] == "science")? "selected": "" ?>>Science</option>
            <option value="fiction" <?= ($books["genre"] == "fiction")? "selected": "" ?>>Fiction</option>
        </select>
        <p class="errors"><?= $errors["genre"] ?></p>

        <label>Date Published <span>*</span></label>
        <input type="date" name="published" value="<?= $books["published"] ?>">
        <p class="errors"><?= $errors["published"] ?></p>

        <button type="submit">Save Book</button>
    </form>
</body>
</html>
