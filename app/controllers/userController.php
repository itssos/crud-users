<?php
namespace app\controllers;

use app\models\mainModel;

class userController extends mainModel {
    
    public function registerUserController() {
        $name = $this->cleanChain($_POST['name']);
        $surname = $this->cleanChain($_POST['surname']);
        $user = $this->cleanChain($_POST['user']);
        $email = $this->cleanChain($_POST['email']);
        $password = $this->cleanChain($_POST['password']);
        $confirmPassword = $this->cleanChain($_POST['confirm_password']);

        $alert = $this->validateInputs($name, $surname, $user, $email, $password, $confirmPassword);
        if ($alert) {
            return json_encode($alert);
        }

        if ($email !== "" && $this->isEmailRegistered($email)) {
            $alert = $this->createAlert("Ocurrió un error inesperado", "El email que acaba de ingresar ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente", "error");
            return json_encode($alert);
        }

        if ($this->isUserRegistered($user)) {
            $alert = $this->createAlert("Ocurrió un error inesperado", "El nombre de usuario que acaba de ingresar ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente", "error");
            return json_encode($alert);
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ["cost"=>10]);
        
        // $query = "INSERT INTO users (name, surname, username, email, password) VALUES (:name, :surname, :username, :email, :password)";
        // $params = [
        //     'name' => $name,
        //     'surname' => $surname,
        //     'username' => $user,
        //     'email' => $email,
        //     'password' => $hashedPassword
        // ];
        // $this->executeQuery($query, $params);

        return json_encode($this->createAlert("Registro exitoso", "El usuario ha sido registrado correctamente", "success"));
    }

    private function validateInputs($name, $surname, $user, $email, $password, $confirmPassword) {
        if (empty($name) || empty($surname) || empty($user) || empty($password) || empty($confirmPassword)) {
            return $this->createAlert("Ocurrió un error inesperado", "No has llenado todos los campos que son obligatorios", "error");
        }

        if ($this->verifyData("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $name)) {
            return $this->createAlert("Ocurrió un error inesperado", "El Nombre no coincide con el formato solicitado", "error");
        }

        if ($this->verifyData("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $surname)) {
            return $this->createAlert("Ocurrió un error inesperado", "El Apellido no coincide con el formato solicitado", "error");
        }

        if ($this->verifyData("[a-zA-Z0-9]{4,20}", $user)) {
            return $this->createAlert("Ocurrió un error inesperado", "El Usuario no coincide con el formato solicitado", "error");
        }

        if ($this->verifyData("[a-zA-Z0-9$@.-]{7,100}", $password) || $this->verifyData("[a-zA-Z0-9$@.-]{7,100}", $confirmPassword)) {
            return $this->createAlert("Ocurrió un error inesperado", "Las Contraseñas no coinciden con el formato solicitado", "error");
        }

        if ($password !== $confirmPassword) {
            return $this->createAlert("Ocurrió un error inesperado", "Las contraseñas no coinciden", "error");
        }

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->createAlert("Ocurrió un error inesperado", "Ha ingresado un correo electrónico no valido", "error");
        }

        return null;
    }

    private function isEmailRegistered($email) {
        $query = "SELECT email FROM users WHERE email = :email";
        $stmt = $this->executeQuery($query, ['email' => $email]);
        return $stmt->rowCount() > 0;
    }

    private function isUserRegistered($user) {
        $query = "SELECT username FROM users WHERE username = :username";
        $stmt = $this->executeQuery($query, ['username' => $user]);
        return $stmt->rowCount() > 0;
    }

    private function createAlert($title, $text, $icon) {
        return [
            "type" => "simple",
            "title" => $title,
            "text" => $text,
            "icon" => $icon
        ];
    }
}
