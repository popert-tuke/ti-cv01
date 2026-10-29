<?php
// Pole hodnôt pre cyklus foreach
$teorie = ['HTML', 'CSS', 'Bootstrap', 'JavaScript', 'PHP'];
?>
<!doctype html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loops - Osobný blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container my-5">
    <h2>Cykly a tabuľky</h2>

    <!-- DOPLŇ: for cyklus ide od 10 do 1 s krokom 1 dole -->
    <table class="table">
        <thead>
            <tr>
                <th>Počítadlo (i)</th>
                <th>Výpočet (i * 5)</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 10; $i >= 1; $i--): ?>
                <tr class="<?= $i % 2 == 0 ? 'table-light' : '' ?>">
                    <td><?= $i ?></td>
                    <td><?= $i * 5 ?></td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <h2>Zoznam technológií</h2>
    <ol>
        <?php foreach ($teorie as $index => $value): ?>
            <li><?= $index + 1 ?>. <?= $value ?></li>
        <?php endforeach; ?>
    </ol>

    <h2>Odpočítavanie</h2>
    <p>
        <?php
        // DOPLŇ: while cyklus odpočítava od 5 po 2
        $counter = 5;
        while ($counter >= 1) {
            echo $counter . " ";
            $counter -= 2;
        }
        ?>
    </p>
</body>

</html>

