<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class tarefa extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

protected $table='tarefas';


protected $fillable=[
'tituloTarefa',
'descricaoTarefa',
'dataCriacao',
'senha',
'dataConclusao',
'prioridade',
'categoria',
'notas',
'user_id'
];
}

