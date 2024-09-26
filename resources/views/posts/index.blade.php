<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">


                <form class="mx-auto mt-6 max-w-md" method="GET" action="{{ route('posts.index') }}">
                    <label class="sr-only mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="search">Search</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                            <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-4 ps-10 text-sm text-gray-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-indigo-500 dark:focus:ring-indigo-500"
                            id="search" type="search" name="search" placeholder="Search Posts..."
                            value="{{ request()->query('search') }}" required />
                        <button
                            class="absolute bottom-2.5 end-2.5 rounded-lg bg-indigo-700 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800"
                            type="submit">Search</button>
                    </div>
                </form>


                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mb-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
                        @forelse ($posts as $post)
                            <article
                                class="block w-full rounded-lg border border-gray-200 bg-white p-6 shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 lg:max-w-sm">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $post->title }}</h5>
                                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $post->body }}</p>
                            </article>
                        @empty
                            <article
                                class="block max-w-sm rounded-lg border border-gray-200 bg-white p-6 shadow hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Sorry,
                                    no
                                    posts to show at this moment.</h5>
                            </article>
                        @endforelse
                    </div>

                    {{ $posts->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
