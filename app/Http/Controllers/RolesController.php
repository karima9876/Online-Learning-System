<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
class RolesController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) ||  !$this->user->can('roles.index')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }

        $roles=Role::all();
        $count_roles = count(DB::table('roles')->select('id')->get());
        $count_permissions = count(DB::table('permissions')->select('id')->get());
        return view('roles.index', compact('roles','count_roles', 'count_permissions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) ||  !$this->user->can('roles.create')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $all_permissions=Permission::all();
        $permission_groups=User:: getpermissionGroups();
        // dd($permission_groups);
        return view('roles.create',compact('all_permissions','permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) ||  !$this->user->can('roles.store')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        //validation data
        $request->validate([
            'name'=>'required|max:100|unique:roles'
        ],[
            'name.required'=>'please give a role name'
        ]);


        $role = Role::create(['name'=>$request->name]);
        // $role = DB:: table('roles')->where('name',$request->name)->first();
        $permissions=$request->input('permissions');
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        session()->flash('success', 'Role has been created successfully !!');
        //  return back();
        return redirect()->to('roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($this->user) ||  !$this->user->can('roles.show')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $role=Role::findById($id);
        $all_permissions=Permission::all();
        $permission_groups=User:: getpermissionGroups();
        // dd($permission_groups);
        return view('roles.show',compact('role','all_permissions','permission_groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) ||  !$this->user->can('roles.edit')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $role=Role::findById($id);
        $all_permissions=Permission::all();
        $permission_groups=User:: getpermissionGroups();
        // dd($permission_groups);
        return view('roles.edit',compact('role','all_permissions','permission_groups'));
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
        if (is_null($this->user) ||  !$this->user->can('roles.update')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        //validation data
        $request->validate([
            'name'=>'required|max:100|unique:roles,name,'.$id
        ],[
            'name.required'=>'please give a role name'
        ]);


        $role = Role::findById($id);
        $permissions=$request->input('permissions');
        if(!empty($permissions)){
            $role->name=$request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }
        //  return back();
        session()->flash('success', 'Role has been updated successfully !!');
        return redirect()->to('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        if (is_null($this->user) ||  !$this->user->can('roles.destroy')) {
            $message = 'You are not allowed to access this page !';
            return view('errors.403', compact('message'));
       }
        $role = Role::findById($id);
        if(!is_null($role)){
            $role->delete();

        }
       session()->flash('success', 'Role has been deleted successfully !!');
       return redirect()->to('roles');
        
    }
}
