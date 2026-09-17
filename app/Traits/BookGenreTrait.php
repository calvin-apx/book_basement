<?php

namespace App\Traits;

use App\Http\Requests\BookGenreRequest ;
use App\Repository\Book\BookRepository;
use App\BookGenre;
use Exception;
use Illuminate\Support\Facades\DB;

trait BookGenreTrait {

    /**
     * @author Calvin
     * @param BookGenreRequest $request
     *
     * @return json
     */
    public function store(BookGenreRequest  $request)
    {
        DB::beginTransaction();
        try {
            $genre = (new BookRepository(new BookGenre));

            $data = array(
                'image_url' => $genre->saveImage($request,'genres'),
                'name' => $request->genre_name
            );

            $genre->store($data);

            DB::commit();

            return back()->with('success','Successfully Added');

        }catch(\Exception $ex){
            DB::rollBack();
        }

    }

    /**
     * @author Calvin
     * @return json
     */
    public function getGenres()
    {
        DB::beginTransaction();
        try {

            $genres = (new BookRepository(new BookGenre))->all()->map(function($data){
                return array(
                    'genre_id'   => $data->genre_id,
                    'name'       => $data->name,
                    'image_url'  => $data->image_url,
                );
            });

            DB::commit();

            return json_encode($genres->toArray());

        }catch(\Exception $ex){
            DB::rollBack();
        }
    }




}
