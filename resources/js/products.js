function updateFunction(id){
    let routeFind = route.find.replace(":id", id);
    $.ajax({
        url: routeFind,
        type: "GET",
        success: function(data){
            $('#title').val(data.title);
            $('#update_id').val(data.book_id);
            $('#sub_title').val(data.sub_title);
            $('#description').val(data.description);
            $('#genre').val(data.genre_id);
            $('#page_count').val(data.page_count);
            $('#authors').val(data.authors);
            $('#publishers').val(data.publisher);
            $('#image').attr("src", data.images.image_url);
            $('#price').val(data.admin_inventory.book_price);
            $('#qty').val(data.admin_inventory.book_qty);
            $(`#star${data.rating}`).prop('checked',true);
            $('#updateModal').modal('show');
        }
    });
}

function deleteFunction(id){
    let routeFind = route.find.replace(":id", id);
    $.ajax({
        url: routeFind,
        type: "GET",
        success: function(data){
            $('#delete_id').val(data.book_id);
            $('#delete_book_title').text(`[ ${data.title}] `);
            $('#deleteModal').modal('show');
        }
    });
}

function viewFunction(id){
    let routeFind = route.find.replace(":id", id);
    $.ajax({
        url: routeFind,
        type: "GET",
        success: function(data){
            image_src = route.image_src.replace(":image", data.images.image_url);
            $('#view_book_image').attr("src",image_src);
            $('#view_book_title').text(data.title);
            $('#view_book_description').text(data.description);
            $('#view_book_genre').text(data.genres.name);
            $('#view_book_author').text(data.authors);
            $('#view_book_publisher').text(data.publisher);
            $('#view_book_price').text(data.admin_inventory.book_price);
            $('#view_book_pages').text(data.page_count);
            $(`#view_star${data.rating}`).prop('checked',true);
            $('#viewModal').modal('show');
        }
    });
}
$(document).ready(function(){
setTimeout(() => {
    $('.alert').hide();
}, 3000);

$('#books-table').DataTable();

});
