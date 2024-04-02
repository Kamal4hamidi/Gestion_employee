<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\Employer;
use Exception;

class EmployerController extends Controller
{
    function index()
    {
        $employers = Employer::with('departement')->paginate(10);
        return view('employers.index', compact('employers'));
    }
    function create()
    {
        $departementsList = Departement::all();
        return view('employers.create',compact('departementsList'));
    }
    function edit(string $id)
    {
        $employer = Employer::findOrFail($id);
        $departements = Departement::all();

        return view('employers.edit', compact('employer','departements'));
    }

    function store(Employer $employer, SaveEmployerRequest $request)
    {
        try {
        // dd($request);
            $employer->departements_id = $request->departement_id;
            $employer->nom = $request->nom_employer;
            $employer->prenom = $request->prenom_employer;
            $employer->email = $request->email_employer;
            $employer->contact = $request->phone_employer;
            $employer->montant_journalier = $request->montant_journalier;

            $employer->save();
            return redirect()
                ->route('employer.index')
                ->with('success-message', 'employer a été bien enregistrer');
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    function update(Employer $employer, UpdateEmployerRequest $request)
    {

        // dd($request);
        try {
            $employer->departements_id = $request->departement_id;
            $employer->nom = $request->nom_employer;
            $employer->prenom = $request->prenom_employer;
            $employer->email = $request->email_employer;
            $employer->contact = $request->phone_employer;
            $employer->montant_journalier = $request->montant_journalier;

            $employer->update();

            return redirect()
                ->route('employer.index')
                ->with('success-message', 'employer a bien modifier');
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }


    public function delete(Employer $employer){
        try {
            $employer->delete();

            return redirect()->route('employer.index')->with('success-message', 'Employer deleted successfully');
        }catch(Exception $e) {
            dd($e);
        }
    }

    function testEmp(){
        $employers = Employer::paginate(5);
        return  dd($employers);
    }
}
