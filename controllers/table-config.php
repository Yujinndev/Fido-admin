<?php
  $tables = [
    'users' => [
      'label' => 'User Table',
      'fields' => [
        'email' => [
          'label' => 'Email',
          'type' => 'email'
        ],
        'password' => [
          'label' => 'Password',
          'type' => 'password'
        ],
        'firstname' => [
          'label' => 'First Name',
          'type' => 'text'
        ],
        'lastname' => [
          'label' => 'Last Name',
          'type' => 'text'
        ],
        'age' => [
          'label' => 'Age',
          'type' => 'number'
        ],
      ],
    ],
    'itemdonations' => [
      'label' => 'User Table',
      'fields' => [
        'email' => [
          'label' => 'Email',
          'type' => 'email'
        ],
        'password' => [
          'label' => 'Pass',
          'type' => 'password'
        ],
      ]
    ],
    'products' => [
      'label' => 'User Table',
      'fields' => [
        'email' => [
          'label' => 'Email',
          'type' => 'email'
        ],
        'password' => [
          'label' => 'Pass',
          'type' => 'password'
        ],
      ]
    ],
  ];
?>