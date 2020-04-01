<?php
require __DIR__ . '/vendor/autoload.php';
// require "bootstrap.php";

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

use Pecee\SimpleRouter\SimpleRouter as Router;

/* Load external routes file */

require_once 'helpers.php';
require_once 'routes.php';

session_start();
if (!isset($_SESSION['role'])) {
     $_SESSION['role'] = 'user';
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Blog</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
     <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
          <a class="navbar-brand" href="/">Blog</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
               <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                         <a class="nav-link" href="/">Accueil</a>
                    </li>
                    <li class="nav-item active">
                         <a class="nav-link" href="/archives">Archives</a>
                    </li>
                    <?php if (isset($_SESSION) && $_SESSION['role'] === 'admin') : ?>
                         <li class="nav-item dropdown active">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   Administration
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                   <a class="dropdown-item" href="/admin/posts">Billets</a>
                                   <a class="dropdown-item" href="/admin/users">Utilisateurs</a>
                                   <div class="dropdown-divider"></div>
                                   <a class="dropdown-item" href="/admin/post/new"><strong>+</strong> Créer un billet</a>
                              </div>
                         </li>
                    <?php endif ?>
               </ul>
          </div>
          <?php if (isset($_SESSION['login'])) : ?>
               <form class="form-inline" action="/logout" method="POST">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Déconnexion</button>
               </form>
          <?php else : ?>
               <span>
                    <a href="<?= url('login') ?>" class="btn btn-outline-primary">Connexion</a>
               </span>
          <?php endif ?>
     </nav>
     <div class="container mt-4">
          <?php
          Router::start();
          ?>
     </div>
     <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>