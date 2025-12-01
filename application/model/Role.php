<?php

namespace Application\Model;

class Role extends Model{
    public function all()
    {
        $query = "SELECT * FROM `roles`; ";
        $result = $this->query($query)->fetchAll();
        $this->closeConnection();
        return $result;
    }
}