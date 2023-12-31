<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StoreCommentRequest;
    use App\Http\Requests\UpdateCommentRequest;
    use App\Models\Comment;
    use App\Models\Post;

    class CommentController extends Controller
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
        public function store( StoreCommentRequest $request, Post $post )
        {
            //

            $data = $request->validate( [
                "body" => [ "required", "string", "max:2500" ]
            ] );
            Comment::make( $data )
                ->user()->associate( $request->user() )
                ->post()->associate( $post )
                ->save();

            return to_route( "posts.show", $post );
        }

        /**
         * Display the specified resource.
         */
        public function show( Comment $comment )
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit( Comment $comment )
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update( UpdateCommentRequest $request, Comment $comment )
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy( Comment $comment )
        {
            //
        }
    }
