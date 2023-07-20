@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success_message'))
            <div class="alert alert-success" role="alert">
                {{ session('success_message') }}
            </div>
        @endif
    <form action="{{ route('store_ball') }}" name="bucket" method="post">
        @csrf
        <div class="form-group">
        <label for="bucketName">Ball Color</label>
        <input type="text" class="form-control" id="bucket_name" name="ball_name" placeholder="Ball Color Ex:- Red">
        </div>
        <div class="form-group">
        <label for="volume">Volume</label>
        <input type="text" class="form-control" id="volume" name="volume" placeholder="Volume">
        </div><br />
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection