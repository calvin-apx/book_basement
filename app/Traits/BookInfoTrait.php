<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\BookInformation;
use App\Images;
use App\AdminInventory;
use App\Http\Requests\BookInfoRequest;
use App\Repository\Book\BookRepository;
use App\Repository\Book\BookInterface;
use Illuminate\Support\Facades\Validator;
use App\BookGenre;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\queue;

trait BookInfoTrait {

    /**
     * @author Calvin
     * @param BookInfoRequest $request
     *
     * @return [type]
     */
    public function store(BookInfoRequest $request)
    {
        DB::beginTransaction();
        try {
            $bookInfo = (new BookRepository(new BookInformation));
            $image = (new BookRepository(new Images));
            $inventory = (new BookRepository(new AdminInventory));

            $images = array(
                'image_url' => $image->saveImage($request,'books'),
            );

            $image_id = $image->storeWidthId($images);

            $dataBookInfo = array(
                'title'         =>  $request->title,
                'sub_title'     =>  $request->subTitle,
                'description'   =>  $request->description,
                'genre_id'      =>  $request->genre,
                'image_id'      =>  $image_id,
                'page_count'    =>  $request->pageCount,
                'authors'       =>  $request->authors,
                'publisher'     =>  $request->publishers,
                'rating'        =>  $request->rating,
            );
            $book_id = $bookInfo->storeWidthId($dataBookInfo);

            $adminInventory = array(
                'book_id'                =>  $book_id,
                'book_price'             =>  $request->price,
                'book_qty'               =>  $request->qty,
                'book_sale_total_amount' =>  $request->price * $request->qty
            );

            $inventory->store($adminInventory);
            DB::commit();
            return back()->with('success','Successfully Added');

        }catch(\Exception $e) {
            DB::rollback();
        }
    }

    public function getBookInfo()
    {
        DB::beginTransaction();
        try {
            $genres = (new BookRepository(new BookGenre))->all();
            $bookInfo = (new BookRepository(new BookInformation));

            $books = $bookInfo->all(['adminInventory','images','genres'])->map(function($data){
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
                DB::commit();

            return view('bookbasement.products.list',compact('books','genres'));
        }
        catch(\Exception $e){
            DB::rollback();
        }

    }

    /**
     * @author Calvin
     * @param mixed $id
     *
     * @return Collection
     */
    public function find($id)
    {
        $bookInfo = new BookRepository(new BookInformation);
        return  $bookInfo->findById($id,['adminInventory','images','genres']);
    }


    /**
     * @author Calvin
     * @param BookInfoRequest $request
     *
     * @return [type]
     */
    public function update(BookInfoRequest $request)
    {
        DB::beginTransaction();
        try {
            $book = $this->find($request->id);
            $bookInfo = (new BookRepository(new BookInformation));
            $image = (new BookRepository(new Images));
            $inventory = (new BookRepository(new AdminInventory));

            if($request->hasFile('image')){
                $validate = Validator::make([$request->file('image')],[
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);
            }

            $images = array(
                'image_url' => $image->saveImage($request,'books'),
            );

            if($images['image_url']){
                $image->update($images,['image_id' => $book->images->image_id]);
            }

            $dataBookInfo = array(
                'title'         =>  $request->title,
                'sub_title'     =>  $request->subTitle,
                'description'   =>  $request->description,
                'genre_id'      =>  $request->genre,
                'page_count'    =>  $request->pageCount,
                'authors'       =>  $request->authors,
                'publisher'     =>  $request->publishers,
                'rating'        =>  $request->rating,
            );

            $bookInfo->update($dataBookInfo,['book_id' => $book->book_id]);

            $adminInventory = array(
                'book_price'             =>  $request->price,
                'book_qty'               =>  $request->qty,
                'book_sale_total_amount' =>  $request->price * $request->qty
            );

            $inventory->update($adminInventory,['book_id' => $book->adminInventory->book_id]);

            DB::commit();

            return back()->with('success','Successfully Updated');

        }catch(\Exception $e){
            DB::rollback();
        }
    }


    /**
     * @author Calvin
     * @param Request $request
     *
     * @return [type]
     */
    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {

            $book = $this->find($request->id);
            $bookInfo = (new BookRepository(new BookInformation));
            $image = (new BookRepository(new Images));
            $inventory = (new BookRepository(new AdminInventory));

            $bookInfo->delete(['book_id' => $book->book_id]);
            $image->delete(['image_id' => $book->images->image_id]);
            $inventory->delete(['book_id' => $book->adminInventory->book_id]);

            DB::commit();

            return back()->with('success','Successfully Deleted');

        }catch(\Exception $e){
            DB::rollback();
        }

    }


    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function findFiltered(Request $request)
    {
        Log::info($request);
        $titles     =  explode(",", $request->title);
        $publishers =  explode(",", $request->publisher);
        $genres     =  explode(",", $request->genre);
        $authors    =  explode(",", $request->author);
        $price      =  $request->price;


        $query = DB::table('book_information')->addSelect(DB::raw('
            book_information.book_id ,
            book_information.genre_id ,
            book_information.title ,
            book_information.sub_title ,
            book_genre.name as genre,
            book_information.description,
            admin_book_inventory.book_price as price,
            admin_book_inventory.book_qty as qty,
            admin_book_inventory.book_sale_total_amount as total,
            book_information.publisher,
            book_information.authors,
            book_information.page_count,
            images.image_url as image_url,
            book_information.rating,
            book_information.status'))->leftJoin('book_genre',function($join){
            $join->on('book_information.genre_id','=','book_genre.genre_id');
        })->leftJoin('images',function($join){
            $join->on('book_information.image_id','=','images.image_id');
        })->leftJoin('admin_book_inventory',function($join){
            $join->on('book_information.book_id','=','admin_book_inventory.book_id');
        });


        foreach($titles as $title){
            if($title != '' && $title != null){
                $title = trim(str_replace(' ','%',$title));
                $query->orWhere('title', 'LIKE' , "%$title%");

            }

        }
        foreach($publishers as $publisher){
            if($publisher != '' && $publisher != null){
                $publisher = trim(str_replace(' ','%',$publisher));
                $query->orWhere('publisher', 'LIKE' , "%$publisher%");
            }

         }
         foreach($genres as $genre){
            if($genre != '' && $genre != null){
                $genre = trim(str_replace(' ','%',$genre));
                $query->orWhere('book_genre.name', 'LIKE' , "%$genre%");
            }

         }
         foreach($authors as $author){
            if($author != '' && $author != null){
                $author = trim(str_replace(' ','%',$authors));
             $query->orWhere('authors', 'LIKE' , "%$author%");
            }
         }
         if($price != 0 && $price != null){
            $price = trim($price);
            $query->orWhereBetween('admin_book_inventory.book_price', [0, $price]);

         }
         $result = $query->get();

         return $result->toArray();

    }



}
