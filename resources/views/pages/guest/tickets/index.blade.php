@extends('layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
          <h1 class="page-title">Tickets</h1>
        </div>
        <div class="col-lg-12 mt-5">
            <div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Reference No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">{{  $ticket->id }}</th>
                            <td>{{ $ticket->reference_no }}</td>
                            <td>{{ $ticket->name }}</td>
                            <td>
                                @if ($ticket->status==0)
                                    <span class="badge bg-warning"> Pending </span>
                                @elseif($ticket->status==1)
                                    <span class="badge bg info"> Processing </span>
                                @else
                                    <span class="badge bg success"> Completed </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('ticket.show', $ticket->id) }}" class="btn btn-success">View</a>
                            </td>
                        </tr>
                    </tbody>
                  </table>
            </div>
        </div>


    </div>
</div>
@endsection
@push('css')
 <style>
    .page-title{
        padding-top: 5vh;
        font-size: 5rem;
        color: dimgrey
    }
 </style>



@endpush
