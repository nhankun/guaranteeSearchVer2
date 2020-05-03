<?php
namespace App\Repositories;

use App\Models\Doctor;
use App\Models\guaranteeCertificate;
use App\Models\Information;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class guaranteeCertificateRepository
{

    public function getAll($nbrPages, $parameters)
    {
        return guaranteeCertificate::orderBy($parameters['order'], 'asc')
            ->when (($parameters['search'] !== ''), function ($query) use ($parameters) {
                $query->where(function ($q)  use ($parameters) {
                    $q->where('name', 'like', "%".$parameters['search']."%");
                });
            })
            ->paginate($nbrPages);
    }

    public function create($request)
    {
        $params = $request->all();
        $params['id_guarantee'] = 'VIN'.$params['id_guarantee'];
        $params['information_id'] = Information::create($params)->id;

        $doctors = Doctor::all()->pluck('name')->toArray();

        if (array_search($params['name_doctor'],$doctors) == false){
            $params['doctor_id'] = Doctor::create(['name'=>$params['name_doctor']])->id;
        }else{
            $params['doctor_id'] = Doctor::where('name',$params['name_doctor'])->first()->id;
        }

        $gcs = guaranteeCertificate::create($params);

        $image_before = $request->hasFile('image_before') ? $this->uploadImage($request->file('image_before'),$gcs->id,'image_before') : null;
        $image_doing = $request->hasFile('image_doing') ? $this->uploadImage($request->file('image_doing'),$gcs->id,'image_doing') : null ;
        $image_finish = $request->hasFile('image_finish') ? $this->uploadImage($request->file('image_finish'),$gcs->id,'image_finish') : null ;
        return $gcs->update([
            'image_before' => $image_before,
            'image_doing' => $image_doing,
            'image_finish' => $image_finish
        ]);
    }

    public function update($request, $id)
    {
        $gcs = $this->getById($id);

        $params = $request->all();
        $params['id_guarantee'] = (count(explode('VIN',$params['id_guarantee'])) == 2) ? $params['id_guarantee'] : 'VIN'.$params['id_guarantee'];
        $params['information_id'] = Information::create($params)->id;

        $doctors = Doctor::all()->pluck('name')->toArray();

        if (array_search($params['name_doctor'],$doctors) == false){
            $params['doctor_id'] = Doctor::create(['name'=>$params['name_doctor']])->id;
        }else{
            $params['doctor_id'] = Doctor::where('name',$params['name_doctor'])->first()->id;
        }

        $gcs->update($params);

        $image_before = $request->hasFile('image_before') ? $this->uploadImage($request->file('image_before'),$gcs->id,'image_before') : $gcs->image_before;
        $image_doing = $request->hasFile('image_doing') ? $this->uploadImage($request->file('image_doing'),$gcs->id,'image_doing') : $gcs->image_doing;
        $image_finish = $request->hasFile('image_finish') ? $this->uploadImage($request->file('image_finish'),$gcs->id,'image_finish') : $gcs->image_finish;
        return $gcs->update([
            'image_before' => $image_before,
            'image_doing' => $image_doing,
            'image_finish' => $image_finish
        ]);
    }
    public function uploadImage($file,$id,$desc){
        if ($file) {
            $destinationPath = 'image/guarantee_certificates/'.$id.'/'.$desc.'/'; // upload path
            $profilefile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profilefile);
            return $destinationPath.$profilefile;
        }
    }

    public function getById($id)
    {
        return guaranteeCertificate::findOrFail($id);
    }


}
