<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Http\Requests\saveDepartementRequest;
use App\Http\Requests\SaveDepRequest;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index() 
    {
        $departements = Departement::paginate(5);
        return view('departements.index', compact('departements'));
    }
    public function create()
    {
        return view('departements.create');
    }
    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }

    //interaction avec BD
    public function store(Departement $departement, SaveDepRequest $request)
    {
        try {
            // dd($request);
            $departement->name = $request->nom_departement;
            $departement->save();

            return redirect()
                ->route('departement.index')
                ->with('success-message', 'departement enregistrer');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Departement $departement, SaveDepRequest $request)
    {
        try {
            // dd($request);
            $departement->name = $request->nom_departement;
            $departement->update();

            return redirect()
                ->route('departement.index')
                ->with('success-message', 'departement modified');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete(Departement $departement)
    {
        try {
            // dd($request);
            $departement->delete();

            return redirect()
                ->route('departement.index')
                ->with('success-message', 'departement supprimer');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
