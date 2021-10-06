<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?= isset($layout->title) ? __($layout->title) . ' | '. config('app.name') : config('app.name') ?> Admin</title>
  <link rel="icon" type="image/jpeg" href="<?= url('assets/img/favicon.ico') ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" integrity="sha512-0SPWAwpC/17yYyZ/4HSllgaK7/gg9OlVozq8K7rf3J8LvCjYEEIfzzpnA2/SSjpGIunCSD18r3UhvDcu/xncWA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <!-- 
    Full Tailwind | This will be automatically disabled on production 
    or when explicitly disabled on environment variables
  -->
  <?= $layout->renderFullTailwind() ?>

  <link rel="stylesheet" type="text/css" href="<?= asset('css/tailwind.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/all.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/admin.css') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Iceland&display=swap" rel="stylesheet"> 

<!-- PHP GENERATED METADATA -->
<?= $layout->renderMetaData() ?>

  <!-- INITIALIZE THEME -->
  <script type="text/javascript">
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark')
    } else {
      document.documentElement.classList.remove('dark')
    }
  </script>

</head>
<body class="bg-gray-100 dark:text-gray-100 dark:bg-gray-800">

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