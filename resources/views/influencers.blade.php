@extends('layouts.app')

@section('title', 'Social Wall')

@section('content')

    <div class="social-page-container">

        <div class="social-header">
            <h2>Community & Friends</h2>
            <p>Mira lo último de nuestra gente</p>
        </div>

        <div class="instagram-grid">
            @foreach($posts as $post)
                <div class="instagram-card">
                    <iframe
                        src="https://www.instagram.com/p/{{ $post['code'] }}/embed"
                        width="400"
                        height="550"
                        frameborder="0"
                        scrolling="no"
                        allowtransparency="true">
                    </iframe>
                </div>
            @endforeach
        </div>

    </div>

@endsection
