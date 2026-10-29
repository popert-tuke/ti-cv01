<?php
// Инициализация переменных ошибок и статуса отправки
$errors = [];
$sent = ($_SERVER['REQUEST_METHOD'] == 'POST');

// Чтение данных из POST с очисткой
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

// Массивы опций
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

// Запуск проверок только если форма была отправлена
if ($sent) {
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
}
?>

<main class="container my-4">
    <section class="p-4 bg-light rounded shadow-sm">
        <h2>Kontaktný formulár</h2>
        <p class="zvyraznene">Prosím, vyplňte nasledujúci formulár pre odoslanie správy.</p>

        <?php if ($sent && count($errors) == 0): ?>
            <!-- Успешная отправка: вывод резюме -->
            <div class="alert alert-success">Formulár bol úspešne odoslaný.</div>
            <dl class="row">
                <dt class="col-sm-3">Meno</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></dd>

                <dt class="col-sm-3">E-mail</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></dd>

                <dt class="col-sm-3">Vek</dt>
                <dd class="col-sm-9"><?= $age ?></dd>

                <dt class="col-sm-3">Správa</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></dd>
            </dl>
        <?php else: ?>
            <!-- Форма ввода -->
            <?php if ($sent && count($errors) > 0): ?>
                <div class="alert alert-danger">Formulár obsahuje chyby, skontrolujte vstupy.</div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Meno a priezvisko:</label>
                    <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>" required />
                    <div class="invalid-feedback"><?= $errors['name'] ?? '' ?></div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mailová adresa:</label>
                    <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" required />
                    <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Vek:</label>
                    <input type="number" class="form-control <?= isset($errors['age']) ? 'is-invalid' : '' ?>" id="age" name="age" min="1" max="120" value="<?= $age > 0 ? $age : '' ?>" required />
                    <div class="invalid-feedback"><?= $errors['age'] ?? '' ?></div>
                </div>

                <div class="mb-3">
                    <label for="visit_date" class="form-label">Dátum návštevy:</label>
                    <input type="date" class="form-control <?= isset($errors['visit_date']) ? 'is-invalid' : '' ?>" id="visit_date" name="visit_date" value="<?= htmlspecialchars($visit_date, ENT_QUOTES, 'UTF-8') ?>" />
                    <div class="invalid-feedback"><?= $errors['visit_date'] ?? '' ?></div>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Kategória záujmu:</label>
                    <select class="form-select <?= isset($errors['category']) ? 'is-invalid' : '' ?>" id="category" name="category" required>
                        <option value="">-- vyber --</option>
                        <?php foreach ($category_options as $key => $label): ?>
                            <option value="<?= $key ?>" <?= $category === $key ? 'selected' : '' ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback"><?= $errors['category'] ?? '' ?></div>
                </div>

                <fieldset class="mb-3">
                    <legend class="fs-6 fw-bold">Spokojnosť so stránkou:</legend>
                    <?php foreach ($satisfaction_options as $key => $label): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="satisfaction" id="satisfaction_<?= $key ?>" value="<?= $key ?>" <?= $satisfaction === $key ? 'checked' : '' ?> />
                            <label class="form-check-label" for="satisfaction_<?= $key ?>"><?= $label ?></label>
                        </div>
                    <?php endforeach; ?>
                </fieldset>

                <div class="mb-3">
                    <label class="form-label fw-bold">Odoberať novinky:</label>
                    <?php foreach ($interests_options as $key => $label): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="interests[]" value="<?= $key ?>" id="interest_<?= $key ?>" <?= in_array($key, $interests) ? 'checked' : '' ?> />
                            <label class="form-check-label" for="interest_<?= $key ?>"><?= $label ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mb-3">
                    <label for="favorite_color" class="form-label">Obľúbená farba:</label>
                    <input type="color" class="form-control form-control-color" id="favorite_color" name="favorite_color" value="<?= htmlspecialchars($favorite_color, ENT_QUOTES, 'UTF-8') ?>" title="Vyberte farbu" />
                </div>

                <div class="mb-3">
                    <label for="sprava" class="form-label">Správa:</label>
                    <textarea class="form-control <?= isset($errors['sprava']) ? 'is-invalid' : '' ?>" id="sprava" name="sprava" rows="4"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></textarea>
                    <div class="invalid-feedback"><?= $errors['sprava'] ?? '' ?></div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input <?= isset($errors['consent']) ? 'is-invalid' : '' ?>" id="consent" name="consent" value="1" <?= $consent ? 'checked' : '' ?> required />
                    <label class="form-check-label" for="consent">Súhlasím so spracovaním údajov</label>
                    <div class="invalid-feedback"><?= $errors['consent'] ?? '' ?></div>
                </div>

                <button type="submit" class="btn btn-primary">Odoslať formulár</button>
            </form>
        <?php endif; ?>
    </section>
</main>
