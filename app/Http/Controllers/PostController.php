<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StorePostRequest;
    use App\Http\Requests\UpdatePostRequest;
    use App\Http\Resources\CommentResource;
    use App\Http\Resources\PostResource;
    use App\Models\Post;
    use Inertia\Inertia;
    use Inertia\Response;
    use Inertia\ResponseFactory;

    class PostController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index(): Response|ResponseFactory
        {
            return inertia( "Posts/Index", [
                "posts" => PostResource::collection( Post::with( 'user' )->latest()->latest( 'id' )->paginate() ),
            ] );
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
        public function store( StorePostRequest $request )
        {
            //
        }

        /**
         * Display the specified resource.
         */
        public function show( Post $post )
        {
            $post->load( 'user' );
            return inertia( 'Posts/Show', [
                "post"     => fn() => PostResource::make( $post ),
                "comments" => fn() => CommentResource::collection( $post->comments()->with( 'user' )->latest()->latest( 'id' )->paginate( 10 ) ),
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
        public function update( UpdatePostRequest $request, Post $post )
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
