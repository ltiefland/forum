<?php

/**
 * Controller responsible for handling operations on the "Like" resource.
 */

namespace App\Http\Controllers;

    use /**
     * The Like model represents a user's "like" action within the application.
     *
     * This model interacts with the `likes` table in the MySQL database and provides
     * functionality to manage and query the like records.
     *
     * Key Features:
     * - Handles relationships with other models, such as `Post` or `User`.
     * - Provides scopes and methods for querying likes associated with specific entities.
     * - Utilizes Laravel's Eloquent ORM for database interactions.
     *
     * Database Connection:
     * - Uses MySQL as the primary database.
     *
     * Queuing:
     * - Operations associated with this model utilize the `sync` queue connection.
     */
        App\Models\Like;
    use /**
     * Class Model
     *
     * This is the base class for all Eloquent models in a Laravel application.
     * Eloquent models provide an active record implementation to interface with
     * the database, allowing developers to work with database records and models seamlessly.
     *
     * Features include:
     * - Query building capabilities.
     * - Relationship management (one-to-one, one-to-many, etc.).
     * - Events, observers, and model lifecycle hooks.
     * - Support for mass assignment, accessors, and mutators.
     *
     * This class extends all functionality provided by `Illuminate\Database\Eloquent\Model`.
     *
     * Usage recommendation:
     * - Extend this class for each database table in your application.
     * - Define attributes, relationships, and other custom logic specific to your data model.
     */
        Illuminate\Database\Eloquent\Model;
    use /**
     * Exception thrown when a requested Eloquent model is not found.
     *
     * This exception is generally used within the context of Laravel's
     * Eloquent ORM and is automatically thrown when attempting to resolve
     * or retrieve a model that does not exist.
     *
     * Example scenarios for this exception:
     * - Querying a model by its primary key with findOrFail() or firstOrFail()
     *   and no results are found.
     *
     * This exception extends Illuminate\Database\Eloquent\ModelNotFoundException
     * and inherits its methods and properties, offering functionality
     * related to missed queries and models.
     *
     * The exception is caught by default in Laravel applications and
     * results in a 404 HTTP response, indicating that the requested
     * entity was not located.
     */
        Illuminate\Database\Eloquent\ModelNotFoundException;
    use /**
     * This class serves as a base class for defining relationships in Laravel's Eloquent ORM.
     * It provides methods and properties that are common to all relationship types.
     * Relationships allow you to define the connections between different Eloquent models.
     *
     * @package Illuminate\Database\Eloquent\Relations
     * @mixin \Illuminate\Database\Eloquent\Builder
     * @mixin \Illuminate\Database\Query\Builder
     */
        Illuminate\Database\Eloquent\Relations\Relation;
    use /**
     * Represents an HTTP request in a Laravel application.
     *
     * This class extends Symfony's Request class and provides additional features
     * specifically designed for Laravel, enabling easier interaction with HTTP requests.
     *
     * @see \Symfony\Component\HttpFoundation\Request
     */
        Illuminate\Http\Request;

    /**
     * This controller handles actions related to "likes" functionality,
     * which includes listing, creating, storing, showing, editing, updating,
     * and deleting "like" resources.
     */
    class LikeController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            //
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store( Request $request, string $type, int $id )
        {
            $likeable = $this->findLikeable( $type, $id );
            $this->authorize( 'create', [ Like::class, $likeable ] );
            $likeable->likes()->create( [
                                            'user_id' => $request->user()->id,
                                        ] );
            $likeable->increment( 'likes_count' );
            return back();
        }

        /**
         * Display the specified resource.
         */
        public function show( Like $like )
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit( Like $like )
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update( Request $request, Like $like )
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy( Like $like )
        {
            //
        }

        private function findLikeable( string $type, int $id )
        {
            /** @var class-string<Model>|null $modelName */
            $modelName = Relation::getMorphedModel( $type );
            if ( $modelName === null )
            {
                throw new ModelNotFoundException();
            }
            return $modelName::findOrFail( $id );
        }
    }
