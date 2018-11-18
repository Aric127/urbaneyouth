<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$config = array(
    'login' => array(
        array(
            'field' => 'user_email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'user_password',
            'label' => 'Password',
            'rules' => 'required'
        )
    ),
    'registration' => array(
        array(
            'field' => '',
            'label' => '',
            'rules' => ''
        )
    ),
    'forgot_pass' => array(
        array(
            'field' => 'user_email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        )
    )
        )
?>