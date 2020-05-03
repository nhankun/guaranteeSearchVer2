<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuaranteeCertificate extends Model
{
    use SoftDeletes;

    protected $fillable = ['id_guarantee','unit_tooth','information_id','doctor_id','service_id','image_before',
        'image_doing','image_finish','date_guarantee','date_finish','note'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }

    public function information()
    {
        return $this->belongsTo(Information::class,'information_id','id');
    }
}
