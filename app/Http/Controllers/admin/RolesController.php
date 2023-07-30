<?php

namespace App\Http\Controllers\admin;
use App\DataTables\RolesDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RolesDataTable $dataTable)
    {
        $title = __("p.manage_roles");
        $permissions = Permission::all();
        return $dataTable->render("admin.roles.index" , compact("title" , "permissions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = __("p.manage_roles").' : '.__("p.add_new_role");
        return view("admin.roles.create" , compact("title"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|unique:roles',
            'title' => 'required|min:3|unique:roles'
        ]);

        Role::create(['name' => $request->name , 'title' => $request->title]);

        return redirect()->route("roles.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        $title = __("p.manage_roles").' : '.__("p.edit_role").' <strong class="text-info">'.$role->name.'</strong>';
        return view("admin.roles.edit" , compact("title" , "role"));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $this->validate($request , [
            'name' => 'required|min:3|unique:roles,id,'.$id,
            'title' => 'required|min:3|unique:roles,id,'.$id,
        ]);

        $role = Role::findOrFail($id);
        $role->name = $validated['name'];
        $role->title = $validated['title'];

        $role->update();

        return redirect()->route("roles.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Role::where("id" , $id)->delete())
            return redirect()->route("roles.index");
    }


    public function save_permissions(Request $request){
        $validator = Validator::make($request->all(), [
            'permissions' => 'required',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            return checkValidation($validator);
        }

        $role = Role::findOrFail($request->role_id);

        $permissions = $request->permissions;
        if(!empty($permissions)){
            foreach($permissions as $p){
                $permission = Permission::find($p);
                $role->givePermissionTo($permission);
            }
        }

        return reply("success");

    }


    public function get_permissions(Request $request){
        $roleId = $request->role_id;
        $role = Role::find($roleId);
        $all = $role->permissions()->select("id")->get()->toArray();
        $permissions = [];
        if(!empty($all)){
            foreach ($all as $p){
                $permissions[] = $p['id'];
            }
        }
        return $permissions;
    }
}
