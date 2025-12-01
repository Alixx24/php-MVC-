<?php

namespace Application\Model;

class Role extends Model
{
    public function all()
    {
        $query = "SELECT * FROM `roles`; ";
        $result = $this->query($query)->fetchAll();
        $this->closeConnection();
        return $result;
    }

    public function insert($values)
    {
        $query = "INSERT INTO roles (name, description) VALUES (?, ?)";
        $this->execute($query, array_values($values));
        $this->closeConnection();
    }
}
