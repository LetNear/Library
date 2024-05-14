<?php

namespace App\Models;

use CodeIgniter\Model;

use CodeIgniter\Database\MySQLi\Result;

class Cart_model extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'book_id', 'quantity'];

    public function getCartInfo(): array
    {
        return $this->findAll(); // Retrieve all cart items
    }

    public function getUserCarts($id)
    {
        return $this->db->query("SELECT c.id as cart_id, c.*, s.* FROM cart c JOIN book s ON s.id = c.book_id JOIN user u on u.userID = c.user_id WHERE u.userID = $id")->getResultArray();
    }

    public function getCartItemById(int $id): ?array
    {
        return $this->find($id); // Retrieve a cart item by ID
    }

    public function insertCartItem(array $data): bool
    {
        return $this->insert($data); // Insert a new cart item
    }

    public function updateCartItemQuantity(int $id, int $quantity): bool
    {
        return $this->update($id, ['quantity' => $quantity]); // Update cart item quantity by ID
    }

    public function deleteCartItem(int $id): bool
    {
        return $this->delete($id); // Delete a cart item by ID
    }
}
