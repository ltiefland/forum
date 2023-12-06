<?php

    use function Pest\Laravel\get;

    it( 'should return the correct component', function ()
    {
        get( route( 'posts.index' ) )
            ->assertInertia( fn( \Inertia\Testing\AssertableInertia $inertia ) => $inertia
                ->component( "Posts/Index", true )
            );
    } );

    it('passes post to the view',function()
    {
        get( route( 'posts.index' ) )
            ->assertInertia( fn( \Inertia\Testing\AssertableInertia $inertia ) => $inertia
                ->has('posts')
            );
    });
