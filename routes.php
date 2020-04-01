<?php

require_once "bootstrap.php";

use App\Api;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/', function () use ($entityManager) {
     require_once 'views/post/index.php';
})->name('home');

Router::get('/archives', function () use ($entityManager) {
     require_once 'views/post/archives.php';
})->name('archives');

Router::form('/post/{id}', function (int $id) use ($entityManager) {
     require_once 'views/post/show.php';
})->where(['id' => '[0-9]+'])->name('post');

Router::form('/login', function () use ($entityManager) {
     require_once 'views/auth/login.php';
})->name('login');

Router::form('/register', function () use ($entityManager) {
     require_once 'views/auth/register.php';
})->name('register');

Router::post('/logout', function () {
     session_destroy();
     header('Location: ' . $_SERVER['HTTP_REFERER']);
     exit();
})->name('logout');

Router::group(['prefix' => '/admin'], function () use ($entityManager) {
     if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
          Router::get('/posts', function () use ($entityManager) {
               require_once 'views/admin/posts.php';
          })->name('admin_posts');

          Router::form('/post/new', function () use ($entityManager) {
               require_once 'views/admin/new.php';
          })->name('admin_new');

          Router::get('/post/delete/{id}', function (int $id) use ($entityManager) {
               require_once 'views/admin/delete.php';
          })->name('admin_delete')->where(['id' => '[0-9]+']);

          Router::form('/post/edit/{id}', function (int $id) use ($entityManager) {
               require_once 'views/admin/edit.php';
          })->name('admin_edit')->where(['id' => '[0-9]+']);

          Router::get('/users', function () use ($entityManager) {
               require_once 'views/admin/users.php';
          })->name('admin_users');

          Router::get('/user/delete/{id}', function (int $id) use ($entityManager) {
               require_once 'views/admin/user_delete.php';
          })->name('admin_user_delete')->where(['id' => '[0-9]+']);
     }
});

Router::group(['prefix' => '/api'], function () use ($entityManager) {

     $postRepository = $entityManager->getRepository('App\Post');
     $userRepository = $entityManager->getRepository('App\Utilisateur');

     Router::get('/users', function () use ($userRepository) {
          return Api::getAll($userRepository);
     });

     Router::get('/user/{id}', function (int $id) use ($userRepository) {
          return Api::getOneById($userRepository, $id);
     })->where(['id' => '[0-9]+']);

     Router::get('/posts', function () use ($postRepository) {
          return Api::getAll($postRepository);
     });

     Router::get('/post/{id}', function (int $id) use ($postRepository) {
          return Api::getOneById($postRepository, $id);
     })->where(['id' => '[0-9]+']);
});

Router::error(function(Request $request, \Exception $exception) {

     if($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
         response()->redirect('/');
     }
     
 });