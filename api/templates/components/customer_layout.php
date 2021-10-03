<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= isset($layout->title) ? __($layout->title) . ' | '. config('app.name') : config('app.name') ?></title>
  <link rel="icon" type="image/jpeg" href="<?= url('assets/img/favicon.ico') ?>" />
  <link rel="stylesheet" type="text/css" href="<?= asset('css/tailwind.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/all.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/styles.css') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Iceland&display=swap" rel="stylesheet"> 

<?= $layout->renderMetaData() ?>

</head>
<body>

<?= $layout->header->render() ?>
<?= $layout->content->render() ?>
<?= $layout->footer->render() ?>

<?= $layout->renderAlertNotification() ?>
<?= $layout->renderLibraries() ?>
<?= $layout->renderJSData() ?>
<?= $layout->renderCustomScripts() ?>

</body>
</html>