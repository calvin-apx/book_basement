@extends('bookbasement.products.index')


@section('css')
<link  href="{{ asset('css/rating.css') }}" rel="stylesheet">
@endsection
@section('process')
    @if($message = Session::get('success'))
    <div class="alert alert-success" role="alert" style="margin-top:20px">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <span>{{ $message }}</span>
    </div>
    @endif

<form method="post" id="add_form" action="{{ route('products.add') }}" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Title.." value="{{ old('title') }}">
        @error('title')
            <small class="text-danger"><strong>*{{ $message }}</strong></small>
        @endError
      </div>
      <div class="form-group col-md-6">
        <label for="subTitle">Sub-Title</label>
        <input type="text" class="form-control" id="subTitle" name="subTitle" placeholder="Sub-Title.." value="{{ old('subTitle') }}">
        @error('subTitle')
            <small class="text-danger"><strong>*{{ $message }}</strong></small>
        @endError
      </div>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" id="description" name="description" placeholder="Book Drescription..." >{{ old('description') }}</textarea>
        @error('description')
            <small class="text-danger"><strong>*{{ $message }}</strong></small>
        @endError
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="genre" style="display:block">Genres</label>
            <select id="genre" name="genre" class="form-control" style="width: 90%;display:inline">
                <option selected value="">Please Choose Genre...</option>
                @if(!empty($genres))
                    @foreach($genres as $genre)
                        <option value="{{ $genre->genre_id }}"> {{$genre->name}}</option>
                    @endforeach
                @endif
            </select>
            <a class="d-flex align-items-center text-muted float-right" href="#" style="width: 10%;height: calc(1.5em + .75rem + 2px);">
                <span data-feather="plus-circle" style="margin-left: 20%;width: 30px;height: 30px" data-toggle="modal" data-target="#exampleModalCenter"></span>
            </a>
            @error('genre')
                <small class="text-danger"><strong>*{{ $message }}</strong></small>
            @endError
        </div>
        <div class="form-group col-md-6">
          <label for="pageCount">Page count</label>
          <input type="text" class="form-control" name="pageCount" id="pageCount" value="{{ old('pageCount') }}">
          @error('pageCount')
            <small class="text-danger"><strong>*{{ $message }}</strong></small>
          @endError
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="authors">Authors</label>
            <input type="text" class="form-control" id="authors" name="authors" placeholder="Authors..." value="{{ old('authors') }}">
            @error('authors')
                <small class="text-danger"><strong>*{{ $message }}</strong></small>
            @endError
        </div>
        <div class="form-group col-md-6">
            <label for="publishers">Publishers</label>
            <input type="text" class="form-control" id="publishers" name="publishers" placeholder="Publishers..." value="{{ old('publishers') }}">
            @error('publishers')
                <small class="text-danger"><strong>*{{ $message }}</strong></small>
            @endError
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="image">Choose Image</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image" value="{{ old('image') }}">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            @error('image')
             <small class="text-danger"><strong>*{{ $message }}</strong></small>
            @endError
        </div>
        <div class="form-group col-md-2">
            <label for="price">Price</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Price..." value="{{ old('price') }}">
            @error('price')
                <small class="text-danger"><strong>*{{ $message }}</strong></small>
            @endError
        </div>
        <div class="form-group col-md-2">
            <label for="qty">Qty</label>
            <input type="text" class="form-control" id="Qty" name="qty" placeholder="Qty..." value="{{ old('qty') }}">
            @error('qty')
                <small class="text-danger"><strong>*{{ $message }}</strong></small>
            @endError
        </div>
        <div class="form-group col-md-2">
            <fieldset class="rating">
                <legend>Rating:</legend>
                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
                <input type="radio" id="star1" name="rating" value="1" checked/><label for="star1" title="Sucks big time">1 star</label>
            </fieldset>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-dark float-right">Save</button>
    <button type="button"  onclick="resetFunction()" class="btn btn-secondary float-right mr-2">Clear</button>

</form>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Insert New Genre</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="post" id="genre_form" action="{{ route('products.addGenre') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Genre Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Genre Name" name="genre_name">
                </div>
                <div class="form-group">
                    <label for="image">Choose Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image-genre" name="image">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="add" class="btn btn-dark">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('custom-js')
<script>
    function resetFunction() {
        document.getElementById("add_form").reset();
    }

</script>
@endsection
