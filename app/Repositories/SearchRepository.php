<?php
namespace App\Repositories;

use App\Models\guaranteeCertificate;

class SearchRepository
{

    public function getAll($nbrPages, $parameters)
    {
        return guaranteeCertificate::orderBy($parameters['order'], 'asc')
            ->when (($parameters['search'] !== ''), function ($query) use ($parameters) {
                $query->where(function ($q)  use ($parameters) {
                    $q->where('id_guarantee', 'like', "%".$parameters['search']."%");
                    $q->orWhereHas('information',function ($qu) use($parameters) {
                        $qu->where('identity_card', 'like', "%".$parameters['search']."%");
                    });
                });
            })
            ->paginate($nbrPages);
    }

}
