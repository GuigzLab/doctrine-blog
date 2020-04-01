<?php
$uostRepository = $entityManager->getRepository('App\Utilisateur');
$users = $uostRepository->findAll();
?>

<h1>Administration</h1>

<table class="table mt-3">
     <thead>
          <tr>
               <th scope="col">#</th>
               <th scope="col">Pseudo</th>
               <th scope="col">Actions</th>
          </tr>
     </thead>
     <tbody>
          <?php foreach ($users as $u) : ?>
               <tr>
                    <th scope="row"><?= $u->getId() ?></th>
                    <td><?= $u->getLogin() ?></td>
                    <td>
                         <a href="/admin/user/delete/<?=$u->getId()?>" class="btn btn-sm btn-danger" onclick="return confirm('Voulez vous vraiment effectuer cette action ?')">Supprimer</a>
                    </td>
               </tr>
          <?php endforeach ?>
     </tbody>
</table>