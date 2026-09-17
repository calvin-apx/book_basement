<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\Book\BookRepository;
use App\BookGenre;
use App\Traits\BookInfoTrait;
class BookInformationController extends Controller
{

    use BookInfoTrait;

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * @author Calvin
     * @return View
     */
    public function index()
    {
        $genres = (new BookRepository(new BookGenre))->all();
        return view('bookbasement.products.add',compact('genres'));
    }




}
