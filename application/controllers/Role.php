<?php

namespace Application\Controllers;


use Application\Model\Role as ModelRole;

class Role extends Controller
{
    public function index()
    {
        $role = new ModelRole();
        $roles = $role->all();

        return $this->view('panel.role.index', compact('roles'));
    }

    public function create()
    {
        return $this->view('panel.role.create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Invalid Request Method');
        }

        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('CSRF token failed');
        }

        $name = trim($_POST['name']);
        $description = trim($_POST['description'] ?? '');

        $roleModel = new ModelRole();
        $result = $roleModel->insert([
            'name' => $name,
            'description' => $description,
        ]);

        return $this->redirect('role');
    }
}
