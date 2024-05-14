<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    protected $table = 'user'; // Set the table name

    protected $allowedFields = ['nickName', 'fullName', 'email', 'password']; // Specify the fields that can be mass-assigned

    public function getUserInfo()
    {
        return $this->findAll(); // Retrieve all user records
    }
    public function getUserInfobyID()
{
    return $this->select('userID')->findAll(); // Retrieve all user records with only the 'userID' column
}


    public function getUserInfoBySN($SN)
    {
        return $this->where('userID', $SN)->first(); // Retrieve a user record by userID
    }

    public function getUserInfoByEmail($email)
    {
        return $this->select('userID, nickName, fullName, email, password')->where('email', $email)->first();
    }
    

    public function insertUserRecord($data)
    {
        return $this->insert($data); // Insert a new user record
    }

    public function updateUserRecord($userID, $data)
    {
        return $this->update(['userID' => $userID], $data); // Update a user record by userID
    }

    // public function deleteUserRecord($SN)
    // {
    //     return $this->delete($SN); // Delete a user record by userID
    // }

    public function deleteUserRecord(int $userID): bool
    {
        return $this->db->table('user')->where('userID', $userID)->delete(); 
    }
    

    public function getUserCart($userID)
    {
        // Assuming 'cart' is a separate model and represents the cart table
        $cartModel = new Cart_model();
        return $cartModel->where('user_id', $userID)->findAll(); // Retrieve cart details for a user
    }
}
