<?php

namespace App\Livewire;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class Movies extends Component
{
    use WithPagination;

    public $openStartDt = '';
    public $openEndDt = '';
    public $searched = false;

    public function render()
    {
        $movies = [];

        $moviesData = $this->fetchMovies();
        $movies = $this->paginateMovies($moviesData);

        return view('livewire.movies', [
            'movies' => $movies,
        ]);
    }

    public function search()
    {
        $this->resetPage();
        $this->searched = true;
    }

    private function fetchMovies()
    {
        $apiKey = env('API_KEY');
        $repNationCd = '22041011';
        $itemPerPage = 50;

        $response = Http::get("http://kobis.or.kr/kobisopenapi/webservice/rest/movie/searchMovieList.json", [
            'key' => $apiKey,
            'openStartDt' => $this->openStartDt,
            'openEndDt' => $this->openEndDt,
            'repNationCd' => $repNationCd,
            'itemPerPage' => $itemPerPage,
        ]);

        return $response->json()['movieListResult']['movieList'];

    }

    private function paginateMovies($moviesData)
    {
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($moviesData, ($currentPage - 1) * $perPage, $perPage);
        return new LengthAwarePaginator($currentItems, count($moviesData), $perPage, $currentPage);

    }
}
