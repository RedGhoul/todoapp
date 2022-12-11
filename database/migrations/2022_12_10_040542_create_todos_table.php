<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('content');
            $table->foreignId('user_id')->index()->nullable()->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE todos ADD COLUMN searchtext TSVECTOR");
        DB::statement("UPDATE todos SET searchtext = to_tsvector('english', title || '' || content)");
        DB::statement("CREATE INDEX searchtext_gin ON todos USING GIN(searchtext)");
        DB::statement("CREATE TRIGGER ts_searchtext BEFORE INSERT OR UPDATE ON todos FOR EACH ROW EXECUTE PROCEDURE tsvector_update_trigger('searchtext', 'pg_catalog.english', 'title', 'content')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS tsvector_update_trigger ON todos");
        DB::statement("DROP INDEX IF EXISTS searchtext_gin");
        DB::statement("ALTER TABLE todos DROP COLUMN searchtext");
        Schema::dropIfExists('todos');
    }
};
