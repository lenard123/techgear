<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= isset($layout->title) ? __($layout->title) . ' | '. SITE_NAME : SITE_NAME ?> Admin</title>
  <link rel="icon" type="image/jpeg" href="<?= url('assets/img/favicon.ico') ?>" />
  <link rel="stylesheet" type="text/css" href="<?= asset('css/tailwind.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/admin.css') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Iceland&display=swap" rel="stylesheet"> 

<?= $layout->renderMetaData() ?>

</head>
<body class="bg-gray-100">

<?= $layout->header->render() ?>
<?= $layout->sidebar->render() ?>

<div class="lg:pl-60" style="padding-top: 60px">
<?= $layout->content->render() ?>
</div>

<?= $layout->renderAlertNotification() ?>
<?= $layout->renderLibraries() ?>
<?= $layout->renderJSData() ?>
<?= $layout->renderCustomScripts() ?>

</body>
</html>