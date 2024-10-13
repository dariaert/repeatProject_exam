<?php

namespace controllers;
use views\Views;
use models\Users;

class Controller
{
    public $view;
    public $users;

    public function __construct()
    {
        $this->view = new Views(__DIR__ . '/../../templates');
        $this->users = new Users();
    }

    public function getUsers($namePage)
    {
        try {
            return $this->view->render("pages/$namePage.php", ['AllUsers' => $this->users->getAllUsers()]);
        } catch (\Exception $e) {
            return $this->view->render("errors/error.php", ['error' => 'Не удалось получить список пользователей.']);
        }
    }
    public function getUser($namePage, $id)
    {
        try {
            return $this->view->render("pages/$namePage.php", ['OneUser' => $this->users->getOneUser($id)]);
        } catch (\Exception $e) {
            return $this->view->render("errors/error.php", ['error' => 'Не удалось получить информацию о пользователе.']);
        }
    }


    // **** Actions with users ****
    public function add()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $avatar = $_FILES['image'];
        $this->users->addUsers($email, $password, $avatar);
        header('location: /admin');
    }
    public function delete()
    {
        $id = $_POST['id'];
        $avatar = $_POST['image'];
        $this->users->deleteUser($id, $avatar);
        header('location: /admin');
    }
    public function redact()
    {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $avatar = $_POST['image'];
        $this->users->redactUser($id, $email, $password, $avatar);
        header ('location: /admin');
    }


    // **** Actions with images ****
    public function deleteImage()
    {
        $id = $_POST['id'];
        $avatar = $_POST['image'];
        $this->users->DeleteAvatar($id, $avatar);
        header('location: /admin');
    }
    public function updateImage()
    {
        $id = $_POST['id'];
        $avatar = $_FILES['image'];
        $avatar_current = $_POST['image_current'];
        $this->users->UpdateAvatar($id, $avatar, $avatar_current);
        header('location: /admin');
    }


    // **** Actions with the session ****
    public function auth()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $this->users->loginUser($email, $password);
        header('location: /');
    }
    public function reg()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $this->users->registerUser($email, $password, $confirm_password);
        header('location: /');
    }
    public function logout()
    {
        unset($_SESSION['user']);
        header('location: /');
    }

}