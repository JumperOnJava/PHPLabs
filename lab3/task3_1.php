<?php
function readWordsFromFile($filename) {
    $words = [];
    if (file_exists($filename)) {
        $content = file_get_contents($filename);
        $words = array_values(array_filter(explode(' ', $content)));
    }
    return $words;
}

function countWords($words) {
    $wordCount = [];
    foreach ($words as $word) {
        if (isset($wordCount[$word])) {
            $wordCount[$word]++;
        } else {
            $wordCount[$word] = 1;
        }
    }
    return $wordCount;
}

function writeWordsToFile($filename, $words) {
    file_put_contents($filename, implode(' ', $words));
}

$file1 = 'file1.txt';
$file2 = 'file2.txt';
$outputFile1 = 'only_in_file1.txt';
$outputFile2 = 'in_both_files.txt';
$outputFile3 = 'more_than_twice.txt';

if (!isset($_POST['delete_file'])) {
    $words1 = readWordsFromFile($file1);
    $words2 = readWordsFromFile($file2);

    $wordCount1 = countWords($words1);
    $wordCount2 = countWords($words2);

    $onlyInFile1 = [];
    foreach ($wordCount1 as $word => $count) {
        if (!isset($wordCount2[$word])) {
            $onlyInFile1[] = $word;
        }
    }
    writeWordsToFile($outputFile1, $onlyInFile1);

    $inBothFiles = [];
    foreach ($wordCount1 as $word => $count) {
        if (isset($wordCount2[$word])) {
            $inBothFiles[] = $word;
        }
    }
    writeWordsToFile($outputFile2, $inBothFiles);

    $moreThanTwice = [];
    foreach ($wordCount1 as $word => $count1) {
        if (isset($wordCount2[$word])) {
            $count2 = $wordCount2[$word];
            if ($count1 >= 2 && $count2 >= 2) {
                $moreThanTwice[] = $word;
            }
        }
    }
    writeWordsToFile($outputFile3, $moreThanTwice);
}

$message = '';
if (isset($_POST['delete_file'])) {
    $fileToDelete = $_POST['filename'];

    $allowedFiles = [$outputFile1, $outputFile2, $outputFile3];

    if (in_array($fileToDelete, $allowedFiles) && file_exists($fileToDelete)) {
        if (unlink($fileToDelete)) {
            $message = "Файл $fileToDelete успішно видалено.";
        } else {
            $message = "Помилка при видаленні файлу $fileToDelete.";
        }
    } else {
        $message = "Помилка: Неправильний файл або файл не існує.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<body>
<h1>Робота з файлами</h1>

<?php if ($message): ?>
    <div class="message <?php echo strpos($message, 'успішно') !== false ? 'success' : 'error'; ?>">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<form method="post">
    <h2>Видалення файлу</h2>
    <div>
        <label for="filename">Виберіть файл для видалення:</label>
        <select id="filename" name="filename">
            <option value="<?php echo $outputFile1; ?>"><?php echo $outputFile1; ?></option>
            <option value="<?php echo $outputFile2; ?>"><?php echo $outputFile2; ?></option>
            <option value="<?php echo $outputFile3; ?>"><?php echo $outputFile3; ?></option>
        </select>
    </div>

    <button type="submit" name="delete_file">Видалити файл</button>
</form>
</body>
</html>