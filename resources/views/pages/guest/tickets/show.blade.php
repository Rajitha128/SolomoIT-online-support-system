@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="panel panel-default">
                    <div class="panel panel-heading">
                        <h4 class="panel-title">Ticket</h4>
                    </div>
                    <div class="panel panel-body">
                        <div class="form-group col-md-6 text-center" style="margin: 0 auto;">
                            <ul class="list-group">
                                <li class="list-group-item">Reference: {{ $ticket->reference_no }}</li>
                                <li class="list-group-item">Name: {{ $ticket->name }}</li>
                                <li class="list-group-item">Email: {{ $ticket->email }}</li>
                                <li class="list-group-item">Problem: {{ $ticket->problem }}</li>
                                <li class="list-group-item">Status:
                                    @if ($ticket->status==0)
                                       <span class="badge bg-warning"> Pending </span>
                                   @elseif($ticket->status==1)
                                       <span class="badge bg info"> Processing </span>
                                   @else
                                       <span class="badge bg success"> Completed </span>
                                   @endif
                               </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="list-group">
                    @foreach($replies as $reply)
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $reply->reply }}</h5>
                            <small class="text-muted">{{ $reply->created_at }}</small>
                            </div>
                            <p class="mb-1">{{ $reply->created_at }}</p>
                        </a>
                    @endforeach
                    {!! $replies->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .panel-title {
            margin-top: 3vh;
            font-size: 2rem;
            color: dimgrey
        }
        .list-group{
            margin-bottom: 3vh;
        }
    </style>
@endpush
