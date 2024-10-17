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
    ],
    'organization' => [
      'update' => [
        'not_found' => "Organization doesn't exists...",
      ],
    ],
  ],
];
