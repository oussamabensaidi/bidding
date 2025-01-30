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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Owner of the item
            $table->string('name');
            $table->text('description');
            $table->decimal('starting_bid', 10, 2); // hada kydiro ladmin 
            $table->decimal('current_bid', 10, 2)->nullable()->default(0); // price fin wassel
            $table->timestamp('end_time')->nullable(); // timer dial item fach kykhtar l admine ch7al dial lw9t ayb9a litem kytzad dak time 3la now() o kytsd l biding 3la litem fach ktwsl dik sa3a
            $table->boolean('status')->default(true); // true = ongoing, false = ended
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
