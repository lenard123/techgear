<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php if (isset($description)) : ?>
  <meta name="description" content="<?= __($description) ?>">
  <?php endif; ?>
  <link rel="stylesheet" type="text/css" href="<?= url('assets/css/tailwind.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= url('assets/css/styles.css') ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Iceland&display=swap" rel="stylesheet"> 
<link rel="icon" type="image/jpeg" href="<?= url('assets/img/favicon.ico') ?>" /> 
<title>  <?= isset($title) ? __($title) . ' | '. SITE_NAME : SITE_NAME ?></title>
</head>
<body class="bg-gray-100">

<?php $header->render() ?>
<?php view($content, $content_data) ?>
<?php App\Utils\AlertMessage::render() ?>

<script src="<?= url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= url('assets/js/app.js') ?>"></script>


<script type="text/javascript">
<?php foreach($js_data as $key => $value) : ?>
  var php_<?= $key ?> = <?= json_encode($value) ?>;

<?php endforeach; ?>
</script>

<?php foreach($scripts as $script) : ?>
  <script src="<?= $script ?>"></script>
<?php endforeach ?>

</body>
</html>