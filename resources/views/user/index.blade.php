@extends('user.layouts.layout')

@section('content')
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Blogs</h1>
        </div>
        <div class="flex flex-wrap justify-center items-center flex-col md:flex-row  bg-gray-200 py-6">

            @foreach ($categories as $category)
                <span
                    class="inline-block rounded-md px-5 py-2 text-black text-xl hover:bg-gray-400 cursor-pointer">{{ $category->name }}</span>
            @endforeach
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <!-- Your content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 justify-items-center">
                @foreach ($posts as $post)
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow w-full ">
                        <a href="{{ route('post.show', $post->slug) }}">
                            <img class="rounded-t-lg hover:scale-105"
                                src="{{ asset('storage/images/posts/' . $post->image) }}" alt="{{ $post->image }}" />
                        </a>
                        <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">
                                {{ $post->title }}</h5>

                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! $post->shortBody() !!}</p>
                            <a href="{{ route('post.show', $post->slug) }}"
                                class="inline-flex items-center mt-3 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </main>
@endsection
