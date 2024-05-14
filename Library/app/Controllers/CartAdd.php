<?php

namespace App\Controllers;

use App\Models\Cart_model;
use App\Models\Book_model;
use App\Models\User_model;

class CartAdd extends BaseController
{
    protected $cartModel;
    protected $bookModel;
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->cartModel = new Cart_model();
        $this->bookModel = new Book_model();
        $this->userModel = new User_model();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        // Fetch cart information
        $cartItems = $this->cartModel->getUserCarts($this->session->get('user_id'));

        // Prepare data to pass to the view
        $data = [
            'cartItems' => $cartItems,
        ];


        echo view('home/cart', $data);
    }

    public function add()
    {
        $postdata = array(
            "book_id" => $this->request->getVar("book_id"),
            "user_id" => $this->session->get('user_id'),
            "quantity" => $this->request->getVar("quantity"),
        );


        $book = $this->bookModel->getBookById($postdata['book_id']);
        if ($book['qty'] < $postdata['quantity']) {
            return redirect()->back()->with('error', 'Quantity is not available.');
        }
        $bookData = $book;
        $bookData['qty'] = $book['qty'] - $postdata['quantity'];

        $this->bookModel->updateBookRecord($book['id'], $bookData);
        $result = $this->cartModel->insertCartItem($postdata);


        if ($result == 1) {
            return redirect()->to('/cartAdded/index');
        }
    }
}
