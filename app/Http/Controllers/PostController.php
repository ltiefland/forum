<?php

/**
 * Controller for managing post resources.
 *
 * This controller handles CRUD operations for posts, including listing,
 * creating, showing, updating, and deleting them. It also manages
 * filter and pagination logic for displaying posts.
 */

namespace App\Http\Controllers;

    use /**
     * CommentResource Class
     *
     * This resource transforms a given comment model into an array
     * that can be returned as a JSON response from an API endpoint.
     * It is intended to help format and control the data structure
     * sent to the client for the comments data.
     *
     * @package App\Http\Resources
     */
        App\Http\Resources\CommentResource;
    use /**
     * PostResource
     *
     * This resource transforms the given post data for API responses.
     * It is used to define how post data is formatted for JSON output.
     *
     * @package App\Http\Resources
     */
        App\Http\Resources\PostResource;
    use /**
     * TopicResource - A resource class for transforming topic data.
     *
     * This resource transforms the given topic model instance into
     * a JSON-serializable structure. It ensures proper formatting
     * and inclusion of relevant attributes for API responses.
     *
     * @package App\Http\Resources
     * @extends \Illuminate\Http\Resources\Json\JsonResource
     */
        App\Http\Resources\TopicResource;
    use /**
     * Class Post
     * Represents a Post model for the Laravel application.
     *
     * This model interacts with the 'posts' table in the MySQL database.
     *
     * Features:
     * - Used for managing posts data.
     * - Leverages Eloquent ORM for database interaction.
     * - Queue connection is set to 'sync' for all operations.
     *
     * Relationships:
     * - Define relationships such as authors, comments, or categories if applicable.
     *
     * Methods:
     * - Methods for CRUD operations and any custom queries specific to the business logic.
     *
     * Note:
     * - This model assumes database migrations and schema align with Laravel conventions.
     */
        App\Models\Post;
    use /**
     * Class Topic
     *
     * This model represents the "topics" entity in the application.
     * It is primarily used for interacting with the database table
     * associated with topics.
     *
     * This model interacts with a MySQL database and adheres to the
     * query methods and conventions provided by Laravel's Eloquent ORM.
     *
     * The application utilizes a synchronous queue connection.
     *
     * Note: Ensure proper indexing in the database for better query performance
     * when dealing with a large number of topic records.
     *
     * @package App\Models
     * @extends \Illuminate\Database\Eloquent\Model
     */
        App\Models\Topic;
    use /**
     * Class Builder
     *
     * This class is responsible for building and executing database queries in Laravel.
     * It extends the query builder with an object-oriented API specific to Eloquent ORM,
     * allowing for interaction with models and their underlying database tables.
     *
     * This class provides methods for retrieving, inserting, updating, and deleting
     * records in the database using the Eloquent ORM syntax and conventions.
     *
     * @package Illuminate\Database\Eloquent
     */
        Illuminate\Database\Eloquent\Builder;
    use /**
     * Class Request
     *
     * The Request class in Laravel handles HTTP requests and provides methods
     * to retrieve input data, file uploads, headers, and cookies from the request.
     * It extends Symfony's HTTP Foundation Request class and includes additional
     * functionalities tailored for Laravel applications.
     *
     * @package Illuminate\Http
     *
     * @method bool has(string|array $key) Determine if the request contains a given input item key.
     * @method mixed input(string|null $key = null, mixed $default = null) Retrieve an input item from the request.
     * @method array all(array|mixed|null $keys = null) Retrieve all input data or specific set of input data.
     * @method bool exists(string|array $key) Determine if the request input item(s) exist.
     * @method string|null header(string $key = null, mixed $default = null) Retrieve a header from the request.
     * @method string|null cookie(string $key = null, mixed $default = null) Retrieve a cookie from the request.
     * @method string method() Retrieve the request HTTP method.
     * @method string path() Retrieve the request URI path.
     * @method string url() Retrieve the request URL without query strings.
     * @method string fullUrl() Retrieve the full URL including query strings.
     * @method bool isMethod(string $method) Check if HTTP request method matches the given method.
     * @method bool prefers(array|string $contentTypes) Determine which content type the request prefers.
     * @method bool isJson() Determine if the request has been made via JSON.
     * @method mixed json(string|null $key = null, mixed $default = null) Retrieve JSON payload from the request.
     * @method bool wantsJson() Determine if the request expects a JSON response.
     * @method bool ajax() Determine if the request has been made using AJAX.
     * @method bool secure() Determine if the request is over HTTPS.
     * @method string ip() Retrieve the client IP address.
     * @method array ips() Retrieve an array of the client's IP addresses.
     * @method bool hasFile(string $key) Determine if the request contains a file.
     * @method \Illuminate\Http\UploadedFile|null file(string $key, mixed $default = null) Retrieve an uploaded file from the request.
     * @method array files() Retrieve all uploaded files from the request.
     */
        Illuminate\Http\Request;
    use /**
     * The Str class provides a variety of string manipulation methods.
     * It serves as a utility class for working with and transforming strings.
     *
     * This class is part of the Laravel framework and includes many helpful methods
     * for string operations such as concatenation, formatting, trimming, converting case, etc.
     *
     * Commonly used for tasks such as slug generation, random string creation, and string comparison.
     */
        Illuminate\Support\Str;

    /**
     * Controller for handling Post resource-related actions.
     */
    class PostController extends Controller
    {
        public function __construct()
        {
            $this->authorizeResource( Post::class );
        }

        /**
         * Display a listing of the resource.
         */
        public function index( Request $request, Topic $topic = null )
        {
            if ( $request->query( 'query' ) )
            {
                $posts = Post::search( $request->query( 'query' ) )
                             ->query( fn( Builder $query ) => $query->with( [ 'user', 'topic' ] ) )
                             ->when( $topic, fn( \Laravel\Scout\Builder $query ) => $query->where( 'topic_id', $topic->id ) );
            }
            else
            {
                $posts = Post::with( [ 'user', 'topic' ] )
                             ->when( $topic, fn( Builder $query ) => $query->whereBelongsTo( $topic ) )
                             ->latest()
                             ->latest( 'id' );
            }
            return inertia( 'Posts/Index', [
                'posts'         => PostResource::collection( $posts ),
                'topics'        => fn() => TopicResource::collection( Topic::all() ),
                'selectedTopic' => fn() => $topic ? TopicResource::make( $topic ) : null,
                'query'         => $request->query( 'query' ),
            ] );
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return inertia( 'Posts/Create', [
                'topics' => TopicResource::collection( Topic::all() ),
            ] );
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store( Request $request )
        {
            $data = $request->validate( [
                                            'title'    => [ 'required', 'string', 'min:10', 'max:120' ],
                                            'topic_id' => [ 'required', 'exists:topics,id' ],
                                            'body'     => [ 'required', 'string', 'min:100', 'max:10000' ],
                                        ] );

            $post = Post::create( [
                                      ...$data,
                                      'user_id' => $request->user()->id,
                                  ] );

            return redirect( $post->showRoute() );
        }

        /**
         * Display the specified resource.
         */
        public function show( Request $request, Post $post )
        {
            if ( !Str::endsWith( $post->showRoute(), $request->path() ) )
            {
                return redirect( $post->showRoute( $request->query() ), status: 301 );
            }

            $post->load( 'user', 'topic' );

            return inertia( 'Posts/Show', [
                'post'     => fn() => PostResource::make( $post )->withLikePermission(),
                'comments' => function () use ( $post )
                {
                    $commentResource = CommentResource::collection( $post->comments()->with( 'user' )->latest()->latest( 'id' )->paginate( 10 ) );

                    $commentResource->collection->transform( fn( $resource ) => $resource->withLikePermission() );
                    return $commentResource;
                },
            ] );
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit( Post $post )
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update( Request $request, Post $post )
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy( Post $post )
        {
            //
        }
    }
