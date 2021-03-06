<?php

return [

    'email' => 'techgear.mailer@gmail.com',

    'phone' => '(0939) 771 4101',

    'shipping_fee' => 30,

    'carousel_images' => [
        'img/slide1.jpg',
        'img/slide2.jpg',
        'img/slide3.jpg',
        'img/slide4.jpg',
        'img/slide5.jpg',
        'img/slide6.jpg',
        'img/slide7.jpg',
    ],

    'admin' => [
        'firstname' => env('ADMIN_FIRSTNAME', 'John'),
        'lastname' => env('ADMIN_LASTNAME', 'Doe'),
        'email' => env('ADMIN_EMAIL', 'johndoe@techgear.studio'),
        'password' => env('ADMIN_PASSWORD', 'password1234')
    ]

];