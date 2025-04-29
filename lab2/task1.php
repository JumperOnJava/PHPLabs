<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['Text'], $_GET['Find'], $_GET['Replace'])) {
        $text = $_GET['Text'];
        $find = $_GET['Find'];
        $replace = $_GET['Replace'];
        $result = str_replace($find, $replace, $text);
    }

    if (isset($_GET['Cities'])) {
        $cities = explode(" ", trim($_GET['Cities']));
        sort($cities);
        $sortedCities = implode(" ", $cities);
    }

    if (isset($_GET['FilePath'])) {
        $filePath = $_GET['FilePath'];
        $fileName = pathinfo($filePath, PATHINFO_FILENAME);
    }

    if (isset($_GET['Date1'], $_GET['Date2'])) {
        $date1 = DateTime::createFromFormat('d-m-Y', $_GET['Date1']);
        $date2 = DateTime::createFromFormat('d-m-Y', $_GET['Date2']);
        $diff = $date1->diff($date2)->days;
    }

    function GeneratePassword($length): string
    {
        if($length < 8){
            $length = 8;
        }
        while(true){
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()-_+=<>?';
            $password = '';
            for($i = 0; $i < $length; $i++) {
                $password .= $chars[rand(0, strlen($chars) - 1)];
            }
            if(IsStrongPassword($password)){
                return $password;
            }
        }
    }

    function IsStrongPassword(string $password): bool {
        return strlen($password) >= 8 &&
            preg_match('/[A-Z]/', $password) &&
            preg_match('/[a-z]/', $password) &&
            preg_match('/\d/', $password) &&
            preg_match('/[^a-zA-Z\d]/', $password);
    }

    if (isset($_GET['PasswordLength'])) {
        $generatedPassword = GeneratePassword((int)$_GET['PasswordLength']);
    }

    if (isset($_GET['PasswordCheck'])) {
        $passwordCheckResult = IsStrongPassword($_GET['PasswordCheck']) ? 'Strong Password' : 'Weak Password';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Tasks</title>
</head>
<body>
<h2>Task 1: Character Replacement</h2>
<form method="get">
    <input type="text" name="Text" placeholder="Text">
    <input type="text" name="Find" placeholder="Find">
    <input type="text" name="Replace" placeholder="Replace">
    <button type="submit">Replace</button>
</form>
<?= isset($result) ? "Result: $result" : '' ?><br>

<h2>Task 2: Sorting Cities</h2>
<form method="get">
    <input type="text" name="Cities" placeholder="Enter cities separated by space">
    <button type="submit">Sort</button>
</form>
<?= isset($sortedCities) ? "Sorted Cities: $sortedCities" : '' ?><br>

<h2>Task 3: Extracting File Name</h2>
<form method="get">
    <input type="text" name="FilePath" placeholder="Enter file path">
    <button type="submit">Extract</button>
</form>
<?= isset($fileName) ? "File Name: $fileName" : '' ?><br>

<h2>Task 4: Date Difference</h2>
<form method="get">
    <input type="text" name="Date1" placeholder="Date 1 (dd-mm-yyyy)">
    <input type="text" name="Date2" placeholder="Date 2 (dd-mm-yyyy)">
    <button type="submit">Calculate</button>
</form>
<?= isset($diff) ? "Number of days between dates: $diff" : '' ?><br>

<h2>Task 5: Password Generator</h2>
<form method="get">
    <input type="number" name="PasswordLength" placeholder="Password length">
    <button type="submit">Generate</button>
</form>
<?= isset($generatedPassword) ? "Generated Password: $generatedPassword" : '' ?><br>

<h2>Password Strength Check</h2>
<form method="get">
    <input type="text" name="PasswordCheck" placeholder="Enter password">
    <button type="submit">Check</button>
</form>
<?= isset($passwordCheckResult) ? "Result: $passwordCheckResult" : '' ?><br>
</body>
</html>