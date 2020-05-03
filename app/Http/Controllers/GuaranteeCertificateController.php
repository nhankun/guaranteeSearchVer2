<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\GuaranteeCertificate;
use App\Models\Service;
use App\Repositories\guaranteeCertificateRepository;
use App\Services\ApiServices;
use Illuminate\Http\Request;

class GuaranteeCertificateController extends Controller
{
    use ApiServices;
    private $repository;

    public function __construct(guaranteeCertificateRepository $repository)
    {
        $this->repository = $repository;
        $this->table = 'gcs';
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
                'table' => view ("admins.gcs.table", ["gcs" => $records])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view ("admins.gcs.index", ["gcs" => $records, 'links' => $links]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admins.gcs.create',compact(['services']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gc = $this->repository->create($request);
        if ($request->ajax()){
            return self::responseSuccess(true,$gc);
        }
        return redirect()->route('gcs.index');
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
        $services = Service::all();
        $gcs = GuaranteeCertificate::find($id);
        return view('admins.gcs.edit',compact(['gcs','services']));
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
        $gc = $this->repository->update($request,$id);
        if ($request->ajax()){
            return self::responseSuccess(true,$gc);
        }
        return redirect()->route('gcs.index');
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
