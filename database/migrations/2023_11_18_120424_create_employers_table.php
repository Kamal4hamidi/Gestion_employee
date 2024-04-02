<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email',255);
            $table->string('contact');
            $table->integer('montant_journalier')->nullable(); //pour donne la possibilite de ne pas linitialiser le montant en debut

            $table->unsignedBigInteger('departements_id');
            $table->foreign('departements_id')->references('id')->on('departements');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
