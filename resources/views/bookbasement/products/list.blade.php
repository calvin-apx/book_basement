@extends('bookbasement.products.index')

@section('css')
<link  href="{{ asset('css/rating.css') }}" rel="stylesheet">
<link  href="{{ asset('css/datatable_costum.css') }}" rel="stylesheet">
@endsection
@section('process')
    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert" style="margin-top:20px">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <span>{{ $message }}</span>
        </div>
    @endif
    <div class="table-responsive">
        <table id="books-table" class="table text-center" style="width:100%">
            <thead class="">
                <tr>
                    <th width="5%">ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @if(!empty($books))
             @php
            // dd($books);
            @endphp
                @foreach ($books as $book)
                <tr>
                    <th scope="row">
                        {{ $book['book_id'] }}
                    </th>
                    <td>
                        <img src='{{asset("/storage/images/books/{$book['image_url']}") }}'  style='height:50px;width:35px;display:block;margin:0 auto;'>
                    </td>
                    <td>
                        {{ $book['title'] }}
                    </td>
                    <td>
                        {{ $book['genre'] }}
                    </td>
                    <td>
                        {{ $book['price'] }}
                    </td>
                    <td>
                        {{ $book['qty'] }}
                    </td>
                    <td>
                        {{ $book['total'] }}
                    </td>
                    <td>
                        {{ $book['status'] }}
                    </td>
                    <td>
                        <button class="btn btn-info update_btn" id="{{ $book['book_id'] }}"    onclick="updateFunction(this.id)"> <span data-feather="edit"></span></button>
                        <button class="btn btn-secondary view_btn" id="{{ $book['book_id'] }}" onclick="viewFunction(this.id)"> <span data-feather="eye"></span></button>
                        <button class="btn btn-danger delete_btn" id="{{ $book['book_id'] }}"  onclick="deleteFunction(this.id)"><span data-feather="trash-2"></span></button>
                    </td>
                </tr>
                @endforeach
            @endIf
            </tbody>

        </table>
    </div>
    @include('bookbasement.modals.products.modal')
@endsection

@section('custom-js')
<script>
    const route = {
            find:    "{{ route('products.find',':id') }}",
            image_src: '{{asset("/storage/images/books/:image") }}'
    }

</script>
<script type="text/javascript" charset="utf8" src="{{ asset('js/products.js')}}"></script>
@endsection
