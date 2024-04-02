<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeAdminRequest;
use App\Http\Requests\submitDefineAccessRequest;
use App\Http\Requests\updateAdminRequest;
use App\Models\ResetCodePassword;
use App\Models\User;
use App\Notifications\SendEmailToAdminAfterRegistrationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;




class AdminController extends Controller
{

    
    public function index(){
        $admins = User::paginate(10);
        return view ('admin/index', compact('admins'));
    }

    public function create()
    {
        return view('admin/create');
    }
    public function edit(User $user)
    {
        return view('admin/create', compact('user'));
    }

    public function store(storeAdminRequest $request)
    {
        // dd($request);
        //Enregistrer una admin et envoyer un mail
        try {
            //     //logique de creation du compte admin
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('default');
            $user->save();

            
            //Envoyer un email de confirmation du compte
            
            //Envoyer un code par email pour verification
            //     if ($user) {
            //         try {
            //             ResetCodePassword::where('email', $user->email)->delete();

            //             $code = rand(1000, 4000);
            //             $data = [
                //                 'code' => $code,
                //                 'email' => $user->email,
                //             ];
                
                //             ResetCodePassword::create($data);
                
                //             Notification::route('mail', $user->email)->notify(new SendEmailToAdminAfterRegistrationNotification($code, $user->email));
                
                //             return redirect()->route('admin.index')->with('success-messages', 'Admin bien ajoute');
                //         } catch (Exception $e) {
                    //             dd($e);
                    //             throw new Exception('there is a error sending email');
                    //         }
                    // }
                    if ($user) { 
                        // dd($user->email);
                        try {
                            ResetCodePassword::where('email', $user->email)->delete();
                            $code = rand(1000, 4000);
                            
                            $data = [
                                'code' => $code,
                                'email' => $user->email
                            ];
                            ResetCodePassword::create($data);
                            
                            Notification::route('mail', $user->email)->notify(new SendEmailToAdminAfterRegistrationNotification($code, $user->email));
                            
                            
                            //Rediriger l'utilisateur vers une URL
                            return redirect()->route('admin.index')->with('success_message', 'Admin a été bien enregistrer');

                    // return redirect()->route('administrateurs')->with('success_message', 'Administrateur ajouté');
                } catch (Exception $e) {
                    dd($e);
                    throw new Exception('Une erreur est survenue lors de l\'envoie du mail');
                }
            }
        } catch (Exception $e) {
            dd($e);
            throw new Exception('une erreur survenie lors de la creation de cet amin');
        }
    }

    public function update(updateAdminRequest $request, User $user)
    {
        try {
            //logique de MAJ du compte admin
        } catch (Exception $e) {
            throw new Exception('une erruer survenie lors de la MAJ');
        }
    }


    public function delete(User $user, Request $request)
    {
        try {
            // dd($request);
            $user->delete();

            return redirect()
                ->route('admin.index')
                ->with('success-message', 'Admin supprimer');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function defineAccess($email)
    {
        // dd($email);

        $checkUserExist = User::where('email', $email)->first();

        if($checkUserExist){
            return view('auth.validate-account',compact('email'));
        }else{
            // return redirect()->route('login');
        }
    }

    public function submitDefineAccess(submitDefineAccessRequest $request){
        dd($request);
    }
}
