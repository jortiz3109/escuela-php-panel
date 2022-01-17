<?php

return [
    'titles' => [
        'index' => 'Users',
        'create' => 'Register User',
    ],
    'navbar' => [
        'title' => 'User',
    ],
    'inputs' => [
        'name' => 'name',
        'email' => 'email',
        'password' => 'password',
        'password_confirmation' => 'password_confirmation',
    ],
    'labels' => [
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Password Confirmation',
    ],
    'placeholders' => [
        'name' => 'Enter a user name',
        'email' => 'Enter a user email',
        'password' => 'Enter a password',
        'password_confirmation' => 'Enter a confirmation password',
    ],
    'buttons' => [
        'save' => 'Create User',
        'cancel' => 'Cancel User',
    ],
    'message' => [
        'success' => 'created successfully.',
    ],
    'logs' => [
        'store_error' => 'User could not be stored',
        'index' => 'Users',
        'edit' => 'Edit user',
    ],
    'fields' => [
        'name' => 'Name',
        'email' => 'Email',
        'created_at' => 'Created at',
        'status' => 'Status',
    ],
    'status' => [
        'enabled' => 'Enabled',
        'disabled' => 'Disabled',
    ],
    'alerts' => [
        'successful_update' => 'The user has been updated',
    ],
    'log' =>[
        'email_validation_could_not_be_sent' => 'The email validation could not been sent for :email, with id :id',
    ],
    'messages' =>[
      'email_verified_success' => 'Your email has been verified.',
      'email_had_been_verified' => 'Your has already been verified. If your user is blocked please contact the admin a support contact',
    ],
];
