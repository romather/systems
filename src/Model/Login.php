<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table = 'login';
    protected $fillable = [
        'sou',
        'procuro',
        'login',
        'email',
        'senha',
        'ip',
        'estadocivil',
        'fotoperfil',
        'nasc1',
        'nasc2',
        'idade1',
        'idade2',
        'nomeperfil',
        'cidade',
        'estado',
        'ativo',
        'tipousuario',
        'descbio',
        'descprocura',
        'datacadastro',
        'horacadastro',
        'dataacesso',
        'horaacesso',
    ];

    protected function asDateTime($value)
    {
        if ($value instanceof Carbon) {
            $value->timezone('UTC');
        }
        return parent::asDateTime($value);
    }
}