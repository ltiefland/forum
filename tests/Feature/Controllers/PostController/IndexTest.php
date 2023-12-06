<?php

    it( 'should return the correct component', function ()
    {
        get( route( 'posts.index' ) )
            ->assertInertia( fn( \Inertia\Testing\AssertableInertia $inertia ) => $inertia
                ->component( "Posts/Index", true )
            );
    } );
