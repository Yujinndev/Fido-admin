<?php
  $tables = [
    'pets' => [
      'label' => 'User Table',
      'fields' => [
        'name' => [
          'label' => 'Name',
          'type' => 'text'
        ],
        'type' => [
          'label' => 'Type',
          'type' => 'text'
        ],
        'age' => [
          'label' => 'Age',
          'type' => 'text'
        ],
        'status' => [
          'label' => 'Status',
          'type' => 'text'
        ],
        'availability' => [
          'label' => 'Availability',
          'type' => 'text'
        ],
      ]
    ], // END OF TABLE `PETS` CONFIG

    'users' => [
      'label' => 'Users',
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
        'phoneNum' => [
          'label' => 'Phone Number',
          'type' => 'tel'
        ],
        'address' => [
          'label' => 'Address [Barangay, Town, ZipCode]',
          'type' => 'text'
        ],
        'province' => [
          'label' => 'Province',
          'type' => 'text'
        ],
        'role' => [
          'label' => 'Role',
          'type' => 'text'
        ],
      ],
    ], // END OF TABLE `USERS` CONFIG

    'itemdonations' => [
      'label' => 'Item Donations',
      'fields' => [
        'name' => [
          'label' => 'Name',
          'type' => 'text'
        ],
        'price' => [
          'label' => 'Price',
          'type' => 'number'
        ],
        'quarterlyStocks' => [
          'label' => 'Quarterly Stocks',
          'type' => 'number'
        ],
        'description' => [
          'label' => 'Description',
          'type' => 'textarea'
        ],
      ]
    ], // END OF TABLE `ITEMDONATIONS` CONFIG

    'requests' => [
      'label' => 'Requests',
      'fields' => [
        'userId' => [
          'label' => 'User Id',
          'type' => 'text'
        ],
        'petId' => [
          'label' => 'Pet Id',
          'type' => 'number'
        ],
        'dateRequested' => [
          'label' => 'Date requested',
          'type' => 'datetime'
        ],
        'requestStatus' => [
          'label' => 'Status',
          'type' => 'text'
        ],
        'reason' => [
          'label' => 'Reason',
          'type' => 'textarea'
        ],
      ]
    ], // END OF TABLE `REQUESTS` CONFIG

    'materials' => [
      'label' => 'Materials',
      'fields' => [
        'title' => [
          'label' => 'Title',
          'type' => 'text'
        ],
        'author' => [
          'label' => 'Author Id',
          'type' => 'number'
        ],
        'datePosted' => [
          'label' => 'Date Posted',
          'type' => 'datetime'
        ],
        'reference' => [
          'label' => 'Reference',
          'type' => 'text'
        ],
        'status' => [
          'label' => 'Status',
          'type' => 'text'
        ],
        'content' => [
          'label' => 'Content',
          'type' => 'textarea'
        ],
      ]
    ], // END OF TABLE `REQUESTS` CONFIG    
  ];
?>