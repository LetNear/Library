<?php

namespace App\Controllers;
use App\Models\Book_model;
use App\Models\User_model;

class Home extends BaseController
{

    public function __construct()
    {
        $this->bookModel = new Book_model();
        $this->UserModel = new User_model();

        
    }
   public function index(): string
    {
        $bookModel = new Book_model();
        $userModel = new User_model();

        // Get all book records
        $data['products'] = $bookModel->getBookInfo();

        // Get the first user's ID from the user records
        $userRecords = $userModel->getUserInfo();
        $data['user_id'] = !empty($userRecords) ? $userRecords[0]['userID'] : null;

        return view('home/home', $data);
    }
    
    
}
