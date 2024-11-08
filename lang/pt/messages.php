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
      'delete' => [
        'ok' => 'Usuário deletado com sucesso!',
        'not_found' => "Usuário não existe...",
      ],
      'change_password' => [
        'ok' => 'Senha alterada com sucesso!',
        'not_found' => "Usuário não existe...",
      ],
      'link_organization' => [
        'ok' => 'Usuário associado à organização com sucesso!',
        'not_found' => 'Usuário não existe...',
        'already_linked' => 'Usuário já está associado a uma organização...',
      ],
      'unlink_organization' => [
        'ok' => 'Usuário desassociado da organização com sucesso!',
        'not_found' => 'Usuário não existe nesta organização...',
      ],
    ],
    'organization' => [
      'update' => [
        'not_found' => "Organização não existe...",
      ],
    ],
    'patient' => [
      'update' => [
        'not_found' => "Paciente não existe...",
      ],
      'delete' => [
        'ok' => 'Paciente excluído com sucesso!',
        'not_found' => "Paciente não existe...",
      ],
    ],
  ],
];
