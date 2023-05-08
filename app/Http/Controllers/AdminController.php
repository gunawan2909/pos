<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function police()
    {
        $page = request(['pagination'][0]) ?? 10;
        return view('Admin.police', [
            'panel' => ['admin', 'police'],
            'page' => $page,
            'search' => request(['search'][0]),
            'user' => User::where('remote', '>', '1')->filter(request(['search']))->orderBy('nis', 'ASC')->paginate($page),
        ]);
    }
    public function remove($nis)
    {
        User::where('nis', $nis)->update(['remote' => 1]);

        return back();
    }
    public function add()
    {
        $data = request()->validate([
            'nis' => 'required',
            'remote' => 'required',
        ]);

        User::where('nis', $data['nis'])->update(['remote' => $data['remote']]);
        return back();
    }

    public function whatsapp()
    {
        return view('Admin.whatsapp', [
            'panel' => ['admin', 'wa'],

        ]);
    }
}
