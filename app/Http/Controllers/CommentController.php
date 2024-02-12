<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\StoreCommentRequest;
    use App\Http\Requests\UpdateCommentRequest;
    use App\Models\Comment;
    use App\Models\Post;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;

    class CommentController extends Controller
    {
        public function __construct()
        {
            $this->authorizeResource( Comment::class );
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store( StoreCommentRequest $request, Post $post )
        {
            $data = $request->validate( [
                "body" => [ "required", "string", "max:2500" ],
            ] );
            Comment::make( $data )
                ->user()->associate( $request->user() )
                ->post()->associate( $post )
                ->save();

            return redirect( $post->showRoute() )
                ->banner( 'Comment added.' );
        }

        /**
         * Update the specified resource in storage.
         */
        public function update( UpdateCommentRequest $request, Comment $comment )
        {
            $data = $request->validate( [ 'body' => [ 'required', 'string', 'max:2500' ] ] );

            $comment->update( $data );

            return redirect( $comment->post->showRoute( [ 'page' => $request->query( 'page' ) ] ) )
                ->banner( 'Comment updated.' );
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy( Request $request, Comment $comment ): RedirectResponse
        {
            $comment->delete();

            return redirect( $comment->post->showRoute( [ 'page' => $request->query( 'page' ) ] ) )
                ->banner( 'Comment deleted.' );
        }
    }
