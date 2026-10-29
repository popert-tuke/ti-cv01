<?php
// 1. Чтение данных из $_POST с очисткой trim и обработкой значений по умолчанию
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$age = (int)($_POST['age'] ?? 0);
$visit_date = trim($_POST['visit_date'] ?? '');
$category = trim($_POST['category'] ?? '');
$satisfaction = trim($_POST['satisfaction'] ?? '');
$interests = $_POST['interests'] ?? [];
$favorite_color = trim($_POST['favorite_color'] ?? '#000000');
$message = trim($_POST['sprava'] ?? '');
$consent = isset($_POST['consent']) ? 1 : 0;

// 2. Списки возможных вариантов (для селектов, радиокнопок и чекбоксов)
$category_options = [
    'web' => 'Webový vývoj',
    'design' => 'Dizajn',
    'other' => 'Iné'
];

$satisfaction_options = [
    'excellent' => 'Výborná',
    'average' => 'Priemerná',
    'bad' => 'Zlá'
];

$interests_options = [
    'newsletter' => 'E-mailový newsletter',
    'notifications' => 'SMS notifikácie'
];

// 3. Проверки (валидация) данных и заполнение массива ошибок
$errors = [];

if (mb_strlen($name) < 3) {
    $errors['name'] = 'Meno musí mať aspoň 3 znaky.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Neplatná e-mailová adresa.';
}

if ($age < 1 || $age > 120) {
    $errors['age'] = 'Vek musí byť v rozsahu od 1 do 120 rokov.';
}

if (empty($visit_date) || strtotime($visit_date) === false) {
    $errors['visit_date'] = 'Neplatný dátum návštevy.';
} else if (strtotime($visit_date) > time()) {
    $errors['visit_date'] = 'Dátum návštevy nemôže byť v budúcnosti.';
}

if (!array_key_exists($category, $category_options)) {
    $errors['category'] = 'Neplatná kategória záujmu.';
}

if (!array_key_exists($satisfaction, $satisfaction_options)) {
    $errors['satisfaction'] = 'Neplatná hodnota spokojnosti.';
}

if (mb_strlen($message) < 5 && mb_strlen($message) > 0) {
    $errors['sprava'] = 'Správa je príliš krátka (min. 5 znakov).';
}

if (!$consent) {
    $errors['consent'] = 'Musíte súhlasiť so spracovaním údajov.';
}
?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <title>Spracovanie formulára</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
    <h1>Výsledok spracovania formulára</h1>

    <!-- Отладочный вывод массива POST (требование задания 6.4) -->
    <pre><?php print_r($_POST); ?></pre>

    <!-- Вывод трех значений по одному с защитой htmlspecialchars (Задание 6.7) -->
    <p><strong>Meno:</strong> <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>E-mail:</strong> <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Vek:</strong> <?= $age ?></p>

    <!-- Вывод всех значений через цикл foreach в списке <dl> -->
    <h3>Všetky odoslané údaje:</h3>
    <dl class="row">
        <?php foreach ($_POST as $key => $value): ?>
            <dt class="col-sm-3"><?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?></dt>
            <dd class="col-sm-9">
                <?php
                if (is_array($value)) {
                    $cleaned = array_map(function ($v) {
                        return htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
                    }, $value);
                    echo implode(', ', $cleaned);
                } else {
                    echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                }
                ?>
            </dd>
        <?php endforeach; ?>
    </dl>

    <!-- Вывод ошибок или успешного результата -->
    <?php if (count($errors) > 0): ?>
        <div class="alert alert-danger">
            <strong>Formulár obsahuje chyby:</strong>
            <ul>
                <?php foreach ($errors as $field => $errText): ?>
                    <li><?= htmlspecialchars($field, ENT_QUOTES, 'UTF-8') ?>: <?= htmlspecialchars($errText, ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <div class="alert alert-success">Údaje sú v poriadku a prešli kontrolou!</div>

        <!-- Задание 6.8: Вычисления -->
        <h2>Výpočty</h2>
        <?php
        // 1. Дни от даты посещения до сегодняшнего дня
        $days_since_visit = floor((time() - strtotime($visit_date)) / 86400);

        // 2. Сколько лет до текущего года (пример расчёта на основе возраста или года)
        $birth_year_approx = (int)date('Y') - $age;

        // 3. Длина текста сообщения через mb_strlen
        $message_length = mb_strlen($message);

        // 4. Собственный расчет (например, длина имени)
        $name_length = mb_strlen($name);
        ?>
        <p>Počet dní od zadaného dátumu návštevy do dnes: <strong><?= $days_since_visit ?></strong> dní.</p>
        <p>Približný rok narodenia (vypočítaný z veku): <strong><?= $birth_year_approx ?></strong>.</p>
        <p>Dĺžka textu správy: <strong><?= $message_length ?></strong> znakov.</p>
        <p>Dĺžka mena (vlastný výpočet): <strong><?= $name_length ?></strong> znakov.</p>
    <?php endif; ?>

</body>

</html>
