<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('banners', function (Blueprint $table) {
        $table->id();
        $table->string('title')->nullable();
        $table->string('image'); // store path
        $table->string('link')->nullable(); // optional redirect link
        $table->boolean('status')->default(1);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
