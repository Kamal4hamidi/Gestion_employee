<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Departement;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employer extends Model
{
    use HasFactory;
    protected $guarded = [''];



    public function departement() 
    {
        return $this->belongsTo(Departement::class,'departements_id');
    }

    
    // public function departement()
    // {
    //     return $this->hasOne(Departement::class, 'id', 'id'); //select * from Departement where employer_id = id
    // } 
}
