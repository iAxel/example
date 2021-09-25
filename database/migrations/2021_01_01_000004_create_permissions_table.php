<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreatePermissionsTable extends Migration
{
    /**
     * @var string
     */
    protected string $table = 'permissions';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('slug');

            $table->unsignedBigInteger('policy_id');

            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::table($this->table, function (Blueprint $table) {
            $table->index('name');

            $table->unique([
                'slug',
                'policy_id',
            ]);

            $table->foreign('policy_id')->references('id')->on('policies')->onDelete('cascade');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
