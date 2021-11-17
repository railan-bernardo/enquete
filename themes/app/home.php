<?php $v->layout("_theme"); ?>


  <header class="title-header">
      <h1>Sistema de Votação</h1>
  </header>
    <div class="box-btn">
      <a href="<?= url("/cadastrar"); ?>" class="btn  box-shadow btn-green">adicionar</a>
    </div>
    <section class="box-content">
       <?php if(!$enquetes): ?>
         <p class="p-text">Não tem enquete cadastrada</p>
       <?php else: ?>
          <article class="box-card">
            <h2>Emquetes Não iniciadas</h2>
            <?php foreach($enquetes as $enquete): ?>

                  <?php if(date_fmt($enquete->start_time) > date("d/m/Y H\hi")): ?>
                        <div class="card">
                              <h3>Titulo: <?= $enquete->title; ?></h3>
                              <p>Inicio: <time> <?= date_fmt($enquete->start_time); ?></time> Termina em: <time><?= date_fmt($enquete->end_time); ?></time></p>
                              <div class="progress radius box-shadow">
                                <span class="count"> <?= $enquete->voto; ?>%</span>
                                <div class="percent radius"  style="width: <?= $enquete->voto; ?>%;"></div>
                              </div>
                              <div class="btn-group">
                                  <a class="btn btn-yellow" href=" <?= url("/update/{$enquete->id}"); ?>">Editar</a>
                                  <button  class="btn btn-red" title="" href="#"
                                                                 data-post="<?= url("/cadastrar"); ?>"
                                                                 data-action="delete"
                                                                 data-confirm="Tem certeza que deseja deletar essa enquete?"
                                                                 data-enquete_id="<?= $enquete->id; ?>">Deletar</button>
                                 <button disabled class="btn btn-blue" title="" href="#"
                                                                data-post="<?= url("/cadastrar"); ?>"
                                                                data-action="voto"
                                                                data-enquete_id="<?= $enquete->id; ?>">Votar</button>
                              </div>
                        </div>
                  <?php endif; ?>

          <?php endforeach; ?>
        </article>

    <article class="box-card">
      <h2>Emquetes Em Andamentos</h2>
      <?php foreach($enquetes as $enquete): ?>

    <?php if(date("d/m/Y H\hi") >= date_fmt($enquete->start_time)  && date_fmt($enquete->end_time) >= date("d/m/Y H\hi")): ?>

                  <div class="card">
                          <h3>Titulo: <?= $enquete->title; ?></h3>
                          <p>Inicio: <time> <?= date_fmt($enquete->start_time); ?></time> Termina em: <time><?= date_fmt($enquete->end_time); ?></time></p>
                          <div class="progress radius box-shadow">
                            <span class="count"><?= $enquete->voto; ?>%</span>
                            <div class="percent radius"  style="width: <?= $enquete->voto; ?>%;"></div>
                          </div>
                          <div class="btn-group">
                                <a class="btn btn-yellow" href=" <?= url("/update/{$enquete->id}"); ?>">Editar</a>
                                <button class="btn btn-red" title="" href="#"
                                                               data-post="<?= url("/cadastrar"); ?>"
                                                               data-action="delete"
                                                               data-confirm="Tem certeza que deseja deletar essa enquete?"
                                                               data-enquete_id="<?= $enquete->id; ?>">Deletar</button>
                               <button  class="btn btn-blue" title="" href="#"
                                                              data-post="<?= url("/cadastrar"); ?>"
                                                              data-action="voto"
                                                              data-enquete_id="<?= $enquete->id; ?>">Votar</button>
                          </div>
                  </div>
  <?php endif; ?>

    <?php endforeach; ?>
  </article>

    <article class="box-card">
        <h2>Emquetes Finalizadas</h2>
      <?php foreach($enquetes as $enquete): ?>

        <?php if(date_fmt($enquete->end_time) < date("d/m/Y H\hi")): ?>
            <div class="card">
                  <h3>Titulo: <?= $enquete->title; ?></h3>
                  <p>Inicio: <time> <?= date_fmt($enquete->start_time); ?></time> Termina em: <time><?= date_fmt($enquete->end_time); ?></time></p>
                  <div class="progress radius box-shadow">
                    <span class="count"><?= $enquete->voto; ?>%</span>
                    <div class="percent radius" style="width: <?= $enquete->voto; ?>%;"></div>
                  </div>
                  <div class="btn-group">
                        <button disabled class="btn btn-yellow">Editar</button>
                        <button disabled class="btn btn-red" title="" href="#"
                                                       data-post="<?= url("/cadastrar"); ?>"
                                                       data-action="delete"
                                                       data-confirm="Tem certeza que deseja deletar essa enquete?"
                                                       data-enquete_id="<?= $enquete->id; ?>">Deletar</button>
                       <button disabled class="btn btn-blue" title="" href="#"
                                                      data-post="<?= url("/cadastrar"); ?>"
                                                      data-action="voto"
                                                      data-enquete_id="<?= $enquete->id; ?>">Votar</button>
                  </div>
            </div>
          <?php endif; ?>
    <?php endforeach; ?>
  </article>
<?php endif; ?>
</section>
