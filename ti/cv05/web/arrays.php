<?php
// Pole kategórií pre osobný blog
$items = ['Webový vývoj', 'Dizajn', 'Technológie', 'Programovanie', 'Frontend'];
// DOPLŇ: pridanie šiesteho prvku do poľa
$items[] = 'UI/UX';


// Asociatívne pole pre detail položky
$item = [
    'name' => 'Webový vývoj',
    'order' => 1,
    'category' => 'Programovanie',
    'price' => 0.0,
    'available' => true
];

// Pole čísel pre ukážku zoradenia
$numbers = [10, 2, 7, 33, 4];
$sortedNumbers = $numbers;
sort($sortedNumbers);

// Úloha 5.7: Pole čísel ako int a ako string na porovnanie zoradenia
$cislaInt = [15, 3, 25];
$cislaString = ['15', '3', '25'];
sort($cislaInt);
sort($cislaString);
// Komentár k 5.7: Číselné pole (int) sa zoraďuje podľa číselnej hodnoty (3, 15, 25), zatiaľ čo pole reťazcov (string) sa zoraďuje lexikograficky (abecedne), takže '15' je pred '25', pretože začína jednotkou.
?>
<!doctype html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays - Osobný blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container my-5">
    <h2>Zoznam kategórií</h2>
    <ul>
        <?php foreach ($items as $itemText): ?>
            <li><?= $itemText ?></li>
        <?php endforeach; ?>
    </ul>

    <p>Počet kategórií je <?= count($items) ?>. Všetky témy: <?= implode(', ', $items) ?>.</p>

    <!-- DOPLŇ: vypísanie prvého a posledného prvku -->
    <p>Prvá kategória je <?= $items[0] ?> a posledná je <?= $items[count($items) - 1] ?>.</p>

    <h2>Detail položky ($item)</h2>
    <ul>
        <?php foreach ($item as $key => $value): ?>
            <li><?= $key ?>: <?= is_bool($value) ? ($value ? 'Áno' : 'Nie') : $value ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Zoradené čísla</h2>
    <p><?= implode(', ', $sortedNumbers) ?></p>
</body>

</html>
