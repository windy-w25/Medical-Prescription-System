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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescription_id');
            $table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('cascade');
            $table->text('quotation_details');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });

        Schema::create('quotation_drug', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->constrained('quotations');
            $table->foreignId('drug_id')->constrained('drugs');
            $table->integer('quantity');
            $table->decimal('total_price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
