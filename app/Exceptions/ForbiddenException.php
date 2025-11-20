<?php

namespace App\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    protected $code = 403;
    protected $message = 'Acesso negado o usuário não tem acesso ao conteúdo disponível';
}
