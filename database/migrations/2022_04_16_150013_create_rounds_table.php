<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('season_id')->constrained()->cascadeOnDelete();
            $table->foreignId('track_variation_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('car_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->date('starts_at');
            $table->date('ends_at');
            $table->timestamp('closed_at')->nullable(); // shouldn't be necessary but allows admins to manually close a round before the ends_at date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rounds');
    }
};
