<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect(route('laporan.index'));
        // return view('Dashboard.Dashboard', [
        //     'panel' => ['dashboard', 'dashboard']
        // ]);
    }
}
