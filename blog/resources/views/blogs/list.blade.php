<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <div class="flex justify-center">
                                <div class="w-full max-w-md">
        
                                    <form method="GET" class="mt-0" action="dashboard">
                                        @csrf
        
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="flex w-full px-3">
                                                <label for="sort by date" class="block text-gray-700 dark:text-gray-400 text-sm font-bold mb-2">
                                                    {{ __('sort by date') }}
                                                </label>
        
                                                <select class="form-select block w-full mt-1" id="sort" name="sort">
                                                    <option value="ASC" @if ($published_date == 'ASC') selected @endif>{{ __('Asc') }}</option>
                                                    <option value="DESC" @if ($published_date == 'DESC') selected @endif>{{ __('Desc') }}</option>
                                                </select>
                                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                                    {{ __('Sort') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @if(count($posts))
                            @foreach ($posts as $post)
                                <div class="p-5 bg-blue-100">
                                    <div class="bg-white p-6 rounded-lg shadow-lg">
                                        <h2 class="text-2xl font-bold mb-2 text-gray-800">{{$post->title}}</h2>
                                        <p class="text-gray-700 text-xs">Author: {{$post->user->name}} - Published: {{$post->published_date}}</p>
                                        <p class="text-gray-700">{{$post->description}}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-20 bg-blue-100">
                                <div class="bg-white p-6 rounded-lg shadow-lg">
                                    <h2 class="text-2xl font-bold mb-2 text-gray-800">No posts found</h2>
                                </div>
                            </div>
                        @endif
                    </div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>