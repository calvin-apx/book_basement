<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\BookInformation;
use App\Images;
use Illuminate\Support\Facades\Storage;
use App\AdminInventory;
use App\BookRecommendation;
use App\Http\Requests\BookInfoRequest;
use App\Repository\Book\BookRepository;
use App\Repository\Book\BookInterface;
use Illuminate\Support\Collection;
use Yajra\Datatables\Datatables;

use function GuzzleHttp\json_encode;

trait BookRecommendationTrait {

    /**
     *
     * Get book genre
     * @author Calvin
     * @param genre_id
     * @return array
     */
    public function getBookByGenre($genre_id)
    {
        $bookInfo = (new BookRepository(new BookInformation));
        $data = $bookInfo->getByGenreId(['adminInventory','images','genres'],$genre_id)->map(function($data){
                return array(
                    'book_id' => $data->book_id,
                    'genre_id' =>$data->genres->genre_id,
                    'title'   => $data->title,
                    'sub_title'  => $data->sub_title,
                    'genre'   => $data->genres->name,
                    'description'  => $data->description,
                    'price'   => $data->adminInventory->book_price,
                    'qty'   => $data->adminInventory->book_qty,
                    'total'   => $data->adminInventory->book_sale_total_amount,
                    'publisher'   => $data->publisher,
                    'authors'  => $data->authors,
                    'page_count' => $data->page_count,
                    'image_url'   => $data->images->image_url,
                    'rating' => $data->rating,
                    'status'   => $data->status,
                );
            });
         return $data->toArray();
    }

    /**
     * this is for fetching top book recomendations when the user is not selecting any books or genres
     * @author Calvin
     * @param none
     * @return mixed
     */
    public function getTopBookRecommendation()
    {
        $recommendation = (new BookRepository(new BookRecommendation()));
        $data = $recommendation->getWithOrderBy('counts','desc')->map(function($data){
            return array(
                'genre_id_1' => $data->genre_id_1,
                'genre_id_2' => $data->genre_id_2,
            );
        });

        $data = $this->getUniqueRecommended($data);
        $finalData = [];
        foreach($data as $key => $values)
        {
            $data = $this->getBookByGenre($values);
            $finalData = array_merge($finalData,$data);
        }
        return json_encode($finalData);
    }

     /**
      *
     * this is for fetching depends on the genre that user selected
     * @author Calvin
     * @param none
     *
     * @return mixed
     */
    public function getByGenreRecommendation($id)
    {

        // $request->input('genre_id')
        $recommendation = (new BookRepository(new BookRecommendation()));
        $data = $recommendation->getGenreRecommended('counts','desc',$id)->map(function($data){
            return array(
                'genre_id_1' => $data->genre_id_1,
                'genre_id_2' => $data->genre_id_2,
            );
        });
        // return $data = $data->toArray();

        $data = $this->getUniqueRecommended($data);
        $finalData = [];
        foreach($data as $key => $values)
        {
            $data = $this->getBookByGenre($values);
            $finalData = array_merge($finalData,$data);
        }

        return json_encode($finalData);

    }



    /**
     * @author Calvin
     * @param mixed $data
     *
     * @return Array
     */
    public function getUniqueRecommended($data){
        $dataTemp = array();
        foreach($data as $key => $values)
        {
            foreach($values as $key => $val)
            array_push($dataTemp,$val);
        }
        return array_unique($dataTemp);
    }


    public function getBook(){
        $bookInfo = (new BookRepository(new BookInformation));
        $data = $bookInfo->all(['adminInventory','images','genres'])->map(function($data){
                return array(
                    'book_id' => $data->book_id,
                    'genre_id' =>$data->genres->genre_id,
                    'title'   => $data->title,
                    'sub_title'  => $data->sub_title,
                    'genre'   => $data->genres->name,
                    'description'  => $data->description,
                    'price'   => $data->adminInventory->book_price,
                    'qty'   => $data->adminInventory->book_qty,
                    'total'   => $data->adminInventory->book_sale_total_amount,
                    'publisher'   => $data->publisher,
                    'authors'  => $data->authors,
                    'page_count' => $data->page_count,
                    'image_url'   => $data->images->image_url,
                    'rating' => $data->rating,
                    'status'   => $data->status,
                );
            });
         return $data->toArray();
    }




}
