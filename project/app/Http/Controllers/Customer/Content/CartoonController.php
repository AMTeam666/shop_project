<?php

namespace App\Http\Controllers\Customer\Content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartoonController extends Controller
{
    public function index()
    {
        return view('customers.content.cartoon.cartoon-index');
    }
}
