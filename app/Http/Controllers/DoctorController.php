<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Repositories\DoctorRepository;
use App\Services\ApiServices;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    use ApiServices;
    private $repository;

    public function __construct(DoctorRepository $repository)
    {
        $this->repository = $repository;
        $this->table = 'doctors';
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
                'table' => view ("admins.doctors.table", ["doctors" => $records])->render (),
                'pagination' => $links->toHtml (),
            ]);
        }

        return view ("admins.doctors.index", ["doctors" => $records, 'links' => $links]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $doctor = $this->repository->create($request->all());
        if ($request->ajax()){
            return self::responseSuccess(true,$doctor);
        }
        return redirect()->route('doctors.index');
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
        return view('admins.doctors.edit',['doctor' => Doctor::findOrFail($id)]);
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
        $doctor = $this->repository->update($request->all(),$id);
        if ($request->ajax()){
            return self::responseSuccess(true,$doctor);

        }
        return redirect()->route('doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->back();
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
