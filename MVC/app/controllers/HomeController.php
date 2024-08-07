<?php

class HomeController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index(){
        $user = $this->userModel->getAllUsers();
        require '../app/views/home.php';
    }
}