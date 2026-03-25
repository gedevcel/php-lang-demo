<?php

$lang = 'ca';

if (!empty($_GET['lang'])) {
    $lang = $_GET['lang'];
} elseif (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

$translations = [
    'ca' => 'Hola món',
    'es' => 'Hola mundo',
    'en' => 'Hello World'
];

$text = $translations[$lang] ?? $translations['ca'];

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Demo PHP</title>
</head>
<body>
    <main>
        <h1><?= $text ?></h1>
    </main>
</body>
</html>