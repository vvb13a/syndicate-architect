<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blueprints', function (Blueprint $table) {
            // === Identifiers ===
            $table->id();
            $table->string('key');
            $table->string('type');
            $table->string('fqn');

            // === UI Label  ===
            $table->string('title')->nullable();

            // === Visibility ===
            $table->string('visibility')->default('draft')->index();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('revised_at')->nullable();

            // === Localization ===
            $table->string('language')->default(app()->getLocale())->index();
            $table->foreignId('localization_id')->nullable()->constrained('localizations')->nullOnDelete();

            // === Hierarchy ===
            $table->foreignId('parent_id')->nullable()->constrained('blueprints')->nullOnDelete();

            // === Constraints ===
            $table->unique(['key', 'type', 'language']);
            $table->unique(['localization_id', 'language']);

            // === Timestamps ===
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blueprints');
    }
};
