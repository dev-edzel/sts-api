<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number');
            $table->string('reference_no')->nullable();
            $table->unsignedBigInteger('ticket_types_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->string('status')->default('open');
            $table->string('initiator')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ticket_types_id')->references('id')->on('ticket_types');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
        });

        Schema::create('ticket_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id');
            $table->string('email');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('address');
            $table->integer('phone_number');
            $table->string('subject')->nullable();
            $table->string('concern')->nullable();
            $table->string('attachment')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ticket_id')->references('id')->on('tickets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('ticket_infos');
    }
};
