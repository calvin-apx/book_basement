<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Book\BookRepository;
use App\BookGenre;
use App\Traits\BookGenreTrait;

class BookGenreController extends Controller
{
    //
    use BookGenreTrait;

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
}
