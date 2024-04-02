<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Employer;
use App\Models\User;
use Carbon\Carbon;

class AppController extends Controller
{
    public function index()
    {
        $totalDepartements = Departement::all()->count();
        $totalEmployees = Employer::all()->count();
        $totalAdminstrateurs = User::all()->count();
        $defaultPaymentDate = null;
        $paymentNotification = "";
        $currentDate = Carbon::now()->day;
        // dd($currentDate);


        // $appName = Configuration::where('type', 'APP_NAME')->first();
        // dd($appName->value);

        $defaultPaymentDateQuery = Configuration::where('type', 'PAYMENT_DATE')->first();
        if ($defaultPaymentDateQuery) {
            $defaultPaymentDate = $defaultPaymentDateQuery->value;
            // dd();
            $convertedPaymentDate = intval($defaultPaymentDate);

            if ($currentDate < $convertedPaymentDate) {
                $paymentNotification = "Le paiment doit avoir lieu le " . $defaultPaymentDate . " de ce mois" ;
            }else{
                $nextMonth = Carbon::now()->addMonth();
                $nextMonthName = $nextMonth->format("F");

                $paymentNotification = "Le paiment doit avoir lieu le " . $defaultPaymentDate . " de ce mois de la " . $nextMonthName ;
            }
        }

        return view("dashboard",compact('totalDepartements','totalEmployees','totalAdminstrateurs','paymentNotification'));
    }
    
}
