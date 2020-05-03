<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Information extends Model
{
    use SoftDeletes;

    protected $table = 'informations';

    protected $fillable = ['name','gender','identity_card','address','date_of_birth','phone'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function guaranteeCertificates()
    {
        return $this->hasOne(GuaranteeCertificate::class,'information_id','id');
    }
}
