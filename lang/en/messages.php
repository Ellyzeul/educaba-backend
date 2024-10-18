<?php

return [
  'auth' => [
    'failed' => 'Invalid credentials... check you e-mail and password.',
  ],
  'middleware' => [
    'ensure_user_is_on_organization' => [
      'failed' => "User doesn't belong to an organization...",
    ],
  ],
  'action' => [
    'user' => [
      'create' => [
        'duplicate' => 'User already registered...',
      ],
      'update' => [
        'not_found' => "User doesn't exists...",
      ],
      'change_password' => [
        'ok' => 'Password successfully changed!',
        'not_found' => "User doesn't exists...",
      ],
    ],
    'organization' => [
      'update' => [
        'not_found' => "Organization doesn't exists...",
      ],
    ],
  ],
];
