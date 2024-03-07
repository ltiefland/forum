<?php


    use App\Http\Resources\CommentResource;
    use App\Http\Resources\PostResource;
    use App\Models\Comment;
    use App\Models\Post;
    use function Pest\Laravel\get;

    it( 'can show a post', function ()
    {
        $post = Post::factory()->create();
        get( $post->showRoute() )
            ->assertComponent( 'Posts/Show' );
    } );
    it( 'passes a post to the view', function ()
    {
        $post = Post::factory()->create();

        $post->load( 'user' );

        get( $post->showRoute() )
            ->assertHasResource( 'post', PostResource::make( $post ) );
    } );
    it( 'passes comments to the view', function ()
    {
        $post = Post::factory()->create();
        $comments = Comment::factory( 2 )->for( $post )->create();

        $comments->load( 'user' );

        get( $post->showRoute() )
            ->assertHasPaginatedResource( 'comments', CommentResource::collection( $comments->reverse() ) );

    } );

    it( 'can generate a route to the show page', function ()
    {
        $post = Post::factory()->create();
        expect( $post->showRoute() )->toBe( route( 'posts.show', [ $post, Str::slug( $post->title ) ] ) );
    } );
    it( 'can generate additional query parameters on the show route', function ()
    {
        $post = Post::factory()->create();
        expect( $post->showRoute( [ 'page' => 2, ] ) )->toBe( route( 'posts.show', [ $post, Str::slug( $post->title ), "page" => 2, ] ) );
    } );

    it( 'will redirect if the slug is incorrect', function ()
    {
        $post = Post::factory()->create( [ "title" => "Hello world" ] );

        get( route( 'posts.show', [ $post, "foo-bar", "page" => 2, ] ) )
            ->assertRedirect( $post->showRoute( [ "page" => 2, ] ) );
    } );

    it( 'generates the html', function ()
    {
        $post = Post::factory()->make( [ "body" => "## Hello world" ] );
        $post->save();
        expect( $post->html )->toEqual( Str( $post->body )->markdown() );
    } );
