@extends('bookbasement.appointments.index')

@section('css')
<link  href="{{ asset('css/rating.css') }}" rel="stylesheet">
<link  href="{{ asset('css/datatable_custom.css') }}" rel="stylesheet">
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
        <table id="appointments-table" class="table text-center" style="width:100%">
            <thead class="">
                <tr>
                    <th width="5%">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date And Time</th>
                    <th>Location</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @if(!empty($appointments))
                @php
                    $count = 1;
                @endphp
                @foreach ($appointments as $appointment)
                <tr>
                    <th scope="row">
                        {{ $count++ }}
                    </th>
                    <td>
                        {{ $appointment->user->name }}
                    </td>
                    <td>
                        {{ $appointment->user->email }}
                    </td>
                    <td>
                        {{ $appointment->meetup_datetime }}
                    </td>
                    <td>
                        {{ $appointment->location }}
                    </td>
                    <td>
                    @if ($appointment->purpose == 'donate')
                        <h6 class="p-2 text-secondary text-center border border-primary" style="width:100px;margin-left:10%">{{ $appointment->purpose }}  <span data-feather="gift"></span></h6>
                    @elseif($appointment->purpose == 'sell')
                        <h6 class="p-2 text-secondary text-center border border-success" style="width:100px;margin-left:10%">{{ $appointment->purpose }}  <span data-feather="dollar-sign"></span></h6>
                    @else
                        <h6 class="p-2 text-secondary text-center border border-info" style="width:100px;margin-left:10%">{{ $appointment->purpose }}  <span data-feather="shopping-cart"></span></h6>
                    @endif

                    </td>
                    <td>

                    @if ($appointment->status == 'pending')
                        <h6 class="badge p-2 badge-secondary" style="width:80px">{{ $appointment->status }}</h6>
                    @elseif($appointment->status == 'done')
                        <h6 class="badge p-2 badge-success" style="width:80px">{{ $appointment->status }}</h6>
                    @else
                        <h6 class="badge p-2 badge-danger" style="width:80px">{{ $appointment->status }}</h6>
                    @endif
                    </td>
                    <td>
                        <button class="btn btn-info"   id="{{ $appointment->appointment_id }}" onclick="doneFunction(this.id)"     {{($appointment->status != 'pending') ? 'disabled' : '' }}> Done <span data-feather="check-circle"></span></button>
                        <button class="btn btn-danger" id="{{ $appointment->appointment_id }}" onclick="cancelFunction(this.id)"  {{($appointment->status != 'pending') ? 'disabled' : '' }}>Cancel <span data-feather="x-square"></span></button>
                    </td>
                </tr>
                @endforeach
            @endIf
            </tbody>

        </table>
    </div>
    @include('bookbasement.modals.appointments.modal')
@endsection

@section('custom-js')
<script>
    const route = {
            find:  "{{ route('appointments.find',':id') }}",
        }
</script>
<script type="text/javascript" charset="utf8" src="{{ asset('js/appointments.js')}}"></script>
@endsection
