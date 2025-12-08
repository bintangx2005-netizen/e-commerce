<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminVendorController extends Controller
{
    public function inactive_vendor(): View
    {
        $inactive_vendors = User::where('role', 'vendor')->where('status', 'inactive')->latest()->get();

        return view('admin.vendor_list.inactive_vendor', compact('inactive_vendors'));
    }
    public function active_vendor(): View
    {
        $active_vendors = User::where('role', 'vendor')->where('status', 'active')->latest()->get();

        return view('admin.vendor_list.active_vendor', compact('active_vendors'));
    }
}
