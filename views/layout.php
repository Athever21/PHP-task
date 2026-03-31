<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'My App' ?></title>
</head>
<body>

<?php include __DIR__ . '/partials/navbar.php'; ?>

<main>
    <?php include  $view; ?>
</main>

</body>
</html>