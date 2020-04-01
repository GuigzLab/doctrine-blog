<?php

if (isset($_SESSION['id'])) {
     $redirect = (isset($_SERVER['HTTP_REFERER'])) ?  $_SERVER['HTTP_REFERER'] : '/';
     header('Location: ' . $redirect);
     exit();
}

if (isset($_POST['login'], $_POST['passwd'])) {
     $userRepository = $entityManager->getRepository('App\Utilisateur');
     $user = $userRepository->findOneBy(['login' => $_POST['login']]);
     if ($user !== null) {
          if (password_verify($_POST['passwd'], $user->getPasswd())) {
               $_SESSION['id'] = $user->getId();
               $_SESSION['login'] = $user->getLogin();
               $_SESSION['role'] = $user->getRole();
               header('Location: ' . $_POST['uri']);
               exit();
          } else {
               $error = 'Combinaison nom d\'utilisateur / mot de passe incorrecte.';
          }
     } else {
          $error = 'Combinaison nom d\'utilisateur / mot de passe incorrecte.';
     }
}

?>

<h1>Se connecter</h1>

<?php if (isset($error)) : ?>
     <div class="alert alert-danger">
          <?= $error ?>
     </div>
<?php endif ?>

<form method="POST">
     <div class="form-group">
          <label for="login">Pseudo</label>
          <input type="text" class="form-control" id="login" placeholder="Toto" name="login" required>
     </div>
     <div class="form-group">
          <label for="passwd">Mot de passe</label>
          <input type="password" class="form-control" id="passwd" placeholder="🞄🞄🞄🞄🞄🞄🞄" name="passwd" required>
     </div>
     <input type="hidden" name="uri" value="<?= (isset($_POST['uri'])) ? $_POST['uri'] : (isset($_SERVER['HTTP_REFERER'])) ?  $_SERVER['HTTP_REFERER'] : '/'  ?>">
     <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<a href="/register" class="mt-5 text-center d-block">S'inscrire</a>