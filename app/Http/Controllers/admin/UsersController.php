<?php

namespace App\Http\Controllers\admin;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        $title = __("p.users_list");
        return $dataTable->render("admin.users.index", compact("title"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $title = __("p.edit_user") . ' ' . $user->name . ' ' . $user->last_name;
        return view("admin.users.edit", compact("user", "title"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $items = [
            'name' => 'required|string|min:2|max:15',
            'last_name' => 'required|string|min:2|max:20',
            'email' => 'required|email',
            'mobile' => 'required',
            'job_name' => 'required|min:5',
            'password' => 'nullable|min:6|confirmed'
        ];
        $request->validate($items);

        $data = [
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile == null ? null : $this->faTOen($request->mobile),
            'job_name' => $request->job_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'pm' => $request->pm,
            'pj_available' => $request->pj_available,
            'pm_mobile' => $request->pm_mobile == null ? null : $this->faTOen($request->pm_mobile),
            'boss_mobile' => $request->boss_mobile == null ? null : $this->faTOen($request->boss_mobile),
            'description' => $request->description,
        ];

        if ($request->password != '') {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return back()->with('success', 'اطلاعات کاربری به روز شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Inquiry::where("user_id", $id)->delete();

        if (User::where("id", $id)->delete())
            return redirect()->route("users.index");
    }

    function faTOen($string)
    {
        return strtr($string, array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));
    }
}
