<?php

namespace App\Exceptions;

use Exception;

class IntegrityException extends Exception
{
    protected $code = 409;
    protected $message = 'Não pode alterar um dado que está ligado a foreign key em outra tabela.';
}
