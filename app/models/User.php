<?php

class User {

    use Model;

    protected $table = 'users';

    protected $allowedColums = [
      'username',
      'password',
    ];

}
