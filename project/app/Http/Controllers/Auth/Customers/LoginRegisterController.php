<?php

namespace App\Http\Controllers\Auth\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginRegisterController extends Controller
{
    public function loginRegisterForm(){
        return view("customers.auth.login-register");
    }
}
