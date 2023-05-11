<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Persediaan;
use Illuminate\Http\Request;
use App\Models\PersediaanList;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $page = request()->pagination ?? 10;
        return view('Menu.Menu', [
            'panel' => ['menu', 'index'],
            'page' => $page,
            'search' => request()->search,
            'persediaan' => Persediaan::all(),
            'menu' => Menu::latest()->paginate($page)
        ]);
    }


    public function create()
    {
        $id = Menu::create()->id;
        return redirect(route('menu.add', ['id' => $id]));
    }

    public function add($id)
    {

        return view('Menu.Add', [
            'panel' => ['menu', 'index'],
            'persediaan' => Persediaan::all(),
            'menu' => Menu::where('id', $id)->get()[0]
        ]);
    }

    public function store(Request $request, $id)
    {


        $data = $request->validate([
            'name' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'foto' => 'image|max:8000'


        ]);
        if ($request->file('foto')) {
            $data['foto'] = $request->file('foto')->store('menu');
            if (Menu::where('id', $id)->get()[0]->foto) {
                Storage::delete(Menu::where('id', $id)->get()[0]->foto);
            }
        } else {
            $data['foto'] = Menu::where('id', $id)->get()[0]->foto;
        }


        Menu::where('id', $id)->update($data);
        return redirect(route('menu.addPersediaan', ['id' => $id]));
    }


    public function addPersediaan($id)
    {
        return view('Menu.AddPersediaan', [
            'panel' => ['menu', 'index'],
            'persediaan' => Persediaan::all(),
            'menu' => Menu::where('id', $id)->get()[0]
        ]);
    }

    public function storePersediaan(Request $request)
    {

        $data = $request->validate([
            'persediaan_id' => 'required',
            'menu_id' => 'required',
            'jumlah' => 'required|numeric'
        ]);


        PersediaanList::create($data);
        return back();
    }


    public function deletePersediaan($id)
    {
        PersediaanList::destroy($id);
        return back();
    }

    public function delete($id)
    {
        if (Menu::where('id', $id)->get()[0]->foto) {

            Storage::delete(Menu::where('id', $id)->get()[0]->foto);
        }
        menu::destroy($id);
        return redirect(route('menu'));
    }
}
