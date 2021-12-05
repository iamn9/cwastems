<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'role' => [
        'title' => 'Roles',

        'actions' => [
            'index' => 'Roles',
            'create' => 'New Role',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'guard_name' => 'Guard name',
            
        ],
    ],

    'bin' => [
        'title' => 'Bins',

        'actions' => [
            'index' => 'Bins',
            'create' => 'New Bin',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'address_1' => 'Address 1',
            'address_2' => 'Address 2',
            'landmark' => 'Landmark',
            'load_type' => 'Load type',
            'collection_frequency' => 'Collection frequency',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];