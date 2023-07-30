<?php

namespace App\Http\Controllers\admin;

use App\DataTables\PermissionsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PermissionsDataTable $dataTable)
    {
        $title = __("p.manage_permissions");
        return $dataTable->render("admin.permissions.index" , compact("title"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = __("p.manage_permissions").' : '.__("p.add_new_permission");
        return view("admin.permissions.create" , compact("title"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|unique:permissions',
            'title' => 'required|min:3|unique:permissions'
        ]);

        Permission::create(['name' => $request->name , 'title' => $request->title]);

        return redirect()->route("permissions.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        $title = __("p.manage_permissions").' : '.__("p.edit_permission").' <strong class="text-info">'.$permission->name.'</strong>';
        return view("admin.permissions.edit" , compact("title" , "permission"));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $this->validate($request , [
            'name' => 'required|min:3|unique:permissions,id,'.$id,
            'title' => 'required|min:3|unique:permissions,id,'.$id,
        ]);

        $permission = Permission::findOrFail($id);
        $permission->name = $validated['name'];
        $permission->title = $validated['title'];

        $permission->update();

        return redirect()->route("permissions.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Permission::where("id" , $id)->delete())
            return redirect()->route("permissions.index");
    }
}
