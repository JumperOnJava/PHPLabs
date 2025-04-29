<?php
$wordsFile = 'words.txt';
$sortedFile = 'sorted_words.txt';
$message = '';

    if (file_exists($wordsFile)) {
        $content = file_get_contents($wordsFile);

        $words = array_filter(explode(' ', $content));

        sort($words);

        $success = file_put_contents($sortedFile, implode(' ', $words));

        if ($success !== false) {
            $message = "Sorted '$sortedFile'.";
        } else {
            $message = "error";
        }
    } else {
        $message = "Error file '$wordsFile' not found";
    }

?>

<!DOCTYPE html>
<html lang="uk">
<body>
    <h1>Сортування слів за алфавітом</h1>
</body>
</html>