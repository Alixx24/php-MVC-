<?php

namespace Application\Model;

class User extends Model
{

    public function all()
    {
     
        $query = "SELECT * FROM `users`; ";
        $result = $this->query($query)->fetchAll();

        $this->closeConnection();

        return $result;
    }

   
    

    public function find($id)
    { 
        $query = "SELECT * FROM `users` WHERE id = ? ";
        $result = $this->query($query, array($id))->fetch();
        $this->closeConnection();
        return $result;
    }

     public function findByName($id)
    { 
        $query = "SELECT * FROM `users` WHERE username = ? ";
        $result = $this->query($query, array($id))->fetch();
        $this->closeConnection();
        return $result;
    }

    public function findByUsernameOrEmail($userNameOrEmail)
    {
        $query = "SELECT * FROM `users` WHERE username = ? OR email = ?";
        $result = $this->query($query, array($userNameOrEmail, $userNameOrEmail))->fetch();
        $this->closeConnection();
        return $result;
    }

    public function insert($values)
    { 
        $query = "INSERT INTO `users` ( `email`, `username`, `password`, created_at) VALUES ( ?, ?, ?, now() );";
        $this->execute($query, array_values($values));
        $this->closeConnection();
    }

    public function update($id, $values)
    { 
        $query = "UPDATE `categories` SET `name` = ?, `description` = ?,  `updated_at`= now()  WHERE `id` = ? ;" ;
        $this->execute($query, array_merge( array_values($values), [$id]));
        $this->closeConnection();
    }

    public function delete($id)
    { 
        $query = "DELETE FROM `categories` WHERE `id` = ? ;";
        $this->execute($query, [$id]);
        $this->closeConnection();
    }
}
