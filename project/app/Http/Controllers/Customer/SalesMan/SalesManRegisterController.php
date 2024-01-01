<?php

namespace App\Http\Controllers\Customer\SalesMan;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Massage\MassageService;
use App\Http\Services\Massage\Email\EmailService;
use App\Http\Requests\Auth\Customers\LoginRegisterRequest;

class SalesManRegisterController extends Controller
{
    public function registerForm()
    {
        return view('customers.sales-man.register-form');
    }
  
}
