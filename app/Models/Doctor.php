<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function guaranteeCertificates()
    {
        $this->hasMany(GuaranteeCertificate::class,'doctor_id','id');
    }
}
