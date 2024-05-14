<?php

namespace App\Controllers;

use App\Models\Book_model;

class Book extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new Book_model();
    }

    public function index()
    {
        $data['book_info'] = $this->bookModel->getBookInfo();
        $data['Header'] = 'This is the new Header';
        echo view('template/header', $data);
        echo view('book/index', $data);
        echo view('template/footer');
    }

    public function createBook()
    {
        $data['Title'] = "Add Book Record";
    
        if ($this->request->getMethod() == "POST") {
            $validation = \Config\Services::validation();
    
            $rules = [
                "Name" => [
                    "label" => "Book Name",
                    "rules" => "required|min_length[3]|max_length[100]"
                ],
                "Quantity" => [
                    "label" => "Book Quantity",
                    "rules" => "required|numeric"
                ],
                "Price" => [
                    "label" => "Book Price",
                    "rules" => "required|numeric"
                ],
                "Description" => [
                    "label" => "Book Description",
                    "rules" => "required"
                ]
            ];
    
            if ($this->validate($rules)) {
                $postdata = [
                    "name" => $this->request->getVar("Name"),
                    "qty" => $this->request->getVar("Quantity"),
                    "price" => $this->request->getVar("Price"),
                    "description" => $this->request->getVar("Description")
                ];
                $result = $this->bookModel->insertBookRecord($postdata);
                if ($result == 1) {
                    return redirect()->to('/book/index');
                }
            } else {
                $data["validation"] = $validation->getErrors();
            }
        }
    
        $data['Title'] = 'ITEC 222 Title';
        $data['Header'] = 'This is the new Header';
        echo view('template/header');
        echo view('book/addBook', $data);
        echo view('template/footer');
    }
    
    public function editBook($id)
    {
        $data['Title'] = "Edit Book Record";
    
        $data['book_info'] = $this->bookModel->getBookById($id);
    
        if ($this->request->getMethod() == "POST") {
    
            $validation = \Config\Services::validation();
    
            $rules = [
                "Name" => [
                    "label" => "Book Name",
                    "rules" => "required|min_length[3]|max_length[100]"
                ],
                "Quantity" => [
                    "label" => "Book Quantity",
                    "rules" => "required|numeric"
                ],
                "Price" => [
                    "label" => "Book Price",
                    "rules" => "required|numeric"
                ],
                "Description" => [
                    "label" => "Book Description",
                    "rules" => "required"
                ]
            ];
    
            if ($this->validate($rules)) {
                $postdata = [
                    "name" => $this->request->getVar("Name"),
                    "qty" => $this->request->getVar("Quantity"),
                    "price" => $this->request->getVar("Price"),
                    "description" => $this->request->getVar("Description")
                ];
                $result = $this->bookModel->updateBookRecord($id, $postdata);
    
                if ($result == 1) {
                    return redirect()->to('/book/index');
                }
            } else {
                $data["validation"] = $validation->getErrors();
            }
        }
    
        $data['Title'] = 'ITEC 222 Title';
        $data['Header'] = 'This is the new Header';
        echo view('template/header');
        echo view('book/editBook', $data);
        echo view('template/footer');
    }
    

    public function deleteBook($id)
    {
        $result = $this->bookModel->deleteBookRecord($id);

        if ($result == 1) {
            return redirect()->to('/book/index');
        }
    }
}
