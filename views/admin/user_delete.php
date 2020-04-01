<?php
$u = $entityManager->getRepository('App\Utilisateur')->findOneBy(['id' => $id]);
$posts = $entityManager->getRepository('App\Post')->findBy(['utilisateur' => $u]);
foreach ($posts as $p) {
     $entityManager->remove($p);
}
$entityManager->remove($u);
$entityManager->flush();
header('Location: /admin/users');
exit();
