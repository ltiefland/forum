<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Casts\Attribute;

    class Post extends Model
    {
        use HasFactory;

        protected $appends=["teaser"];

        public function comments(): HasMany
        {
            return $this->hasMany( Comment::class );
        }

        public function user(): BelongsTo
        {
            return $this->belongsTo( User::class );
        }

        protected function teaser(): Attribute
        {
            return Attribute::make(
                get: fn( ?string $value,array $attributes ) => substr( $attributes["body"], 0, 50 ) . "...",
            );
        }
    }
