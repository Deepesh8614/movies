@extends('layouts.main')

@section('content')

    <div class="show-info border-b border-gray-800" >
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none" x-data="{isImageModalVisible: false, image:''}">
                <img src="{{ $show['poster_path'] }}" alt="{{ $show['name'] }}" class="md:w-96"/>
            </div>
            <div class="mt-2 md:ml-24">
                <h2 class="text-4xl font-semibold">{{ $show['name'] }}</h2>

                <div class="flex flex-wrap items-center text-gray-400 text-sm">
                    <img src="/images/star.svg" alt="star" class="w-3">
                    <span class="ml-1">{{ $show['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $show['first_air_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $show['genres'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $show['number_of_seasons'] . " Seasons" }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $show['number_of_episodes'] . " Episodes" }}</span>
                </div>

                <p class="text-gray-300 mt-8 text-sm">{{ $show['overview'] }}</p>

                <div class="mt-12 ">
                    <h4 class="text-white font-semibold">Created By</h4>
                    <div class="flex mt-4">
                        @foreach($show['created_by'] as $creator)
                            <div class="mr-8">
                                <div>
                                    <a href="{{ route('people.show', $creator['id']) }}" class="hover:opacity-75 transition ease-in-out">
                                        <img
                                            src="{{ $creator['profile_path'] }}"
                                            alt="{{ $creator['name'] }}"
                                            class="w-24"
                                        />
                                    </a>
                                </div>
                                <div class="mt-1">
                                    <a href="{{ route('people.show', $creator['id']) }}" class="hover:opacity-75 transition ease-in-out">
                                        {{ $creator['name'] }}
                                    </a>
                                </div>
                                <div class="text-xs md:text-sm text-gray-400">Creator</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if(count($show['videos']['results']) > 0)
                    <div
                        class="mt-8 md:mt-12"
                        x-data="{ isTrailerModalVisible: false }"
                    >
                        <button
                            @click="isTrailerModalVisible= true"
                            class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4
                                    hover:bg-orange-600 transition ease-in-out duration-150"
                        >
                            <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2
                                        12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path></svg>
                            <span class="ml-2">Play Trailer</span>
                        </button>

                        <template x-if.transition.opacity="isTrailerModalVisible">
                            <div
                                style="background-color: rgba(0,0,0,.5);"
                                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                            >
                                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto z-auto">
                                    <div class="bg-gray-900 rounded">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button
                                                class="text-3xl leading-none hover:text-gray-300"
                                                @click="isTrailerModalVisible=false"
                                                @keydown.escape.window="isTrailerModalVisible=false"
                                            >
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body px-8 py-8" @click.away="isTrailerModalVisible = false">
                                            <div
                                                class="responsive-container overflow-hidden relative"
                                                style="padding-top: 56.25%;"
                                            >
                                                <iframe width="560" height="315" style="border: 0;"
                                                        class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                        src="https://youtube.com/embed/{{ $show['videos']['results'][0]['key'] }}"
                                                        allow="autoplay; encrypted-media"
                                                        allowfullscreen
                                                ></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                @endif

            </div>
        </div> <!-- End show Info -->

        <div class="show-cast border-gray-800 border-b">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Cast</h2>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach($show['cast'] as $cast)
                        <div class="mt-8">
                            <a href="{{ route('people.show',$cast['id']) }}">
                                <img
                                    src="{{ "https://image.tmdb.org/t/p/w500" . $cast['profile_path'] }}"
                                    alt="{{ $cast['name'] }}"
                                    class="hover:opacity-75 transition ease-in-out duration-150" />
                            </a>
                            <div class="mt-2">
                                <a href="{{ route('people.show',$cast['id']) }}" class="text-lg mt-2 hover:text-gray-300">{{ $cast['name'] }}</a>
                                <div class="text-gray-400 text-sm">{{ $cast['character'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div> <!-- End shows Cast -->

        <div class="show-images border-gray-800 border-b" x-data="{isImageModalVisible: false, image:''}">
            <div class="container mx-auto px-4 py-16">
                <h2 class="text-4xl font-semibold">Images</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach($show['image'] as $image)
                        <div class="mt-8">
                            <a @click.prevent="isImageModalVisible=true,
                            image='{{ "https://image.tmdb.org/t/p/original" . $image['file_path'] }}'">
                                <img
                                    src="{{ "https://image.tmdb.org/t/p/w780" . $image['file_path'] }}"
                                    alt="{{ $cast['name'] }}"
                                    class="hover:opacity-75 transition ease-in-out duration-150" />
                            </a>
                        </div>
                    @endforeach
                </div>

                <template x-if="isImageModalVisible">
                    <div
                        style="background-color: rgba(0,0,0,.5);"
                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    >
                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto z-auto">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pr-4 pt-2">
                                    <button
                                        class="text-3xl leading-none hover:text-gray-300"
                                        @click="isImageModalVisible=false"
                                        @keydown.escape.window="isImageModalVisible=false"
                                    >
                                        &times;
                                    </button>
                                </div>
                                <div class="modal-body px-8 py-8" @click.away="isImageModalVisible = false">
                                    <img :src="image" alt="screenshot" class="transition ease-in-out duration-150">
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

            </div>
        </div> <!-- End shows Images -->

@endsection
