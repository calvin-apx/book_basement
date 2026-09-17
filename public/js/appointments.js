function doneFunction(id){
    let routeFind = route.find.replace(":id", id);
    $.ajax({
        url: routeFind,
        type: "GET",
        success: function(data){
            console.log(data);
            $('#done_id').val(data.appointment_id);
            $('#done_name_purpose').text(`[ ${data.user.name} : ${data.purpose} ] `);
            $('#doneModal').modal('show');
        }
    });
}


function cancelFunction(id){
    let routeFind = route.find.replace(":id", id);
    $.ajax({
        url: routeFind,
        type: "GET",
        success: function(data){
            console.log(data);
            $('#cancel_id').val(data.appointment_id);
            $('#cancel_name_purpose').text(`[ ${data.user.name} : ${data.purpose} ] `);
            $('#cancelModal').modal('show');
        }
    });
}


$(document).ready(function(){
    setTimeout(() => {
        $('.alert').hide();
    }, 3000);

    $('#appointments-table').DataTable();

});
