<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php if (isset($description)) : ?>
  <meta name="description" content="<?= __($description) ?>">
  <?php endif; ?>
  <link rel="stylesheet" type="text/css" href="<?= asset('css/tailwind.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/styles.css') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Iceland&display=swap" rel="stylesheet"> 
  <link rel="icon" type="image/jpeg" href="<?= url('assets/img/favicon.ico') ?>" /> 
  <title>  <?= isset($title) ? __($title) . ' | '. SITE_NAME : SITE_NAME ?></title>
</head>
<body class="bg-gray-100">
  
<?= $header->render() ?>
<?= $content->render() ?>
<?= App\Utils\AlertMessage::render() ?>

<footer class="bg-gray-800 text-gray-400 p-5">  

  <div class="grid grid-cols-1 sm:grid-cols-4 gap-y-5">

    <!-- Content 1 -->
    <div>

      <!-- Brand name and Logo -->
      <a href="#" class="flex justify-center lg:justify-start"
          href="<?= url() ?>" 
          style="font-family: 'Iceland', cursive;">
          <img
            src="<?= url('assets/img/logo.png') ?>" 
            class="mr-2 h-8 inline-block" 
          />
          <span class="flex my-auto mr-5 text-2xl text-white font-black">TechGear</span>
      
          </a>

        <span class="text-sm">Tagline</span>

    </div>

    <!-- Content 2 -->
    <div>
      
      <h3 class="tracking-wide uppercase text-white">Category</h3>
      
      <ul class="space-y-1 text-sm">
        <li>
          <a href="#">TV & Video</a>
        </li>
        <li>
          <a href="#">Audio & Home Theater</a>
        </li>
        <li>
          <a href="#">Computer</a>
        </li>
        <li>
          <a href="#">Laptop</a>
        </li>
            <li>
          <a href="#">Wearable Technology</a>
        </li>
      </ul>

    </div>

    <!-- Content 3 -->
    <div>
      
      <h3 class="tracking-wide uppercase text-white">Customer Service</h3>
      <ul class="space-y-1 text-sm">
        <li>
          <a href="#">Login</a>
        </li>
        <li>
          <a href="#">Register</a>
        </li>
            <li>
          <a href="#">About Us</a>
        </li>
      </ul>

    </div>

    <div>

    <span class="text-sm justify-items-center">© 2021 Shopee. All Rights Reserved</span>

    </div>

  </div>
</footer>

<script src="<?= url('assets/js/babel-polyfill.min.js') ?>"></script>
<script src="<?= url('assets/js/alpine.min.js') ?>" defer></script>
<script src="<?= url('assets/js/app.js') ?>"></script>

<?php foreach($layout->installed_libraries as $library) : ?>
  <script src="<?= $library ?>"></script>
<?php endforeach; ?>

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