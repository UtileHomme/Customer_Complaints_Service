<?php

$config =
[
    'customer_login' =>
    [
        [
            'field'=>'username',
            'label'=>'User Name',
            'rules'=>'required|alpha_numeric_spaces|trim'
        ],
        [
            'field'=>'password',
            'label'=>'Password',
            'rules'=>'required'
        ]
    ],
    'assistant_login' =>
    [
        [
            'field'=>'username',
            'label'=>'User Name',
            'rules'=>'required|alpha_numeric_spaces|trim'
        ],
        [
            'field'=>'password',
            'label'=>'Password',
            'rules'=>'required'
        ]
    ],

];

?>
