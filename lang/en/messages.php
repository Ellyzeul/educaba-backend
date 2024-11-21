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
      'delete' => [
        'ok' => 'User deleted successfully!',
        'not_found' => "User doesn't exists...",
      ],
      'change_password' => [
        'ok' => 'Password successfully changed!',
        'not_found' => "User doesn't exists...",
      ],
      'link_organization' => [
        'ok' => 'User linked to organization successfully!',
        'not_found' => "User doesn't exists...",
        'already_linked' => 'User already belongs to an organization...',
      ],
      'unlink_organization' => [
        'ok' => 'User unlinked from organization successfully!',
        'not_found' => "User doesn't exists on organization...",
      ],
    ],
    'organization' => [
      'update' => [
        'not_found' => "Organization doesn't exists...",
      ],
    ],
    'patient' => [
      'update' => [
        'not_found' => "Patient doesn't exists...",
      ],
      'delete' => [
        'ok' => 'Patient successfully deleted!',
        'not_found' => "Patient doesn't exists...",
      ],
    ],
    'program' => [
      'create' => [
        'without_organization' => "Authenticated user doesn't belong to an organization...",
      ],
    ],
  ],
];
