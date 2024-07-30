<?php

class Category {

    use Model;

    protected $table = 'categories';

    protected $allowedColums = [
        'name',
        'description',
        'parent_id',
    ];

    public function validate($data) {
        $this->errors = [];

        if (!empty($data['name'])) {
            $data['name'] = validation($data['name']);
        }else {
            $this->errors['name'] = 'Name field is required';
        }
        if (!empty($data['description'])) {
            $data['description'] = validation($data['description']);
        }else {
            $this->errors['description'] = 'Description field is required';
        }
        if (!empty($data['parent_id'])) {
            $check = $this->first(['id' => $data['parent_id']]);
            if (empty($check)) {
                $this->errors['parent'] = 'The parent you selected does not exist';
            }
        }
            if (empty($this->errors)) {
                return $data;
            }
        return false;
    }

}
