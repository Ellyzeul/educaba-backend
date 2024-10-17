<?php

return [
  'auth' => [
    'failed' => 'Credenciais inválidas... cheque seu e-mail e senha.',
  ],
  'middleware' => [
    'ensure_user_is_on_organization' => [
      'failed' => "Usuário não pertence a nenhuma organização...",
    ],
  ],
  'action' => [
    'user' => [
      'create' => [
        'duplicate' => 'Usuário já cadastrado...',
      ],
    ],
    'organization' => [
      'update' => [
        'not_found' => "Organização não existe...",
      ],
    ],
  ],
];
