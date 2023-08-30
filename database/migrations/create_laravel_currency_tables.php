<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("currencies", function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("short_form")->unique()->nullable();
            $table->string("code")->unique();
            $table->string("symbol")->nullable();
            $table->decimal("value")->default(0);
            $table->timestamps();
        });

        Schema::create("user_has_currencies", function (Blueprint $table) {
            $table->id();
            $table->string("guard_name");
            $table->unsignedBigInteger("user_id");
            $table->foreignId("currency_id")->references("id")->on("currencies")->cascadeOnDelete();
        });

        Schema::create("model_has_currencies", function (Blueprint $table) {
            $table->id();
            $table->string("model_type");
            $table->unsignedBigInteger("model_id");
            $table->foreignId("currency_id")->references("id")->on("currencies")->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("currencies");

        Schema::dropIfExists("user_has_currencies");

        Schema::dropIfExists("model_has_currencies");
    }
};
