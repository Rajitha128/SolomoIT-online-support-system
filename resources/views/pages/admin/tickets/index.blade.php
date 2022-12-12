@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="page-title">Tickets</h1>
            </div>
            <div class="col-md-10 mt-5 text-center" style="margin: 0 auto;">
                <form action="{{ route('admin.ticket.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <input class="form-control" name="search" placeholder="Customer Name">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-lg-12 mt-5">
                <div>
                    @if ($tickets)
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
                                @foreach ($tickets as $key => $ticket)
                                    <tr>
                                        <th scope="row">{{ $ticket->id }}</th>
                                        <td>{{ $ticket->reference_no }}</td>
                                        <td>{{ $ticket->name }}</td>
                                        <td>
                                            @if ($ticket->status == 0)
                                                <span class="badge bg-warning"> Pending </span>
                                            @elseif($ticket->status == 1)
                                                <span class="badge bg info"> Processing </span>
                                            @else
                                                <span class="badge bg success"> Completed </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.ticket.show', $ticket->id) }}"
                                                class="btn btn-success">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <span>No records available</span>
                    @endif
                    {!! $tickets->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .page-title {
            padding-top: 5vh;
            font-size: 3rem;
            color: dimgrey
        }
    </style>
@endpush
