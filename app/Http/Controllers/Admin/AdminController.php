<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    public function login(): View
    {
        return View('admin.login');
    }
    public function index(): View
    {
        return View('admin.index');
    }
}
