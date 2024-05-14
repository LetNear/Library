<?php

namespace App\Controllers;


use App\Models\User_model;
use App\Models\Book_model;
use App\Models\Cart_model;


use CodeIgniter\Email\Email;
use Google\Service\BigQueryDataTransfer\UserInfo;

class Api extends BaseController
{


    public function __construct()
    {
        $this->UserModel = new User_model();
        $this->BookModel = new Book_model();
        $this->CartModel = new Cart_model();
    }

    public function users()
    {
        $users = $this->UserModel->getUserInfo();
        $response = [
            'code' => 200,
            'message' => 'Successfully fetched users',
            'data' => $users
        ];

        return $this->response->setJSON($response);
    }

    public function getUser($id)
    {
        $user = $this->UserModel->getUserInfoBySN($id);

        if (!$user) {
            $response = [
                'code' => 404,
                'message' => "No user found with id = $id",
                'data' => [],
            ];
        }

        $response = [
            'code' => 200,
            'message' => "Successfully fetched user with id = $id",
            'data' => $user
        ];

        return $this->response->setJSON($response);
    }

    public function getUserByEmail()
    {
        $email = $this->request->getGet('email');
        if (!$email) {
            $response = [
                'code' => 404,
                'message' => "No email sent",
                'data' => [],
            ];

            return $this->response->setJSON($response);
        }
        $userInfo = $this->UserModel->getUserInfoByEmail($email);
        if (!$userInfo) {
            $response = [
                'code' => 404,
                'message' => "No user found",
                'data' => [],
            ];

            return $this->response->setJSON($response);
        }


        $response = [
            'code' => 200,
            'message' => "Successfully fetched data",
            'data' => $userInfo,
        ];
        return $this->response->setJSON($response);
    }

    public function deleteUser($id)
    {
        $user = $this->UserModel->getUserInfoBySN($id);
        $this->UserModel->deleteUserRecord($id);

        return $this->response->setJSON([
            'code' => 200,
            'message' => 'User successfully deleted',
            'data' => $user,
        ]);
    }

    public function createUser()
    {

        $requestBody = json_decode($this->request->getBody());
        $name = $requestBody->username;
        $fullName = $requestBody->fullName;
        $email = $requestBody->email;
        $password = $requestBody->password;

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userData = [
            'name' => $name,
            'fullName' => $fullName,
            'email' => $email,
            'password' => $hashedPassword,
        ];



        $user = $this->UserModel->insertUserRecord($userData);

        if (!$user) {
            $response = [
                'code' => 500,
                'message' => "There was an unexpected error",
                'data' => $userData,
            ];
        }
        $response = [
            'code' => 200,
            'message' => 'Success',
            'data' => $user,
        ];

        return $this->response->setJSON($response);
    }

    public function updateUser($id)
    {
        $input = $this->request->getRawInput();
        $userData = $this->UserModel->getUserInfoBySN($id);
        $name = $input['UN'];
        $fullName = $input['UFN'];
        $email = $input['UE'];
        $password = $input['UP'];

        $userData = [
            'name' => $name,
            'fullName' => $fullName,
            'email' => $email,
            'password' => $password,
        ];

        $user = $this->UserModel->updateUserRecord($userData, $id);


        if (!$user) {
            $response = [
                'code' => 500,
                'message' => "There was an unexpected error",
                'data' => $userData,
            ];
        }

        $userData = $this->UserModel->getUserInfoBySN($id);

        $response = [
            'code' => 200,
            'message' => 'Success',
            'data' => $userData,
        ];

        return $this->response->setJSON($response);
    }

    public function getBook()
    {
        $book = $this->BookModel->getBookInfo();

        if (!$book) {
            $response = [
                'code' => 404,
                'message' => "No user book found",
                'data' => [],
            ];
        }

        $response = [
            'code' => 200,
            'message' => "Successfully fetched book",
            'data' => $book
        ];

        return $this->response->setJSON($response);
    }

    public function createBook()
    {
        $requestBody = json_decode($this->request->getBody());

        $name = $requestBody->name;
        $qty = $requestBody->qty;
        $price = $requestBody->price;
        $description = $requestBody->description;

        $bookdata = [
            'name' => $name,
            'qty' => $qty,
            'price' => $price,
            'description' => $description,

        ];

        $user = $this->BookModel->insertBookRecord($bookdata);

        if (!$user) {
            $response = [
                'code' => 500,
                'message' => "There was an unexpected error",
                'data' => $bookdata,
            ];
        }
        $response = [
            'code' => 200,
            'message' => 'Success',
            'data' => $user,
        ];

        return $this->response->setJSON($response);
    }

    public function updateBook($id)
    {
        $input = json_decode($this->request->getBody());
        $userData = $this->BookModel->getBookById($id);
        $name = $input->name;
        $quantity = $input->qty;
        $price = $input->price;
        $description = $input->description;

        $userData = [
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
            'description' => $description,
        ];

        $user = $this->BookModel->updateBookRecord($id,$userData);


        if (!$user) {
            $response = [
                'code' => 500,
                'message' => "There was an unexpected error",
                'data' => $userData,
            ];
        }

        $userData = $this->BookModel->getBookById($id);

        $response = [
            'code' => 200,
            'message' => 'Success',
            'data' => $userData,
        ];

        return $this->response->setJSON($response);
    }

    public function deleteBook($id)
    {
        $book = $this->BookModel->getBookById($id);
        $this->BookModel->deleteBookRecord($id);

        return $this->response->setJSON([
            'code' => 200,
            'message' => 'book successfully deleted',
            'data' => $book,
        ]);
    }

    public function cart($id)
    {
        $users = $this->CartModel->getUserCarts($id);
        $response = [
            'code' => 200,
            'message' => 'Successfully fetched cart data',
            'data' => $users
        ];

        return $this->response->setJSON($response);
    }

    public function createCart()
    {
        $requestBody = json_decode($this->request->getBody());
        $user_id = $requestBody->user_id;
        $book_id = $requestBody->book_id;
        $quantity = $requestBody->quantity;


        $cartdata = [
            'user_id' => $user_id,
            'book_id' => $book_id,
            'quantity' => $quantity,

        ];

        $user = $this->CartModel->insertCartItem($cartdata);

        if (!$user) {
            $response = [
                'code' => 500,
                'message' => "There was an unexpected error",
                'data' => $cartdata,
            ];
        }
        $response = [
            'code' => 200,
            'message' => 'Success',
            'data' => $user,
        ];

        return $this->response->setJSON($response);
    }

    public function updateCart($id)
    {
        $input = $this->request->getRawInput();
        $userData = $this->CartModel->getCartItemById($id);
        $user_id = $input['user_id'];
        $book_id = $input['book_id'];
        $quantity = $input['quantity'];


        $userData = [
            'user_id' => $user_id,
            'book_id' => $book_id,
            'quantity' => $quantity,

        ];

        $user = $this->CartModel->updateCartItemQuantity($userData, $id);


        if (!$user) {
            $response = [
                'code' => 500,
                'message' => "There was an unexpected error",
                'data' => $userData,
            ];
        }

        $userData = $this->CartModel->getCartItemById($id);

        $response = [
            'code' => 200,
            'message' => 'Success',
            'data' => $userData,
        ];

        return $this->response->setJSON($response);
    }

    public function deleteCart($id)
    {
        $user = $this->CartModel->getCartItemById($id);
        $this->CartModel->deleteCartItem($id);

        return $this->response->setJSON([
            'code' => 200,
            'message' => 'Cart successfully deleted',
            'data' => $user,
        ]);
    }

}
