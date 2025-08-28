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
        Schema::create('user_holdings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('fund_name');
            $table->string('fund_code');
            $table->date('transaction_date');
            $table->string('transaction_type');
            $table->decimal('total_investment', 18, 2);
            $table->decimal('nav', 18, 2);
            $table->decimal('current_value', 18, 2);
            $table->decimal('unrealized_pl_myr', 18, 2);
            $table->decimal('unrealized_pl_percentage', 4, 2);
            $table->timestamps(); //created_at dan updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_holdings');
    }
};
