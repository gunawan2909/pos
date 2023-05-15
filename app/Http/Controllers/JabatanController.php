<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->search;
        $page = request()->pagination;
        return view('Jabatan.Index', [
            'panel' => ['user', 'jabatan'],
            'jabatan' => Jabatan::filter(request(['search']))->paginate($page),
            'search' => $search,
            'page' => $page
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {

        return view('Jabatan.Add', [
            'panel' => ['user', 'jabatan'],

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'gaji' => 'required|integer'
        ]);

        jabatan::create($data);
        return redirect(route('jabatan.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('Jabatan.Add', [
            'panel' => ['user', 'jabatan'],
            'jabatan' => Jabatan::where('id', $id)->get()

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'gaji' => 'required|integer'
        ]);

        jabatan::where('id', $id)->update($data);
        return redirect(route('jabatan.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        jabatan::where('id', $id)->delete();
        return redirect(route('jabatan.index'));
    }
}
