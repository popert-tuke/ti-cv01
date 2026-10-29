<?php
// Premenné pre osobný blog
$nazovWebu = "Osobný blog"; // string: názov stránky kvôli identifikácii webu
$autor = "Mykhailo Perepichai"; // string: meno autora na zobrazenie v texte
$pocetClankov = 15; // int: celkový počet publikovaných článkov
$hodnotenieWebu = 4.8; // float: priemerné hodnotenie používateľmi
$jeAktivny = true; // bool: či je blog momentálne aktívny a dostupný
$zakladnyRok = 2024; // int: rok, kedy blog vznikol

// Výpočet veku blogu z roku vzniku a dnešného dátumu
$vekBlogu = date('Y') - $zakladnyRok;

// Výpočet zaokrúhlenia hodnotenia na 1 desatinné miesto
$zaokruhleneHodnotenie = round($hodnotenieWebu, 1);
?>
<!doctype html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables - <?= $nazovWebu ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container my-5">
    <h1>Vitajte na stránke <?= $nazovWebu ?></h1>

    <p>Autorom tohto projektu je <strong><?= $autor ?></strong>. Blog funguje už úspešne <?= $vekBlogu ?> roky.</p>

    <p>Na stránke sa nachádza celkovo <?= $pocetClankov ?> zaujímavých článkov z oblasti technológií. <br>
        Sme veľmi radi, že náš web navštevujete a podporujete.</p>

    <p>Priemerné hodnotenie nášho blogu je <?= number_format($zaokruhleneHodnotenie, 1, ',', ' ') ?> z 5 hviezdiček.</p>
</body>

</html>
