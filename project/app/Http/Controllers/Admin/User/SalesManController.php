<?php

namespace App\Http\Controllers\Admin\user;

use App\Models\User;
use App\Models\User\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Massage\MassageService;
use App\Http\Services\Massage\Email\EmailService;
use App\Http\Requests\Admin\User\CustomerUserRequest;

class SalesManController extends Controller
{

    public function index()
    {
        $unseenUsers = User::where('user_type', 2)->where('seen', 0)->get();
        foreach($unseenUsers as $unseenUser){
            $unseenUser->seen = 1;
            $result = $unseenUser->save();
        }

        $salesMans = User::where('user_type', 2)->get();
        return view('admin.user.salesman.index', compact('salesMans'));

    }

    /**
     * Show the form for creating a new resource.
     */


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
   
    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUserRequest $request, User $user)
    {
        $inputs = $request->all();
     
        $user->update($inputs);
        return redirect()->route('admin.user.salesman.index')->with('swal-success', 'مشتری شما با موفقیت ویرایش شد');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $result = $user->forceDelete();
        return redirect()->route('admin.user.salesman.index')->with('swal-success', 'ادمین شما با موفقیت حذف شد');
    }

    public function status(User $user)
    {
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

    public function role(User $user)
    {
        $roles = Role::all();
        return view('admin.user.salesman.role', compact('roles', 'user'));
        
    }

    public function roleStore(User $user, Request $request)
    {   
        $request->validate([
            'roles' => 'required|exists:roles,id|array',
        ]);

        $user->roles()->sync($request->roles);
        return redirect()->route('admin.user.sale.index')->with('swal-success', 'نقش ها با موفقیت ثبت شد');

    }
    
    public function addSalesManRole(User $user)
    {
        if(empty($user->roles()->get()->toArray()))
        {
            $user->roles()->attach(5);
            $id = $user->email;
        
           $emailService = new EmailService();
                $detials = [
                    'title' =>  'تاییدیه حساب',
                    'body' =>  "حساب شما به عنوان فروشنده در سایت تایید شد",
                ];
                $emailService->setDetails($detials);
                $emailService->setFrom('noreply@example.com', 'shop');
                $emailService->setSubject('تایید اطلاعات');
                $emailService->setTo($id);
    
                $messagesService = new MassageService($emailService);
                $messagesService->send();

        }else{
            return redirect()->route('admin.user.sale.index')->with('swal-error', 'نقش قبلا داده شده است'); 
        }
        
        return redirect()->route('admin.user.sale.index')->with('swal-success', 'نقش  با موفقیت ثبت شد');

    }
    public function disapproval(User $user)
    {
        $id = $user->email;
        
           $emailService = new EmailService();
                $detials = [
                    'title' =>  'عدم تایید',
                    'body' =>  "اطلاعات وارد شما صحیح نمیباشد لطفا برای بررسی مجدد اصلاعات خود را بفرستید ",
                ];
                $emailService->setDetails($detials);
                $emailService->setFrom('noreply@example.com', 'shop');
                $emailService->setSubject('عدم تایید اطلاعات');
                $emailService->setTo($id);
    
                $messagesService = new MassageService($emailService);
                $messagesService->send();
                
        return redirect()->route('admin.user.sale.index')->with('swal-success', 'پیام عدم تایید به کارببر فرستاده شد');

    }
}
