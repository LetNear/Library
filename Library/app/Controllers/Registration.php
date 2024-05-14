<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\User_model;

class Registration extends Controller
{
    public function index()
    {
        // Load view for registration page
        return view('login/register');
    }

    public function create()
    {
        // Load the model
        $userModel = new User_model();

        // Get the input values from the form
        $data = [
            'name' => $this->request->getPost('name'),
            'fullName' => $this->request->getPost('fullName'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        // Insert user record into database
        $userModel->insertUserRecord($data);

        // Redirect to login page
        return redirect()->to('/login')->with('success', 'Registration successful, you can now login.');
    }
}
