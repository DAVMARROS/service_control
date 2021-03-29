<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Service;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('login')->except('getadminServices','adminServices');
    }

    public function index()
    {
        return view('service_home');
    }

	public function getServices($admin=[])
    {           
        $data = Service::where('status', 1)->where('user_id', Auth::id())->get();
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<button type="button" class="btn btn-primary btn-sm" id="getEditService" data-id="'.$data->id.'" style="margin-left:20px; margin-right:50px">Edit</button>
                    <button type="button" data-id="'.$data->id.'" data-toggle="modal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    public function createService()
    {
    	$data = request()->all();
        $validator = \Validator::make($data, [
            'name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $user = Auth::id();
        Service::create([
            'user_id' => $user,
            'name' => $data['name'],
        ]);
        return redirect()->route('home');
    }

    public function getServicebyId($id)
    {
        $data = Service::find($id);
        return response()->json(['data'=>$data]);
    }

    public function editService(Request $request, $id)
    {
    	$input = $request->all();
        $validator = \Validator::make($input, [
            'name' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        Service::find($id)->update($request->all());

        return response()->json(['success'=>'Service updated successfully']);
    }

    public function deleteService($id)
    {
        $service = Service::find($id);

		$service->status = 0;

		$service->save();

        return response()->json(['success'=>'Service deleted successfully']);
    }

    public function adminServices()
    {
        return view('admin/service_home');
    }

    public function getadminServices($type)
    {
        if($type == 0){
            $data = Service::with('user')->where('status',1)->get();
        }
        else{
            $data = Service::where('status', 1)->where('user_id', $type)->get();
        }
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<button type="button" class="btn btn-primary btn-sm" id="getEditService" data-id="'.$data->id.'" style="margin-left:20px; margin-right:50px">Edit</button>
                    <button type="button" data-id="'.$data->id.'" data-toggle="modal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

}
