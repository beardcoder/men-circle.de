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
    Schema::table('events', function (Blueprint $table) {
      $table->renameColumn('date', 'startDate');
      $table->dateTime('endDate')->nullable();
      $table->text('streetAddress')->nullable();
      $table->text('addressLocality')->nullable();
      $table->text('postalCode')->nullable();
      $table->decimal('price', 13, 2);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('events', function (Blueprint $table) {
      $table->renameColumn('startDate', 'date');
      $table->dropColumn(['streetAddress', 'addressLocality', 'postalCode', 'price']);
    });
  }
};
