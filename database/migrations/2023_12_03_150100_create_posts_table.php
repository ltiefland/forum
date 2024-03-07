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
            Schema::create( 'posts', function ( Blueprint $table )
            {
                $table->id();
                $table->foreignId( 'user_id' )->constrained()->restrictOnDelte();
                $table->text( 'title' );
                $table->longtext( 'body' );
                $table->longtext( 'html' );
                $table->timestamps();
            } );
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists( 'posts' );
        }
    };
