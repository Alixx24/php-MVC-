<?php

namespace Application\Controllers;

use Application\Model\Role as ModelRole;

class Role extends Controller
{
    public function index()
    {
        

        $role = new ModelRole;
        $roles = $role->all();

        return $this->view('panel.role.index', compact('roles'));
    }
}
