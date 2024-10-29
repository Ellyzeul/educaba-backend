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
      'update' => [
        'not_found' => "Usuário não existe...",
      ],
      'change_password' => [
        'ok' => 'Senha alterada com sucesso!',
        'not_found' => "Usuário não existe...",
      ],
    ],
    'organization' => [
      'update' => [
        'not_found' => "Organização não existe...",
      ],
    ],
    'patient' => [
      'update' => [
        'not_found' => "Patient doesn't exists...",
      ],
    ],
  ],
];
