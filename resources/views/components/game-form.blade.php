@props(['action','method', 'game'])

<form action="{{$action}}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
    @method($method)
    @endif

    <div class="mb-4">
        <label for="title" class="block text-sm text-gray-700">Title</label>
        <input
        type="text"
        name="title"
        id="title"
        value="{{ old('title', $game->title ??'')}}"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"/>
        @error('title')
        <p class="text-sm text-red-600">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="description" class="block text-sm text-gray-700">Description</label>
        <input
        type="text"
        name="description"
        id="description"
        value="{{ old('description', $game->description ??'')}}"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"/>
        @error('description')
        <p class="text-sm text-red-600">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="release_date" class="block text-sm text-gray-700">Release Date</label>
        <input
        type="date"
        name="release_date"
        id="release_date"
        value="{{ old('release_date', $game->release_date ??'')}}"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"/>
        @error('release_date')
        <p class="text-sm text-red-600">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="age_restriction" class="block text-sm text-gray-700">age restriction</label>
        <input
        type="integer"
        name="age_restriction"
        id="age_restriction"
        value="{{ old('age_restriction', $game->age_restriction ??'')}}"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"/>
        @error('age_restriction')
        <p class="text-sm text-red-600">{{$message}}</p>
        @enderror
    </div>


    <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-gray-700">Game Cover Image</label>
        <input
        type="file"
        name="image"
        id="image"
        {{isset($game)?'':'required'}}
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('image')
        <p class="text-sm text-red-600">{{$message}}</p>
        @enderror
    </div>

    @isset($game->image)
    <div class="mb-4">
        <img src="{{asset($game->image) }}" alt="Game cover" class="w-24 h-32 object-cover">
    </div>
    @endisset

    <div>
        <x-primary-button >
            {{isset($game)?'Update Game':'add Game'}}
        </x-primary-button>
    </div>

    <x-nav-link :href="route('games.index')" :active="request()->routeIs('games.index')" class="text-red-500 hover:text-red-700">
        {{ __('Cancel')}}
    </x-nav-link>
</form>