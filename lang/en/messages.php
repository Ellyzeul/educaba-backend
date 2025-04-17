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
    'application' => [
      'update' => [
        'not_found' => "Application doesn't exists...",
      ],
      'delete' => [
        'ok' => 'Application deleted successfully!',
        'not_found' => "Application doesn't exists...",
      ],
    ],
    'contact' => [
      'update' => [
        'not_found' => "Contact doesn't exists...",
      ],
      'delete' => [
        'ok' => 'Contact deleted successfully!',
        'not_found' => "Contact doesn't exists...",
      ],
    ],
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
      'update' => [
        'without_organization' => "Authenticated user doesn't belong to an organization...",
      ],
      'delete' => [
        'ok' => 'Program deleted successfully!',
        'not_found' => "Program doesn't exists...",
      ],
    ],
    'program_set_status' => [
      'update' => [
        'not_found' => "This status doesn't exists...",
      ],
      'delete' => [
        'ok' => 'Status deleted successfully!',
        'not_found' => "This status doesn't exists...",
        'in_use' => 'This status is in usage, can not be deleted...',
      ],
    ],
  ],
];
