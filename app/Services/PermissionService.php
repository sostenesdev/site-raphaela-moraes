<?php

namespace App\Services;

class PermissionService{

    private $permissions;
    public function __construct()
    {
        $this->permissions = ['Administrador', 'Funcionario', 'Convidado'];
    }
    public function getPermissions(){
        return $this->permissions;
    }

}