<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role as Role;
use Spatie\Permission\Models\Permission as Permission;
use DB;
use Validator;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');
    }

    public function index(Request $request)
    {

        if(request()->ajax()) {
            $roles = Role::get();
            return datatables()->of($roles)
                ->addIndexColumn()

                ->addColumn('action', 'roles.action_button')
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('roles.index')->with([
            'permissions' => Permission::get(),
        ]);
    }

    public function create()
    {
        $permissions = Permission::get();


        $view = view('roles.add',compact('permissions'))->render();

        return response()->json(['view' => $view ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles_spatie,name',
            'permissions' => 'required',
        ]);

        if ($validator->passes()) {

            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions($request->input('permissions'));
            return response()->json(['success' => __('message.create_success')]);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function edit(Request $request,$getId)
    {
        $id = $getId;
        if( $id != "" ) {
            $role = Role::where('id',$id)->first();
            if( $role ) {
                $permissions = Permission::get();


                $view = view('roles.edit',compact('permissions','role'))->render();

                return response()->json(['view' => $view ]);

            } else {
                return response()->json('error', __('message.customer_not_found'));
            }
        }
        return response()->json('error',  __('message.create_failed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles_spatie,name,'.$id,
            'permissions' => 'required',
        ]);

        if ($validator->passes()) {
            $role = Role::where('id',$id)->first();
            $role->update([
                'name' => $request->name
            ]);

            $role->syncPermissions($request->input('permissions'));
            return response()->json(['success' => __('message.create_success')]);
        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        if( $id != "" && $id != 1) {
            $role = DB::table("roles_spatie")->where('id', $id)->first();

            if( $role && $role->name != 'super-admin') {
                DB::table("roles_spatie")->where('id', $id)->delete();
                return response()->json(['success' => __('message.delete_text')]);
            } else {
                return response()->json(['error' =>  __('message.create_failed')]);
            }
        }
        return response()->json(['error' =>  __('message.create_failed')]);
    }
}