<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('category');
            $table->foreignId('author_id')->constrained('author');
            $table->tinyText('book_title');
            $table->text('book_summary');
            $table->decimal('book_price', 5, 2, true);
            $table->string('book_cover_photo', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review');
        Schema::dropIfExists('discount');
        Schema::dropIfExists('book');
    }
}
