<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= $title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <?php echo view('templates/header'); ?>
  <?php if (isset($navTemplate)) : ?>
    <?php echo view('templates/' . $navTemplate); ?>
  <?php else : ?>
    <?php echo view('templates/nav-public.php'); ?>
  <?php endif ?>
  <main><?php echo $mainContent; ?></main>

  <?php echo view('templates/footer'); ?>
</body>

</html>