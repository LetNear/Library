<?php

namespace App\Controllers;

use App\Models\Cart_model;
use App\Models\Book_model;
use App\Models\User_model;

class Cart extends BaseController
{
    protected $cartModel;



    public function __construct()
    {
        $this->Cart_model = new Cart_model();
        $this->Book_model = new Book_model();
        $this->User_model = new User_model();

    }

    public function index()
    {
        // Fetch cart information
        $data['cart_info'] = $this->Cart_model->getCartInfo();

  

        // Load views with data
        echo view('template/header', $data);
        echo view('cart/index', $data);
        echo view('template/footer');
    }


    public function addToCart()
    {
        echo "add rto cart";
        $data['books'] = $this->Book_model->getBookInfo();
        $data['users'] = $this->User_model->getUserInfo();
        echo view('template/header', $data);
        echo view('cart/addCart', $data);
        echo view('template/footer');

    }

    public function addCart()
    {

        $validation = \Config\Services::validation();

        $rules = [

            "book_id" => [
                "label" => "book",
                "rules" => "required"
            ],
            "user_id" => [
                "label" => "User",
                "rules" => "required"
            ],
            "quantity" => [
                "label" => "Quantity",
                "rules" => "required|numeric|greater_than[0]"
            ],

        ];
        if (!$this->validate($rules)) {
            $data["validation"] = $validation->getErrors();
            echo view('template/header', $data);
            echo view('cart/addCart', $data);
            echo view('template/footer');
            return;
        }

        $postdata = array(
            "book_id" => $this->request->getVar("book_id"),
            "user_id" => $this->request->getVar("user_id"),
            "quantity" => $this->request->getVar("quantity"),
        );

        $book = $this->Book_model->getBookById($postdata['book_id']);
        if($book['qty'] < $postdata['quantity']) {
            return redirect()->back()->with('error', 'Quantity is not available.');
        }
        $bookData = $book;
        $bookData['qty'] = $book['qty'] - $postdata['quantity'];

        $this->Book_model->updateBookRecord($book['id'], $bookData);
        $result = $this->Cart_model->insertCartItem($postdata);


        if ($result == 1) {
            return redirect()->to('/cart/index');
        }
    }

    public function removeFromCart($cartId)
    {
        // Retrieve the cart item from the database
        $cartItem = $this->Cart_model->getCartItemById($cartId);
    
        if (!$cartItem) {
            return redirect()->back()->with('error', 'Cart item not found.');
        }
    
        // Remove the item from the cart
        $this->Cart_model->deleteCartItem($cartId);
    
        // Update the quantity of the book in the book table by increasing it by the quantity that was removed
        $this->Book_model->increaseBookQuantity($cartItem['book_id'], $cartItem['quantity']);
    
        // Redirect back to the cart page
        return redirect()->to('/cart/index')->with('success', 'Item removed from cart.');
    }
    
}
