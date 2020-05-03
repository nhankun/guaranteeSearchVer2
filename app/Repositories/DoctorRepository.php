<?php
namespace App\Repositories;

use App\Models\Doctor;

class DoctorRepository
{

    public function getAll($nbrPages, $parameters)
    {
        return Doctor::orderBy($parameters['order'], 'asc')
            ->when (($parameters['search'] !== ''), function ($query) use ($parameters) {
                $query->where(function ($q)  use ($parameters) {
                    $q->where('name', 'like', "%".$parameters['search']."%");
                });
            })
            ->paginate($nbrPages);
    }

    public function create($params)
    {
        return Doctor::create($params);
    }

    public function update($params, $id)
    {
        $doctor = $this->getDoctorById($id);
        return $doctor->update($params);
    }

    public function delete($id)
    {
        $doctor = $this->getDoctorById($id);
        return $doctor->delete();
    }

    public function getDoctorById($id)
    {
        return Doctor::findOrFail($id);
    }


}
