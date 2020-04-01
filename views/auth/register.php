<?php

use App\Utilisateur;

if (isset($_SESSION['id'])) {
     $redirect = (isset($_SERVER['HTTP_REFERER'])) ?  $_SERVER['HTTP_REFERER'] : '/';
     header('Location: ' . $redirect);
     exit();
}

if (isset($_POST['login'], $_POST['passwd'])) {
     $userRepository = $entityManager->getRepository('App\Utilisateur');
     $user = $userRepository->findOneBy(['login' => $_POST['login']]);
     if ($user === null) {
          $u = new Utilisateur();
          $u->setLogin($_POST['login']);
          $u->setPasswd(password_hash($_POST['passwd'], PASSWORD_BCRYPT));
          $u->setRole('user');
          $entityManager->persist($u);
          $entityManager->flush();
          header('Location : /home');
          exit();
     } else {
          $error = 'Pseudo indisponible';
     }
}

?>

<h1>S'inscrire</h1>

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
     <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>