<?php

class Home extends Controller {

    public function index($a = 'asd') {
        $user = new User();
        $sql = $user->all();
        show($sql);

        $this->view('home');
    }

    public function store($id) {
        show($id);
        $this->view('home');
    }

    public function update() {

    }

    public function delete() {

    }
}
