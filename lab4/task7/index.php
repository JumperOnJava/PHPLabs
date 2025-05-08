<?php

class FileManager
{
    public static $dir = 'text';

    public static function writeToFile(string $filename, string $text)
    {
        $path = self::$dir . '/' . $filename;
        file_put_contents($path, $text . PHP_EOL, FILE_APPEND);
    }

    public static function readFile(string $filename): string
    {
        $path = self::$dir . '/' . $filename;
        return file_exists($path) ? file_get_contents($path) : '';
    }

    public static function clearFile(string $filename)
    {
        $path = self::$dir . '/' . $filename;
        file_put_contents($path, '');
    }
}

FileManager::writeToFile('file1.txt', 'line1');
FileManager::writeToFile('file1.txt', 'line2');

$content = FileManager::readFile('file1.txt');
echo "File:<br>$content";

FileManager::clearFile('file1.txt');
echo "<br>File cleared.<br>";

$content = FileManager::readFile('file1.txt');
echo "Content after clearing:<br>$content";
