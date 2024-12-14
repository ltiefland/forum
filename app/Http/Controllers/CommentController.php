<?php

/**
 * Controller class responsible for managing comment resources.
 *
 * Handles operations such as creating, updating, and deleting comments on posts.
 * Ensures authorization for accessing and manipulating the Comment model.
 */

namespace App\Http\Controllers;

    use /**
     * Comment Model
     *
     * This model represents a Comment entity within the application. It interacts with the corresponding
     * database table in MySQL and provides functionality related to comments.
     *
     * Key features:
     * - Handles relationships between Comment and other models.
     * - Provides methods for retrieving, creating, updating, and deleting comments.
     * - Can be used in conjunction with Laravel's Eloquent ORM for database operations.
     *
     * Database:
     * - Uses MySQL as the primary database.
     *
     * Queue:
     * - Operates with a 'sync' queue connection, ensuring queue-related operations are performed synchronously.
     *
     * Usage:
     * - This model is generally used within controllers, services, or repositories to manage comments data.
     *
     * Relationships:
     * - Define the model relationships, such as 'belongsTo' or 'hasMany', with other models as needed.
     *
     * Rules:
     * - Use the `$fillable` property to specify mass-assignable attributes.
     * - Use the `$hidden` property to hide specific attributes from being serialized.
     * - Use the `$casts` property to cast specific attributes to desired data types.
     *
     * Note:
     * - Ensure proper database migrations and schema are set up to work with this model.
     * - Always validate user input when creating or updating comments to maintain data integrity.
     */
        App\Models\Comment;
    use /**
     * The Post model represents an entity in the 'posts' table of the database.
     *
     * This model handles interactions with the corresponding MySQL database table.
     * It operates within the Laravel framework and utilizes Laravel's Eloquent ORM.
     *
     * Features:
     * - Supports attribute mass assignment, relationships, and query scopes.
     * - Provides methods to interact with properties, such as custom accessors and mutators.
     * - Can be queued using Laravel's queue system with the 'sync' connection for immediate processing.
     *
     * General Usage:
     * This model is typically used to perform CRUD operations on the 'posts' table.
     * Additional business logic and application-specific rules can also be implemented here.
     *
     * Note:
     * The application uses the 'sync' queue connection, hence jobs related to this model
     * will execute immediately during request execution instead of being queued for later processing.
     */
        App\Models\Post;
    use /**
     * Class Request
     *
     * The Request class is a part of the Laravel framework and represents an HTTP request.
     * It provides methods to inspect and interact with the incoming request, including
     * retrieving request inputs, headers, query parameters, and files.
     *
     * This class is essential for handling user input in Laravel applications, and it
     * encapsulates all HTTP request details.
     *
     * Fully qualified namespace: Illuminate\Http\Request
     *
     * Important Features:
     * - Access to HTTP request headers, cookies, session, and input data.
     * - Methods for checking the request method or content type.
     * - File uploads and ability to retrieve uploaded files.
     * - Handles request validation conveniently.
     */
        Illuminate\Http\Request;

    /**
     *
     */
    class CommentController extends Controller
    {
        public function __construct()
        {
            $this->authorizeResource( Comment::class );
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store( Request $request, Post $post )
        {
            $data = $request->validate( [ 'body' => [ 'required', 'string', 'max:2500' ] ] );

            Comment::create( [
                                 ...$data,
                                 'post_id' => $post->id,
                                 'user_id' => $request->user()->id,
                             ] );

            return redirect( $post->showRoute() )
                ->banner( 'Comment added.' );
        }

        /**
         * Update the specified resource in storage.
         */
        public function update( Request $request, Comment $comment )
        {
            $data = $request->validate( [ 'body' => [ 'required', 'string', 'max:2500' ] ] );

            $comment->update( $data );

            return redirect( $comment->post->showRoute( [ 'page' => $request->query( 'page' ) ] ) )
                ->banner( 'Comment updated.' );
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy( Request $request, Comment $comment )
        {
            $comment->delete();

            return redirect( $comment->post->showRoute( [ 'page' => $request->query( 'page' ) ] ) )
                ->banner( 'Comment deleted.' );
        }
    }
