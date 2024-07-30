<?php

class User {

    use Model;

    protected $table = 'users';

    protected $allowedColumns = [
      'username',
      'password',
    ];

    public function validate($data) {
        $this->errors = [];

        if (!empty($data['username'])) {
            $data['username'] = validation($data['username']);
        }else {
            $this->errors['username'] = 'Username field is required';
        }
        if (!empty($data['password'])) {
            if (strlen($data['password']) < 8) {
                $this->errors['password'] = 'Password must be atleast 8 characters';
            }
            $data['password'] = validation($data['password']);
        }else {
            $this->errors['password'] = 'Password field is required';
        }

        if (empty($this->errors)) {
            return $data;
        }

        return false;
    }

}
