<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Repositories\ServiceRepository;
use App\Services\ApiServices;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ApiServices;
    private $repository;

    public function __construct(ServiceRepository $repository)
    {
        $this->repository = $repository;
        $this->table = 'services';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parameters = $this->getParameters ($request);
        // Get records and generate links for pagination
        $records = $this->repository->getAll (config ("app.nbrPages.back.".$this->table), $parameters);

        $links = $records->appends($parameters)->links ('pagination');

        // Ajax response
        if ($request->ajax()) {
            return response ()->json ([
                'table' => view ("admins.services.table", ["services" => $records])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view ("admins.services.index", ["services" => $records, 'links' => $links]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = $this->repository->create($request->all());
        if ($request->ajax()){
            return self::responseSuccess(true,$service);
        }
        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admins.services.edit',['service' => Service::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = $this->repository->update($request->all(),$id);
        if ($request->ajax()){
            return self::responseSuccess(true,$service);
        }
        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    protected function getParameters($request)
    {
        // Default parameters
        $parameters = config("parameters.$this->table");

        // Build parameters with request
        foreach ($parameters as $parameter => &$value) {
            if (isset($request->$parameter)) {
                $value = $request->$parameter;
            }
        }

        return $parameters;
    }
}
