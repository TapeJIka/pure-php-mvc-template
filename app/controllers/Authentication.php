<?php

class Authentication extends Controller {

    public function login() {
        $this->view('authentication/login');
    }

    public function register() {
        $this->view('authentication/register');
    }
}
