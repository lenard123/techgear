<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/tailwind.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/admin.css') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Iceland&display=swap" rel="stylesheet"> 
  <link rel="icon" type="image/jpeg" href="<?= asset('img/favicon.ico') ?>" /> 
  <title>TechGear Admin</title>
</head>
<body class="bg-gray-100">

<?= $header->render() ?>
<?= $sidebar->render() ?>
<div class="lg:pl-60" style="padding-top: 60px">
<?= $content->render() ?>
</div>

<?= App\Utils\AlertMessage::render() ?>

<script type="text/javascript">
<?php foreach($js_data as $key => $value) : ?>
  var php_<?= $key ?> = <?= json_encode($value) ?>;
<?php endforeach; ?>
</script>

<script src="<?= url('assets/js/babel-polyfill.min.js') ?>"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="<?= asset('js/jquery.min.js') ?>"></script>
<script src="<?= asset('js/admin.js') ?>"></script>

<?php foreach($scripts as $script) : ?>
<script src="<?= $script ?>"></script>
<?php endforeach; ?>

</body>
</html>