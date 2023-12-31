<?php

    use App\Http\Resources\PostResource;
    use App\Models\Post;
    use function Pest\Laravel\get;

    it( 'should return the correct component', function ()
    {
        get( route( 'posts.index' ) )
            ->assertComponent( "Posts/Index" );
    } );

    it( 'passes post to the view', function ()
    {

        $posts = Post::factory( 3 )->create();

        get( route( 'posts.index' ) )
            ->assertHasPaginatedResource( 'posts', PostResource::collection( $posts->reverse() ) );
    } );
