<?php
$postRepository = $entityManager->getRepository('App\Post');
$posts = $postRepository->findAll();
?>

<h1>Administration</h1>

<table class="table mt-3">
     <thead>
          <tr>
               <th scope="col">#</th>
               <th scope="col">Titre</th>
               <th scope="col">Auteur</th>
               <th scope="col">Date de publication</th>
               <th scope="col">Actions</th>
          </tr>
     </thead>
     <tbody>
          <?php foreach ($posts as $p) : ?>
               <tr>
                    <th scope="row"><?= $p->getId() ?></th>
                    <td><?= $p->getTitle() ?></td>
                    <td><?= $entityManager->getRepository('App\Utilisateur')->findOneBy(['id' => $p->getUtilisateur()])->getLogin() ?></td>
                    <td><?= $p->getDatepost()->format('d/m/Y à H:i:s') ?></td>
                    <td>
                         <a href="/admin/post/edit/<?=$p->getId()?>" class="btn btn-sm btn-warning">Modifier</a>
                         <a href="/admin/post/delete/<?=$p->getId()?>" class="btn btn-sm btn-danger" onclick="return confirm('Voulez vous vraiment effectuer cette action ?')">Supprimer</a>
                    </td>
               </tr>
          <?php endforeach ?>
     </tbody>
</table>
<div class="d-block mt-4 text-center">
     <a href="/admin/post/new" class="btn btn-primary"><strong>+</strong> Ajouter un article</a>
</div>