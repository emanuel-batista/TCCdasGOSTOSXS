<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    use softDeletes;
    //colunas que eu posso editar
    protected $fillable = ['conteudo', 'imagem', 'user_id'];
    //colunas que representam datas
    protected $dates = ['created_at', 'update_at', 'deleted_at'];
    //relacionamento com o usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //relacionamento com o comentario
    public function comentarios()
    {
        return $this->hasMany(Comment::class);
    }
    //conta posts do usuario
    public function contaPostsUsuario()
    {
        return $this->user->posts()->count();
    }
    //permite post do usuario
    public function permitePost()
    {
        if($this->contaPosts() < 4) {
            return true;
        }
        return false;
    }
}
