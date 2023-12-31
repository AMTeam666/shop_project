<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Models\User\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Models\User\Permission;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::where('user_type', 1)->get();
        return view('admin.user.admin-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.admin-user.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminUserRequest $request, ImageService $imageService)
    {

        $inputs = $request->all();
        if($request->hasFile('profile_photo_path'))
        {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));

            if($result === false)
            {
                return redirect()->route('admin.user.admin-user.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;

        }

       $inputs['password'] = Hash::make($request->password);
        $inputs['user_type'] = 1;
        $user = User::create($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success','ادمین جدید شما با موفقیت ساخته شد');
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
    public function edit(User $admin)
    {
        return view('admin.user.admin-user.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUserRequest $request, User $admin, ImageService $imageService)
    {
        $inputs = $request->all();

        if($request->hasFile('profile_photo_path'))
        {
            if(!empty($admin->profile_photo_path))
            {
                $imageService->deleteImage($admin->profile_photo_path);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));
            if($result === false)
            {
                return redirect()->route('admin.user.admin-user.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $admin->update($inputs);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success', 'ادمین سایت شما با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $result = $user->forceDelete();
        return redirect()->route('admin.user.admin-user.index')->with('swal-success', 'ادمین شما با موفقیت حذف شد');
    }

    public function status(User $user){

        $user->status = $user->status == 0 ? 1 : 0;
        $result = $user->save();
        if($result){
            if($user->status == 0){
                return response()->json(['status' => true, 'checked' => false]);
            }
            else{
                return response()->json(['status' => true, 'checked' => true]);
            }
        }
        else{
            return response()->json(['status' => false]);
        }

    }


    public function activation(User $user){
        $user->activation = $user->activation == 0 ? 1 : 0;
        $result = $user->save();
        if($result){
            if($user->activation == 0){
                return response()->json(['status' => true, 'checked' => false]);
            }
            else{
                return response()->json(['status' => true, 'checked' => true]);
            }
        }
        else{
            return response()->json(['status' => false]);
        }

    }

    public function role(User $admin)
    {
        $roles = Role::all();
        return view('admin.user.admin-user.role', compact('roles', 'admin'));
        
    }

    public function roleStore(User $admin, Request $request)
    {   
        $request->validate([
            'roles' => 'required|exists:roles,id|array',
        ]);
        dd($request->roles);
        $admin->roles()->sync($request->roles);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success', 'نقش ها با موفقیت ثبت شد');

    }
    public function permissions(User $admin)
    {
        $permissions = Permission::all();
        return view('admin.user.admin-user.permissions', compact('permissions', 'admin'));
        
    }

    public function permissionsStore(User $admin, Request $request)
    {   
 
        $request->validate([
            'permissions' => 'required|exists:permissions,id|array',
        ]);

        $admin->permissions()->sync($request->permissions);
        return redirect()->route('admin.user.admin-user.index')->with('swal-success', 'سطوح دسترسی با موفقیت ثبت شد');

    }

}
