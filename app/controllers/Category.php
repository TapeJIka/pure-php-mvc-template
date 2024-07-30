<?php

class Category extends Controller {

    public function index() {
        $data=[];
        $this->view('profile', $data);
    }
}
