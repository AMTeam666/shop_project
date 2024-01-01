<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.user.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('admin.user.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:40',
            'description' => 'required|min:3|max:400'
        ]);
        $inputs = $request->all();
        $permission = Permission::create($inputs);
        
 
 
         return redirect()->route('admin.user.permission.index')->with('swal-success',' دسترسی شما با موفقیت ساخته شد');
 
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
    public function edit(Permission $permission)
    {
       return view('admin.user.permission.edit', compact('permission'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|min:3|max:40',
            'description' => 'required|min:3|max:400'
        ]);
        $inputs = $request->all();

        $permission->update($inputs);
        return redirect()->route('admin.user.permission.index')->with('swal-success',' دسترسی شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('admin.user.permission.index')->with('swal-success',' دسترسی شما با موفقیت حذف شد');

    }
}
