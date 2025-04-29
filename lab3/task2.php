<?php

// File to store comments

// Load existing comments
$comments = file_exists("comments.json") ? json_decode(file_get_contents("comments.json"), true) : [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($email && $comment) {
        $newComment = [
            "email" => $email,
            "comment" => $comment,
            "date" => date(DATE_ISO8601)
        ];

        $comments[] = $newComment;
        file_put_contents("comments.json", json_encode($comments, JSON_PRETTY_PRINT));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments Page</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        td, th { border: 1px solid black; padding: 8px; }
    </style>
</head>
<body>
<h2>Leave a Comment</h2>
<form method="post">
    Email: <input type="email" name="email" required><br>
    <br>
    Comment: <textarea name="comment" required></textarea><br>
    <button type="submit">Submit</button>`
</form>
<hr>
<h2>Previous Comments</h2>
<table>
    <?php foreach ($comments as $entry): ?>
        <tr>
            <td><?= htmlspecialchars($entry['email']) ?>
                <?= htmlspecialchars($entry['date']) ?> <hr>
            <?= nl2br(htmlspecialchars($entry['comment'])) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
