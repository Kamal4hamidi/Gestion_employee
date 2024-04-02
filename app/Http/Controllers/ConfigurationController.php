<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeConfigRequest;
use App\Models\Configuration;
use Exception;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function index(){
        $allConfigurations = Configuration::latest()->paginate(10);
        return view('config/index',compact('allConfigurations'));
    }

    public function create(){
        return view('config.create');
    }
    
    public function store(storeConfigRequest $request){
        try {   
            Configuration::create($request->all());
            
            return redirect()->route('configuration')->with('success_message','configuration bien ajoute');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception("erreur lors de lenregistrement de la configuration");
        }

    }


    public function delete(Configuration $configuration){
        try {
            $configuration->delete();
            return redirect()->route('configuration')->with('success_message','configuration est supprimer');

        } catch (Exception $e) {
            throw new Exception("Failed to delete");  

        }
    }
}
