<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        $page = request(['pagination'][0]) ?? 10;
        return view('User.Index', [
            'panel' => ['user', 'user.index'],
            'page' => $page,
            'search' => request(['search'][0]),
            'user' => User::orderBy('jabatan_id', 'asc')->filter(request(['search']))->paginate($page),
        ]);
    }

    public function edit($id)
    {
        return view('User.Edit', [
            'jabatan' => Jabatan::all(),
            'panel' => ['user', 'user.index'],
            'user' => User::where('id', $id)->get()[0]
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'jabatan_id' => 'required',

        ]);

        User::where('id', $id)->update($data);
        return redirect(route('user.index'));
    }

    public function delete($id)
    {
        User::where('id', $id)->delete($id);
        return redirect(route('user.index'));
    }
}
