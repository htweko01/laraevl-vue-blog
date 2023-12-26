@extends('user.layouts.layout')

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 text-center">{{ $post->title }}</h1>
        <div class="w-2/3 my-3 mx-auto">
            <img src="{{ asset('storage/images/posts/' . $post->image) }}" alt="">
        </div>
        <main class="mt-3">
            {!! $post->body !!}
        </main>
    </div>
@endsection

@section('styles')
    <style>
        main>pre {
            color: white;
            background-color: #000;
            padding: 1rem;
            border-radius: 1rem;
        }

        main>p {
            margin-bottom: 5px;
        }
    </style>
@endsection
