@extends('layouts.app')

@section('title', __('Hello'))

@section('content')
    <div class="row">
        {{ $response_habr ?? '' }}

        <div>
            <a href="?order={{$order}}">По дате</a>
        </div>

        <ul>
            @foreach($posts as $post)
                <li>
                    <h3> {{ $post->title }}</h3>
                    <div class="post_links">
                        <a href="{{ $post->url }}"> {{ $post->url }}</a>
                        @foreach($post->tags as $tag)
                            <a href="#" class="disabled"> {{ $tag->name }}</a>
                        @endforeach
                    </div>
                </li>
                <hr>
            @endforeach
        </ul>
    </div>
@endsection

