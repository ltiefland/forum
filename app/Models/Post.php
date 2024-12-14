<?php

/**
 * Represents a Post model in the application.
 *
 * This model interacts with the 'posts' table in the database and provides
 * relationships and attribute transformations specific to a post.
 * Contains functionality for Markdown to HTML conversion and uses Eloquent factories.
 *
 * Relationships:
 * - Belongs to a User for the author of the post.
 * - Belongs to a Topic to categorize the post.
 * - Has many Comments representing responses to the post.
 * - Morph many Likes for polymorphic liking functionality.
 *
 * Attributes:
 * - Provides a mutator for the 'title' attribute to convert it to title case.
 *
 * Methods:
 * - Generates a route for displaying the post using specific parameters.
 */

namespace App\Models;

    use /**
     * This concern provides functionality to convert Markdown to HTML.
     *
     * It is used for processing Markdown formatted text into HTML format
     * in a Laravel application.
     *
     * This concern is typically meant to be used in Laravel models
     * and is intended to work seamlessly with other model functionalities.
     *
     * Ensure the required Markdown parsing library or utility is available
     * and configured properly for this concern to function as expected.
     */
        App\Models\Concerns\ConvertsMarkdownToHtml;
    use /**
     * Provides a way to define custom getters and setters for Eloquent model attributes.
     *
     * This allows the developer to transform attributes from raw database values when retrieving
     * them to their transformed representation. Similarly, it enables the transformation of
     * attributes before they're set back into the model or saved into the database.
     *
     * You can utilize this functionality to define data casts, perform encryption/decryption,
     * format data, or apply any other logic to model attributes.
     *
     * Common methods:
     * - get(): Used for transforming an attribute when accessing it.
     * - set(): Used for transforming an attribute when assigning a value.
     *
     * Attributes declared using this class are treated as computed or customized properties
     * for the model.
     */
        Illuminate\Database\Eloquent\Casts\Attribute;
    use /**
     * Trait HasFactory
     *
     * This trait provides functionality to enable factory support
     * for Eloquent models in a Laravel application.
     *
     * Factories allow for the creation of model instances
     * with predefined attributes, commonly used for testing
     * and database seeding purposes.
     *
     * It is included in models to utilize Laravel's fluent
     * factory methods and streamlined data creation processes.
     */
        Illuminate\Database\Eloquent\Factories\HasFactory;
    use /**
     * This is an Eloquent model class for interacting with a database table in a Laravel application.
     *
     * The model leverages functionality provided by Illuminate\Database\Eloquent\Model
     * to interact with the MySQL database used by the application.
     * It assumes that the database connection, schema, and table have been configured as per Laravel's conventions.
     *
     * Queue connection used in the application: sync
     * Application Name: Laravel
     * Laravel Version: v11.11.1
     */
        Illuminate\Database\Eloquent\Model;
    use /**
     * Represents a "Belongs To" relationship in Eloquent.
     *
     * This relationship is used to define an inverse association between two Eloquent models.
     */
        Illuminate\Database\Eloquent\Relations\BelongsTo;
    use /**
     * Define a one-to-many relationship.
     *
     * The HasMany relationship is used to define a relationship where a single model
     * owns many instances of another model. For example, a "User" model may have
     * many "Post" models associated with it.
     *
     * This relationship is typically used in Eloquent ORM to establish associations
     * between models. The foreign key on the child model typically points to the
     * parent model in the database.
     *
     * Usage of this relationship allows you to interact with the related data,
     * such as retrieving, attaching, detaching, or updating related models, while
     * following the principles of object-relational mapping.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
        Illuminate\Database\Eloquent\Relations\HasMany;
    use /**
     * Class MorphMany
     *
     * @package Illuminate\Database\Eloquent\Relations
     *
     * Represents a polymorphic one-to-many relationship in Eloquent.
     * This relation type allows a model to have a one-to-many relationship
     * where the related models could belong to more than one type of model.
     *
     * A MorphMany relation is used when the related models store the
     * polymorphic type and ID.
     *
     * For example, a "Comment" model can belong to both a "Post" and a "Video"
     * model. The MorphMany relationship allows associating such comments with
     * the respective parent model without database model constraints.
     */
        Illuminate\Database\Eloquent\Relations\MorphMany;
    use /**
     * The Str class provides a variety of string manipulation methods.
     *
     * This class contains utility methods to perform common
     * string operations such as formatting, extracting, replacing,
     * and transforming strings. These methods can be used
     * statically and are extensively used throughout Laravel applications.
     *
     * Methods in this class include functionalities for
     * string cases, string trimming, substring extraction,
     * random string generation, and more.
     *
     * This class is part of the Laravel Illuminate\Support package,
     * designed to support advanced string handling operations.
     */
        Illuminate\Support\Str;
    use Laravel\Scout\Searchable;

    /**
     *
     */
    class Post extends Model
    {
        use ConvertsMarkdownToHtml;
        use HasFactory, Searchable;

        /**
         *
         */
        public function user(): BelongsTo
        {
            return $this->belongsTo( User::class );
        }

        /**
         *
         */
        public function topic(): BelongsTo
        {
            return $this->belongsTo( Topic::class );
        }

        /**
         *
         */
        public function comments(): HasMany
        {
            return $this->hasMany( Comment::class );
        }

        /**
         *
         */
        public function title(): Attribute
        {
            return Attribute::set( fn( $value ) => Str::title( $value ) );
        }


        /**
         * Generate the URL for the "posts.show" route with the given parameters.
         *
         * @param array $parameters Additional parameters to include in the route URL.
         * @return string The generated route URL.
         */
        public function showRoute(array $parameters = [] )
        {
            return route( 'posts.show', [ $this, Str::slug( $this->title ), ...$parameters ] );
        }

        /**
         *
         */
        public function likes(): MorphMany
        {
            return $this->morphMany( Like::class, 'likeable' );
        }

    }
