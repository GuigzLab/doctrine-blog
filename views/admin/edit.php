<?php
$p = $entityManager->getRepository('App\Post')->findOneBy(['id' => $id]);

if (isset($_POST['title'], $_POST['texte'])) {
     $p->setTitle($_POST['title']);
     $p->setTexte($_POST['texte']);
     $entityManager->flush();
}

?>
<h1>Modifier le billet n° <?= $p->getId() ?></h1>
<form class="mt-3" method="POST">
     <div class="form-group">
          <label for="title">Titre</label>
          <input type="text" class="form-control" id="title" placeholder="Titre du billet" name="title" value="<?= $p->getTitle() ?>">
     </div>
     <div class="form-group">
          <label for="content">Contenu</label>
          <textarea class="form-control" id="content" rows="3" placeholder="Contenu du billet" name="texte"><?= $p->getTexte() ?></textarea>
     </div>
     <button type="submit" class="btn btn-primary">Modifier le billet</button>
</form>