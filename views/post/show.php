<?php

use App\Commentaire;

$postRepository = $entityManager->getRepository('App\Post');
$commentRepository = $entityManager->getRepository('App\Commentaire');
$userRepository = $entityManager->getRepository('App\Utilisateur');

$post = $postRepository->findOneBy(['id' => $id]);
$user = $userRepository->findOneBy(['id' => $post->getUtilisateur()->getId()]);

$comments = $commentRepository->findBy(['post' => $post]);


if (isset($_POST['content'])) {
     $uri = $_SERVER['REQUEST_URI'];
     $cUser = $userRepository->findOneBy(['id' => $_SESSION['id']]);
     $message = new Commentaire();
     $message->setTexte($_POST['content']);
     $message->setUtilisateur($cUser);
     $message->setPost($post);
     $entityManager->persist($message);
     $entityManager->flush();
     header('Location: '.$uri);
     exit();
}

?>

<h1><?= $post->getTitle() ?></h1>
<p><?= $post->getTexte() ?></p>
<hr>
<small>Publié le <?= $post->getDatepost()->format('d/m/Y à H:i:s') ?> par <?= $user->getLogin() ?></small>
<h3 class="mt-3">Commentaires</h3>
<button class="btn btn-warning" id="showComments" onclick="$('.comments').fadeToggle();">Afficher / Masquer</button>
<div class="comments">
     <?php foreach ($comments as $c) : ?>
          <div class="card my-3" style="max-width: 30em">
               <div class="card-header">
                    <?= $userRepository->findOneBy(['id' => $c->getUtilisateur()->getId()])->getLogin()  ?>
                    <small class="float-right"><?= $c->getDatepost()->format('d/m/Y à H:i:s') ?></small>
               </div>
               <div class="card-body">
                    <?= $c->getTexte() ?>
                    <br>
               </div>
          </div>
     <?php endforeach ?>
     <?php if (isset($_SESSION['login'])) : ?>
          <form method="POST" class="my-4">
               <div class="form-group">
                    <label for="comment">Publier un commentaire</label>
                    <textarea class="form-control" id="comment" rows="3" name="content" required></textarea>
               </div>
               <button type="submit" class="btn btn-primary">Publier le commentaire</button>
          </form>
     <?php else: ?>
          <div class="alert alert-secondary my-4">Vous devez vous connecter pour pouvoir poster un commentaire</div>
     <?php endif ?>
</div>