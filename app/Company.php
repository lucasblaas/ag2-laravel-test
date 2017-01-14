<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];


    public function users()
    {
        return $this->hasMany('App\User', 'company_id');
    }
}
