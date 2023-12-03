<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\TagRequest;
    use App\Models\Tag;

    class TagController extends Controller
    {
        public function index()
        {
            $this->authorize( 'viewAny', Tag::class );

            return Tag::all();
        }

        public function store( TagRequest $request )
        {
            $this->authorize( 'create', Tag::class );

            return Tag::create( $request->validated() );
        }

        public function show( Tag $tag )
        {
            $this->authorize( 'view', $tag );

            return $tag;
        }

        public function update( TagRequest $request, Tag $tag )
        {
            $this->authorize( 'update', $tag );

            $tag->update( $request->validated() );

            return $tag;
        }

        public function destroy( Tag $tag )
        {
            $this->authorize( 'delete', $tag );

            $tag->delete();

            return response()->json();
        }
    }
