<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VendorController extends Controller
{
    public function index(): View
    {
        return View('vendor.index');
    }

    public function login(): View
    {
        return View('vendor.vendor_login');
    }
}
