<?php
$postRepository = $entityManager->getRepository('App\Post');
$posts = $postRepository->findBy([],['datepost' => 'DESC']);

function strWordCut($string, $length = 65, $end = '...')
{
     $string = strip_tags($string);
     if (strlen($string) > $length) {
          $stringCut = substr($string, 0, $length);
          $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . $end;
     }
     return $string;
}

?>

<h1>Tous les articles</h1>

<?php foreach ($posts as $post) : ?>
     <div class="card my-4">
          <div class="card-body">
               <h5 class="card-title"><?= $post->getTitle() ?></h5>
               <p class="card-text"><?= strWordCut($post->getTexte()) ?></p>
               <a href="<?= url('post', ['id' => $post->getId()]) ?>" class="card-link">Lire l'article en entier</a>
          </div>
     </div>
<?php endforeach ?>