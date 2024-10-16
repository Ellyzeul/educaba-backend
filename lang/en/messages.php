<?php

return [
  'auth' => [
    'failed' => 'Invalid credentials... check you e-mail and password.',
  ],
  'middleware' => [
    'ensure_user_is_on_organization' => [
      'failed' => "user doesn't belong to an organization...",
    ],
  ],
  'action' => [
    'user' => [
      'create' => [
        'duplicate' => 'User already registered...',
      ],
    ],
  ],
];
