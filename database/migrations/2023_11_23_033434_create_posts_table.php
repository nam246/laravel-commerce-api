<?php

use App\Models\PostCategories;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 225);
            $table->text('description');
            $table->string('image', 225);
            $table->text('body');
            $table->boolean('publish')->default(false);
            $table->unsignedBigInteger('user_id')->default(1);
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('post_category_id')->default(1);
            $table->foreign('post_category_id')->references('id')->on('post_categories');
            $table->timestamps();
        });
    }

    /**
     * Get the category that owns the post.
     */
    public function category()
    {
        return $this->belongsTo(PostCategories::class, 'post_category_id');
    }

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
