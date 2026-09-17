

<!-- Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger  text-white">
          <h5 class="modal-title" id="exampleModalLabel">Cancel Appointment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="post" action="{{ route('appointments.cancel') }}">
        {!! csrf_field() !!}
            <input type="hidden" id="cancel_id" name="id">
            <div class="modal-body text-center" style="padding:40px">
                <strong> Are you sure you want to cancel this appoinment ? </strong><h4 id="cancel_name_purpose"></h4>
            </div>
            <div class="modal-footer" style="display:block;">
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger float-left mb-2">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Modal -->
<div class="modal fade" id="doneModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success  text-white">
          <h5 class="modal-title" id="exampleModalLabel">Done Appointment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="post" action="{{ route('appointments.done') }}">
        {!! csrf_field() !!}
            <input type="hidden" id="done_id" name="id">
            <div class="modal-body text-center" style="padding:40px">
                <strong> Appointment done on </strong><h4 id="done_name_purpose"></h4>
            </div>
            <div class="modal-footer" style="display:block;">
                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success float-left mb-2">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>



