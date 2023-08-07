<div class="p-6">
    <h1 class="text-3xl font-bold">영화를 검색하세요</h1>
    <div class="mt-6">
        <label for="openStartDt" class="block font-bold">조회시작 개봉년도:</label>
        <input type="number" id="openStartDt" wire:model="openStartDt" class="mt-1 p-2 border rounded">
    </div>
    <div class="mt-6">
        <label for="openEndDt" class="block font-bold">조회종료 개봉년도:</label>
        <input type="number" id="openEndDt" wire:model="openEndDt" class="mt-1 p-2 border rounded">
    </div>
    <div class="mt-6">
        <button wire:click="search" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            검색
        </button>
    </div>

    @if ($searched)
        <div class="mt-6 font-bold">조회시작 개봉년도: {{ $openStartDt }}</div>
        <div class="mb-6 font-bold">조회종료 개봉년도: {{ $openEndDt }}</div>

        @if ($movies->isEmpty())
            <div class="mt-10 font-bold">찾는 영화가 없습니다</div>
        @else
            <article class="my-10">
                @foreach ($movies as $movie)
                    <div wire:key="{{ $movie['movieCd'] }}" class="flex-row">
                        <span class="font-bold text-xl">{{ $movie['movieNm'] }}</span>
                        <span><{{ $movie['genreAlt'] }}></span>
                        <span>{{ $movie['directors'][0]['peopleNm'] ?? '감독 정보 없음' }} 감독</span>
                    </div>
                @endforeach
            </article>
            <div class="mt-10">{{ $movies->links() }}</div>
        @endif
    @endif
</div>
