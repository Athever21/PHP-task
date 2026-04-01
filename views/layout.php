<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'My App' ?></title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/nav.css">

    <?php foreach ($styles ?? [] as $style): ?>
        <link rel="stylesheet" href="<?= $style ?>">
    <?php endforeach;?>
</head>
<body>

<?php include __DIR__ . '/partials/navbar.php'; ?>

<main>
    <?php include  $view; ?>
</main>

<?php foreach ($scripts ?? [] as $script): ?>
    <script src="<?= $script ?>" async defer></script>
<?php endforeach;?>

</body>
</html>