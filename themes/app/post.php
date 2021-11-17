<?php $v->layout("_theme"); ?>

<?php if(!$post): ?>
  
  <header class="title-header">
      <h1>Cadastrar Enquete</h1>
  </header>
    <div class="box-btn">
      <a href="<?= url("/"); ?>" class="btn  box-shadow btn-blue">Voltar</a>
    </div>
<section class="box-container-form">
      <form class="app_form box-shadow"  action="<?= url("/cadastrar"); ?>" method="post">

        <?= csrf_input(); ?>
      <input type="hidden" name="action" value="create"/>

      <label>
          <span>Titulo da Enquete</span>
          <input type="text" name="title" placeholder="Titulo da Enquete"/>
      </label>
      <div class="form-group">
          <label>
              <span>Data Inicio</span>
              <input type="text" name="start_time" class="mask-datetime"  value="<?= date("d/m/Y H:i"); ?>"/>
          </label>
          <label>
            <span>Data Final</span>
            <input type="text" name="end_time" class="mask-datetime"  value="<?= date("d/m/Y H:i"); ?>"/>
          </label>
      </div>
        <button type="submit" class="btn btn-green">Cadastrar</button>
      </form>
</section>

<?php else: ?>

    <header class="title-header">
        <h1>Atualizar <?= $post->title; ?></h1>
    </header>
    <div class="box-btn">
      <a href="<?= url("/"); ?>" class="btn  box-shadow btn-blue">Voltar</a>
    </div>
<section class="box-container-form">
      <form class="app_form"  action="<?= url("/update/{$post->id}"); ?>" method="post">
        <?= csrf_input(); ?>
          <input type="hidden" name="action" value="update"/>
          <label>
              <span>Titulo da Enquete</span>
              <input type="text" name="title" value="<?= $post->title; ?>" placeholder="Titulo da Enquete"/>
          </label>
            <div class="form-group">
              <label>
                  <span>Data Inicio</span>
                  <input type="text" name="start_time" class="mask-datetime"  value="<?= date_fmt($post->start_time); ?>"/>
              </label>
              <label>
                <span>Data Final</span>
                <input type="text" name="end_time" class="mask-datetime"  value="<?=date_fmt($post->end_time); ?>"/>
              </label>
            </div>

          <button type="submit" class="btn btn-blue">Atualizar</button>
      </form>
<?php endif; ?>
</section>
