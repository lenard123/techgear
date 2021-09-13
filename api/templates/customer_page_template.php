<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?= url('assets/styles.css') ?>">
  <title>
    <?= isset($title) ? $title . ' | '. SITE_NAME : SITE_NAME ?>
  </title>
</head>
<body class="bg-gray-100">

<?php $header->render() ?>
<?php view($content, $content_data) ?>
<?php AlertMessage::render() ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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