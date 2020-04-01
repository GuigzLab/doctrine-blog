<?php
$p = $entityManager->getRepository('App\Post')->findOneBy(['id' => $id]);
$comments = $entityManager->getRepository('App\Commentaire')->findBy(['post' => $p]);
foreach ($comments as $c) {
     $entityManager->remove($c);
}
$entityManager->remove($p);
$entityManager->flush();
header('Location: /admin/posts');
exit();
