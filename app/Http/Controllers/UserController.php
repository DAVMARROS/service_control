<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles');
    }

    public function index()
    {
        return view('admin.user_home');
    }

    public function getUsers()
    {
    	$rol = Role::where('rol','user')->get()[0]["id"];
        $data = User::where('status', 1)->where('rol', $rol)->get();
        return \DataTables::of($data)
            ->addColumn('Actions', function($data) {
                return '<a class="btn btn-secondary btn-sm" href="user/'.$data->id.'" style="margin-left:20px; margin-right:50px">Read</a>
                    <button type="button" data-id="'.$data->id.'" data-toggle="modal" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    public function getUserbyId($id, $type=[])
    {
    	$data = User::find($id);
        if($type){
            return response()->json(['data'=>$data]);
        }
        return view('admin.user')->with('data', $data);;
    }

    public function createUser()
    {
        $data = request()->all();
        $validator = \Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        User::create([
            'name' => $data['name'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'rol' => $data['rol'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return redirect()->route('admin');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        Service::where('user_id', $id)->update(['status' => 0]);

        return response()->json(['success'=>'User deleted successfully']);
    }

    public function listUser(){
        $data = User::select('id', 'name')->with(['services' => function($query){
            $query->select('id','user_id','name')->where('status',1);
        }])->where('status',1)->get();
        foreach($data as $element) {
            foreach ($element->services as $service) {
                unset($service->user_id);
            }
        }
        $data = ['users'=> $data];

        return response()->json(['status'=>'OK','data'=>$data]);
    }
}
