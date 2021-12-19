<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_project'
    ];

    public function project()
    {
        return $this->hasOne(Project::class,'id','id_project');
    }
    public function user_mo()
    {
        return $this->hasOne(User::class,'id','id_user_mo');
    }
    public function user_tu()
    {
        return $this->hasOne(User::class,'id','id_user_tu');
    }
    public function user_we()
    {
        return $this->hasOne(User::class,'id','id_user_we');
    }
    public function user_thu()
    {
        return $this->hasOne(User::class,'id','id_user_thu');
    }
    public function user_fri()
    {
        return $this->hasOne(User::class,'id','id_user_fri');
    }
    public function user_sa()
    {
        return $this->hasOne(User::class,'id','id_user_sa');
    }
    public function user_su()
    {
        return $this->hasOne(User::class,'id','id_user_su');
    }
}
