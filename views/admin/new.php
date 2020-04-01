<?php

use App\Post;

if (isset($_POST['title'], $_POST['texte'])) {
     $p = new Post;
     $p->setTitle($_POST['title']);
     $p->setTexte($_POST['texte']);
     $p->setUtilisateur($entityManager->getRepository('App\Utilisateur')->findOneBy(['id' => $_SESSION['id']]));
     $entityManager->persist($p);
     $entityManager->flush();
     header('Location: /admin/posts');
     exit();
}

?>
<h1>Créer un biller</h1>
<form class="mt-3" method="POST">
     <div class="form-group">
          <label for="title">Titre</label>
          <input type="text" class="form-control" id="title" placeholder="Titre du billet" name="title">
     </div>
     <div class="form-group">
          <label for="content">Contenu</label>
          <textarea class="form-control" id="content" rows="3" placeholder="Contenu du billet" name="texte"></textarea>
     </div>
     <button type="submit" class="btn btn-primary">Créer</button>
</form>