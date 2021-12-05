<?php

namespace App\Http\Controllers\User_Backend\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;

class DashboardController extends Controller
{
    //shows the dashboard page
    public function show_dashboard_page() :string
    {
        return view('User_Backend.Main.dashboard');
    }
}
