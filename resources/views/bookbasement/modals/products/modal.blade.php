    <!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Update Book Information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="post" action="{{ route('products.update') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" id="update_id" name="id">
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="for_title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="title" name="title">
                    </div>
                    <div class="form-group col-6">
                        <label for="for_subtitle">Sub-Title</label>
                        <input type="text" class="form-control" id="sub_title" placeholder="Sub-Title" name="subTitle">
                    </div>
                </div>
                <div class="form-group">
                    <label for="for_description">Description</label>
                    <textarea class="form-control" id="description" placeholder="Description" name="description">
                    </textarea>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="genre" style="display:block">Genres</label>
                        <select id="genre" name="genre" class="form-control">
                            <option selected value="">Please Choose Genre...</option>
                            @if(!empty($genres))
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->genre_id }}"> {{$genre->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="for_page_count">Page Count</label>
                        <input type="text" class="form-control" placeholder="Enter Page Count" name="pageCount" id="page_count">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="for_author">Authors</label>
                        <input type="text" class="form-control" placeholder="Enter Authors" name="authors" id="authors">
                    </div>
                    <div class="form-group col-6">
                        <label for="for_publisher">Publishers</label>
                        <input type="text" class="form-control" placeholder="Enter Publishers" name="publishers" id="publishers">
                    </div>
                </div>
                <div class="form-group">
                    <label for="for_image">Choose Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="for_price">Price</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="form-group col-6">
                        <label for="for_qty">Qty</label>
                        <input type="text" class="form-control" id="qty" name="qty">
                    </div>
                </div>
                <div class="form-group" style="display:block">
                    <fieldset class="rating">
                        <legend>Rating:</legend>
                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
                        <input type="radio" id="star1" name="rating" value="1" checked/><label for="star1" title="Sucks big time">1 star</label>
                    </fieldset>
                </div>
                <br>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="update" class="btn btn-dark">Save</button>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger  text-white">
          <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="post" action="{{ route('products.delete') }}">
        {!! csrf_field() !!}
            <input type="hidden" id="delete_id" name="id">
            <div class="modal-body text-center" style="padding:40px">
                <strong> Are you sure you want to delete this product ? </strong><h6 id="delete_book_title"></h6>
            </div>
            <div class="modal-footer" style="display:block;">
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger float-left mb-2">Delete</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card border border-secondary rounded" style="width:100%">
                <img  id="view_book_image" class="rounded mx-auto mt-2" alt="..." style='height:250px;width:170px'>
                <div class="card-body" style="padding-left:40px;padding-right:40px">
                    <h5 class="card-title text-center" id="view_book_title"></h5>
                    <p class="card-text text-center" id="view_book_description"></p>
                </div>
                <ul class="list-group list-group-flush" style="padding-left:40px;padding-right:40px">
                    <li class="list-group-item"><strong class="text-secondary">Genre:</strong> <span id="view_book_genre"></span></li>
                    <li class="list-group-item"><strong class="text-secondary">Authors:</strong> <span id="view_book_author"></span> </li>
                    <li class="list-group-item"><strong class="text-secondary">Publishers:</strong> <span id="view_book_publisher"></span></li>
                    <li class="list-group-item"><strong class="text-secondary">Price:</strong>  &#8369;<span id="view_book_price"></span></li>
                    <li class="list-group-item"><strong class="text-secondary">Pages:</strong>  <span id="view_book_pages"></span></li>
                    <li class="list-group-item">
                        <strong class="float-left text-secondary" style="padding-top:5px">Rating:</strong>
                        <fieldset class="rating">
                            <input type="radio" id="view_star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
                            <input type="radio" id="view_star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
                            <input type="radio" id="view_star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
                            <input type="radio" id="view_star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
                            <input type="radio" id="view_star1" name="rating" value="1" checked/><label for="star1" title="Sucks big time">1 star</label>
                        </fieldset>
                    </li>
                </ul>
                <div class="card-body">
                    <button type="button" class="btn btn-secondary float-right md-2" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
  </div>

