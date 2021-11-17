<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
  <head>
    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> <?= $title; ?></title>
      <link rel="stylesheet" href="<?= theme("/assets/css/boot.css") ?>"/>
      <link rel="stylesheet" href="<?= theme("/assets/css/style.css") ?>"/>
  </head>
  <body>
    <div class="ajax_load">
      <div class="ajax_load_box">
          <div class="ajax_load_box_circle"></div>
          <p class="ajax_load_box_title">Aguarde, carregando...</p>
      </div>
    </div>
  <div class="ajax_response"><?= flash(); ?></div>
    <main class="container content">
        <?= $v->section("content"); ?>
    </main>
</body>
    <script src="<?= theme("/assets/js/jquery.min.js"); ?>"></script>
    <script src="<?= theme("/assets/js/jquery.form.js"); ?>"></script>
    <script src="<?= theme("/assets/js/jquery.mask.js"); ?>"></script>
    <script src="<?= theme("/assets/js/scripts.js"); ?>"></script>

    <?= $v->section("scripts"); ?>
</html>
