<?php

class Auth extends Controller
{

    function __construct()
    {
        $this->helper = new Helper;
    }

    public function login()
    {
        $data =
            [
                'title' => 'Login',
                'dashboard' => 'active',

            ];
        // $this->view('templates/header', $data);
        $this->view('dashboard/index', $data);
        // $this->view('templates/footer', $data);
    }

    public function register()
    {
        $data =
            [
                'title' => 'Login',
                'dashboard' => 'active',

            ];
        $this->view('templates/header', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/footer', $data);
    }

    public function logout()
    {
        $data =
            [
                'title' => 'Login',
                'dashboard' => 'active',

            ];
        $this->view('templates/header', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/footer', $data);
    }
}
