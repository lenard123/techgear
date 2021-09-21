<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?= url('assets/css/tailwind.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= url('assets/css/admin.css') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Iceland&display=swap" rel="stylesheet"> 
  <title>TechGear Admin</title>
</head>
<body class="bg-gray-50">

<?= $header->render() ?>
<?= $sidebar->render() ?>
<div class="lg:pl-60" style="padding-top: 60px">
  <?= view("admin/" . $content, $content_data) ?>
</div>

</body>
</html>