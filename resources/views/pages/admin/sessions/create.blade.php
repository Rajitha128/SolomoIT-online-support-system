@extends('layout.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please sign in</h3>
                </div>
                <div class="panel panel-body">
                    <div class="form-group col-md-6 text-center" style="margin: 0 auto;">
                        <form class="form" action="{{ route('session.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
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
    .form-group{
        margin-bottom: 3vh;
    }
</style>
@endpush
