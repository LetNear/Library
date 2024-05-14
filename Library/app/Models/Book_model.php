<?php

namespace App\Models;

use CodeIgniter\Model;

class Book_model extends Model
{
    protected $table = 'book';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'qty', 'price', 'description']; // Include 'description' field

    public function getBookInfo(): array
    {
        return $this->findAll(); // Retrieve all Book records
    }

    public function getBookById(int $id): ?array
    {
        return $this->find($id); // Retrieve a Book record by ID
    }

    public function insertBookRecord(array $data): bool
    {
        return $this->insert($data); // Insert a new Book record
    }

    public function updateBookRecord(int $id, array $data): bool
    {
        return $this->update($id, $data); // Update a Book record by ID
    }

    public function deleteBookRecord(int $id): bool
    {
        return $this->delete($id); // Delete a Book record by ID
    }

    public function increaseBookQuantity($bookId, $quantity)
    {
        // Retrieve the scent item from the database
        $bookItem = $this->getBookById($bookId);

        if ($bookItem) {
            // Increase the quantity of the book by the quantity being removed from the cart
            $newQuantity = $bookItem['qty'] + $quantity;

            // Update the scent item with the new quantity
            $data = [
                'qty' => $newQuantity
            ];

            $this->updateBookRecord($bookId, $data);
        }
    }

}
