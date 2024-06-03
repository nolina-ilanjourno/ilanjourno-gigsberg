<?php

namespace App\Controllers;

use App\Helpers\Validator;
use App\Helpers\View;
use App\Models\User;

class UsersController {
    private User $userModel;
    private Validator $validator;

    public function __construct() {
        $this->userModel = new User();
        $this->validator = new Validator();
    }

    public function index() {
        $users = $this->userModel->getAllUsers();
        return View::render('users/index.html.php', ['users' => $users]);
    }

    public function show(int $id) {
        header('Content-Type: application/json');
        if ($user = $this->userModel->getUserById($id)) {
            echo json_encode($user);
            exit(200);
        } else {
            echo json_encode([
                'errors' => ['User not found.']
            ]);
            exit(400);
        }
    }

    public function create() {
        return View::render('users/create.html.php');
    }

    public function store() {
        $data = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'birthdate' => $_POST['birthdate'],
            'url' => $_POST['url'],
            'phone_number' => $_POST['phone_number'],
        ];

        (bool) $isValid = $this->validator->validate($data, [
             'username' => 'required|letters',
            'email' => 'required|email',
            'password' => 'required|password',
            'birthdate' => 'required|date',
            'url' => 'required|url',
            'phone_number' => 'required|phone',
        ]);

         if ($isValid) {

            if ($this->userModel->createUser($data)) {
                header('Location: /');
                exit();
            } else {
                $errors = ['Failed to create user.'];
                return View::render('users/create.html.php', ['errors' => $errors, 'data' => $data]);
            }
        } else {
            return View::render('users/create.html.php', ['errors' => $this->validator->getErrors(), 'data' => $data]);
        }
    }

    public function destroy(int $id) {
        if (!$this->userModel->deleteUser($id)) {
            header('Content-Type: application/json');
            echo json_encode([
                'errors' => ['Failed to delete user.']
            ]);
            exit();
        }
    }

}
