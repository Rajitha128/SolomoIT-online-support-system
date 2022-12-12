@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="page-title">Online Support Platform</h1>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="panel panel-default">
                    <div class="panel panel-body">
                        <div class="form-group col-md-6 text-center" style="margin: 0 auto;">
                            <div class="panel panel-heading">
                                <h4 class="panel-title">Report Your Inquery Here</h4>
                            </div>
                            <form class="form" action="{{ route('ticket.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="problem">Problem</label>
                                    <textarea class="form-control" name="problem" id="problem" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                                        placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group col-md-6 text-center" style="margin: 0 auto;">
                    <form class="form-inline" action="{{ route('ticket.index') }}" method="GET">
                        <label for="search" class="search-label">Do you want to look into the previously reported problem?</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Preference No">
                        </div>
                        <button type="submit" class="btn btn-success mb-2">Search</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('css')
<style>
    .page-title{
        padding-top: 5vh;
        font-size: 3rem;
        color: dimgrey
    }
    .panel-title, .search-label{
        font-size: 1.5rem;
        color: dimgrey
    }
    .form-group{
        margin-bottom: 5px;
    }
</style>
@endpush
