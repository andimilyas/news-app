@extends('front.master')
@section('content')

    <body class="font-[Poppins] pb-[83px]">
        <x-navbar />

        <nav id="Category" class="max-w-[1130px] mx-auto flex justify-center items-center gap-4 mt-[30px]">

            @foreach ($categories as $category)
                <a href="{{ route('front.category', $category->slug) }}"
                    class="rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18]">
                    <div class="w-6 h-6 flex shrink-0">
                        <img src="{{ Storage::url($category->icon) }}" alt="icon" />
                    </div>
                    <span>{{ $category->name }}</span>
                </a>
            @endforeach
        </nav>

        <section id="author" class="max-w-[1130px] mx-auto flex items-center flex-col gap-[30px] mt-[70px]">
            <div id="title" class="w-full justify-between flex items-center gap-[30px]">
                <h1 class="text-4xl leading-[45px] font-bold">Author News</h1>
                <div class="flex gap-5 items-center">
                    <div class="w-[60px] h-[60px] flex shrink-0 rounded-full overflow-hidden">
                        <img src="{{ Storage::url($author->avatar) }}" alt="profile photo" />
                    </div>
                    <div class="flex flex-col">
                        <p class="text-lg leading-[27px] font-semibold">{{ $author->name }}</p>
                        <span class="text-[#A3A6AE]">{{ $author->occupation }}</span>
                    </div>
                    <a href="{{ route('front.index', '#Best-authors') }}"
                        class="rounded-full p-[12px_22px] flex gap-[10px] font-semibold transition-all duration-300 border border-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18]">
                        <div class="w-6 h-6 flex shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M10 4a4 4 0 1 0 0 8a4 4 0 0 0 0-8M4 8a6 6 0 1 1 12 0A6 6 0 0 1 4 8m12.828-4.243a1 1 0 0 1 1.415 0a6 6 0 0 1 0 8.486a1 1 0 1 1-1.415-1.415a4 4 0 0 0 0-5.656a1 1 0 0 1 0-1.415m.702 13a1 1 0 0 1 1.212-.727c1.328.332 2.169 1.18 2.652 2.148c.468.935.606 1.98.606 2.822a1 1 0 1 1-2 0c0-.657-.112-1.363-.394-1.928c-.267-.533-.677-.934-1.349-1.102a1 1 0 0 1-.727-1.212zM6.5 18C5.24 18 4 19.213 4 21a1 1 0 1 1-2 0c0-2.632 1.893-5 4.5-5h7c2.607 0 4.5 2.368 4.5 5a1 1 0 1 1-2 0c0-1.787-1.24-3-2.5-3z" />
                            </svg>
                        </div>
                        <span>View All</span>
                    </a>
                </div>
            </div>
            <div id="content-cards" class="grid grid-cols-3 gap-[30px]">

                @forelse ($author->news as $item_news)
                    <!-- card -->
                    <a href="{{ route('front.detail', $item_news->slug) }}" class="card">
                        <div
                            class="flex flex-col gap-4 p-[26px_20px] transition-all duration-300 ring-1 ring-[#EEF0F7] hover:ring-2 hover:ring-[#FF6B18] rounded-[20px] overflow-hidden bg-white">
                            <div class="thumbnail-container h-[200px] relative rounded-[20px] overflow-hidden">
                                <div
                                    class="badge absolute left-5 top-5 bottom-auto right-auto flex p-[8px_18px] bg-white rounded-[50px]">
                                    <p class="text-xs leading-[18px] font-bold">{{ $item_news->category->name }}</p>
                                </div>
                                <img src="{{ Storage::url($item_news->thumbnail) }}" alt="thumbnail photo"
                                    class="w-full h-full object-cover" />
                            </div>
                            <div class="flex flex-col gap-[6px]">
                                <h3 class="text-lg leading-[27px] font-bold">
                                    {{ substr($item_news->name, 0, 60) }}{{ strlen($item_news->name) > 60 ? '...' : '' }}
                                </h3>
                                <p class="text-sm leading-[21px] text-[#A3A6AE]">
                                    {{ $item_news->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </a>
                    <!-- card -->
                @empty
                    <p>No data found</p>
                @endforelse
            </div>
        </section>

        <section id="Advertisement" class="max-w-[1130px] mx-auto flex justify-center mt-[70px]">
            <div class="flex flex-col gap-3 shrink-0 w-fit">
                <a href="{{ $bannerAds->link }}">
                    <div class="w-[900px] h-[120px] flex shrink-0 border border-[#EEF0F7] rounded-2xl overflow-hidden">
                        <img src="{{ Storage::url($bannerAds->thumbnail) }}" class="object-cover w-full h-full"
                            alt="ads" />
                    </div>
                </a>
                <p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex gap-1">
                    Our Advertisement <a href="#" class="w-[18px] h-[18px]"><img
                            src="{{ asset('assets/images/icons/message-question.svg') }}" alt="icon" /></a>
                </p>
            </div>
        </section>

        <x-footer />
    </body>
@endsection
