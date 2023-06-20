<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard() : View 
    {
        $usuario = Auth::user();

        return view('dashboard', compact('usuario'));
    }

}