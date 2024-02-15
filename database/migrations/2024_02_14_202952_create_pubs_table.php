<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


//!para interactuar con la tabla (Eloquent) /app/Models/[model].php
//!crear esta migration
// * > php artisan make:model [Nombre PascalCase singular] -mrc
return new class extends Migration
{
    /**
     * Run the migrations.
     */

	//!comando para hacer cambios
	//* > php artisan migrate
	//?---crear o modicar tablas
    public function up(): void
    {
        Schema::create('pubs', function (Blueprint $table) {
            $table->id();
			$table->foreignId('user_id')->constrained()->cascadeOnDelete();
			$table->string('publicacion');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */

	 //!comando para dehacer cambios ultimo lote db/migration->batch
	//* > php artisan migrate:rollback 

	//!comando para dehacer cambios ultimo lote db/migration->batch --step=n n migraciones
	//* > php artisan migrate:rollback --step=1
	 //?---contrario a up()
    public function down(): void
    {
        Schema::dropIfExists('pubs');
    }
};
