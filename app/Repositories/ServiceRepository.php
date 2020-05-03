<?php
namespace App\Repositories;

use App\Models\Service;
use Illuminate\Support\Facades\Hash;

class ServiceRepository
{

    public function getAll($nbrPages, $parameters)
    {
        return Service::orderBy($parameters['order'], 'asc')
            ->when (($parameters['search'] !== ''), function ($query) use ($parameters) {
                $query->where(function ($q)  use ($parameters) {
                    $q->where('name', 'like', "%".$parameters['search']."%");
                });
            })
            ->paginate($nbrPages);
    }

    public function create($params)
    {
        return Service::create($params);
    }

    public function update($params, $id)
    {
        $service = $this->getServiceById($id);
        return $service->update($params);
    }

    public function getServiceById($id)
    {
        return Service::findOrFail($id);
    }


}
