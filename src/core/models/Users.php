<?php

namespace models;

use services\Connect;

class Users
{
    // **** Constants ****
    private const UPLOAD_DIRECTORY = __DIR__ . '/../../uploads/';
    private const DEFAULT_AVATAR = 'default_avatar.png';


    // **** Actions with users ****
    public function getAllUsers()
    {
        $query = Connect::Connect()->query("SELECT * FROM `users`");
        if(!$query){
            throw new \Exception();
        }
        return mysqli_fetch_all($query);
    }
    public function getOneUser($id)
    {
        $query = Connect::Connect()->query("SELECT * FROM `users` where id = '$id'");
        if(!$query){
            throw new \Exception();
        }
        return mysqli_fetch_assoc($query);
    }
    public function deleteUser($id, $path)
    {
        $this->deleteImage($path);
        Connect::Connect()->query("DELETE FROM `users` WHERE `users`.`id`='$id'");
    }
    public function addUsers($email, $password, $avatar)
    {
        $path = $this->addImage($avatar);
        Connect::Connect()->query("INSERT INTO `users`(`id`, `email`, `password`, `image`) VALUES (NULL,'$email','$password','$path')");
    }
    public function redactUser($id, $email, $password, $avatar)
    {
        Connect::Connect()->query("UPDATE `users` SET `email`='$email',`password`='$password',`image`='$avatar' WHERE `id`='$id'") ? true : false;
    }


    // **** Actions with avatars ****
    public function DeleteAvatar($id, $path)
    {
        $this->deleteImage($path);
        $DefaultImage = self::DEFAULT_AVATAR;
        Connect::Connect()->query("UPDATE `users` SET `image`='$DefaultImage' WHERE id = $id");
    }
    public function UpdateAvatar($id, $avatar, $avatar_current)
    {
        $this->deleteImage($avatar_current);
        $path = $this->addImage($avatar);
        Connect::Connect()->query("UPDATE `users` SET `image`='$path' WHERE id = $id");
    }


    // **** Actions with the session ****
    public function loginUser($email, $password)
    {
        if ($email == null || $password == null)
        {
            die("Поля пустые");
        }
        $user = mysqli_fetch_assoc(Connect::Connect()->query("SELECT * FROM `users` WHERE email = '$email'"));
        if(!$user){
            die("Пользователь $email не найден");
        }
//        if($user['email'] == $email && $user['password'] == $password)
        if(password_verify($password, $user['password']))
        {
            $_SESSION["user"] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'password' => $user['password'],
                'image' => $user['image'],
                'role' => $user['role']
            ];
        } else {
            die("Неверный логин или пароль");
        }
    }
    public function registerUser($email, $password, $confirm_password)
    {
        $path = self::DEFAULT_AVATAR;
        if ($password!==$confirm_password){
            die("Пароли не совпали");
        } elseif ($email==null || $password==null){
            die("Поля пустые");
        }
        $mbUser = mysqli_fetch_assoc(Connect::Connect()->query("SELECT * FROM `users` WHERE `users` . `email`='$email'"));
        if ($mbUser){
            die("Такой пользователь уже есть");
        } else {
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $query = Connect::Connect()->query("INSERT INTO `users`(`id`,`email`,`password`, `image`) VALUES (NULL,'$email','$pass','$path')");
            if (!$query)
            {
                die ('Ошибка регистрации');
            }
        }
    }


    // **** Actions with images ****
    public function addImage($image)
    {
        if ($image['error'] === UPLOAD_ERR_OK && $image['name'] !== self::DEFAULT_AVATAR) {
            if (!is_dir(self::UPLOAD_DIRECTORY)) {
                mkdir(self::UPLOAD_DIRECTORY, 0777, true);
            }
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $fileName = 'avatar' . time() . ".$ext";
            $filePath = self::UPLOAD_DIRECTORY . $fileName;
            if (move_uploaded_file($image['tmp_name'], $filePath)) {
                return $fileName;
            } else {
                return "Ошибка: Не удалось переместить загруженный файл.";
            }
        }
        return self::DEFAULT_AVATAR;
    }
    public function deleteImage($fileName)
    {
        $filePath = self::UPLOAD_DIRECTORY . $fileName;
        if ($fileName !== self::DEFAULT_AVATAR && file_exists($filePath))
        {
            unlink($filePath);
        }
    }
}