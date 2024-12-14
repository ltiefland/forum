<?php

/**
 * Class Comment
 *
 * Represents the Comment model in the application.
 *
 * This model includes functionality for markdown-to-HTML conversion through the ConvertsMarkdownToHtml trait
 * and supports factory creation with the HasFactory trait.
 *
 * The Comment model defines relationships with the User, Post, and Like models via Eloquent relationships.
 *
 * Relationships:
 * - A Comment belongs to a User.
 * - A Comment belongs to a Post.
 * - A Comment can have many Likes (morphMany relationship as a polymorphic entity).
 *
 */

namespace App\Models;

use /**
 * Trait ConvertsMarkdownToHtml
 *
 * Provides functionality to convert Markdown text to HTML.
 *
 * This trait can be used in models where Markdown formatting is
 * utilized, enabling an easy way to parse and display formatted
 * content as HTML within the application.
 */
    App\Models\Concerns\ConvertsMarkdownToHtml;
use /**
 * Trait HasFactory
 *
 * The HasFactory trait is used in Laravel to enable model factories
 * for the model it is applied to. Factories are useful for generating
 * test data or seeding the database with initial data.
 *
 * This trait provides the static method `factory()` to create or initialize
 * a factory for the model.
 *
 * Use this with Eloquent models to leverage Laravel's factory building utilities.
 *
 * @see \Illuminate\Database\Eloquent\Factories\Factory
 */
    Illuminate\Database\Eloquent\Factories\HasFactory;
use /**
 * Class Model
 *
 * The base model class provided by the Laravel framework which interacts with the database
 * using Eloquent ORM. It provides methods for creating, reading, updating, and deleting records
 * in a database table, as well as relationships and other database operations.
 *
 * This model serves as the foundation for all other Eloquent models within the application.
 *
 * Key Features:
 * - Interacts with the configured MySQL database.
 * - Employs query builder and advanced features like eager loading and relationships.
 * - Supports mutators and accessors for attribute manipulation.
 * - Handles timestamps and other common database attributes.
 * - Extensible features for defining methods to customize functionality.
 *
 * Usage:
 * Extend this Model class to define custom models that correspond to database tables.
 *
 * Configured Queue: sync
 */
    Illuminate\Database\Eloquent\Model;
use /**
 * Illuminate\Database\Eloquent\Relations\BelongsTo
 *
 * Represents an Eloquent relationship where a model belongs to another model.
 * It is used to define an inverse one-to-many relationship.
 *
 * Methods:
 * - associate($model): Associate the model instance with the parent.
 * - dissociate(): Remove the association of the model instance from the parent.
 * - getParentKeyName(): Get the name of the key on the parent model.
 * - getQualifiedParentKeyName(): Get the fully qualified key name on the parent model.
 * - getForeignKeyName(): Get the foreign key for the relationship.
 * - getRelation(): Get the relationship instance for eager loading.
 * - getResults(): Get the results of the relationship.
 *
 * Properties:
 * - $child: The child model instance for the relationship.
 * - $foreignKey: The foreign key on the child model.
 * - $ownerKey: The associated key on the parent model.
 * - $relationName: The name of the relationship.
 */
    Illuminate\Database\Eloquent\Relations\BelongsTo;
use /**
 * Represents a polymorphic one-to-many relationship in Laravel's Eloquent ORM.
 *
 * This relationship allows a model to have multiple relationships (MorphMany)
 * to another model through a polymorphic type and ID stored in the related model's table.
 *
 * Polymorphic relationships enable flexibility by allowing a model to belong to more than one
 * other model on a single association.
 *
 * Example scenarios include:
 * - A 'Post' and a 'Video' model having multiple 'Comments'
 *   where the 'comments' table includes columns like 'commentable_type' and 'commentable_id'.
 */
    Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 *
 */
class Comment extends Model
{
    use ConvertsMarkdownToHtml;
    use HasFactory;

    /**
     *
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     *
     */
    public function likes(): MorphMany
    {
        return $this->morphMany( Like::class, 'likeable' );
    }
}
