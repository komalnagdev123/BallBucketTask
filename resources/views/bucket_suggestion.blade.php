@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('welcome') }}" class="add-new">
        Home
    </a>
    <center><b>Add zero in text box if don't want to add any number of ball</b></center>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Ball</th>
            <th scope="col">Quantity</th>
          </tr>
        </thead>
        <tbody>
            <form name="bucket_suggestion" action="{{ route('check_suggestion') }}" method="post">
                @csrf
                @if (count($balls) > 0)
                @foreach ($balls as $key=>$value)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>
                        <input type="hidden" name="balls[]" value="{{ $value->ball_name }}" readonly />
                        {{ $value->ball_name }}
                    </td>
                    <td>
                        <input type="number" name="quantity[]" value="" required id="{{ $key }}" minlength="0" />
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary">Add Balls in Bucket</button>
                    </td>
                </tr>
                @else
                    <tr>
                        <td colspan="2">
                            <center>No balls Available. First add Balls Quantity.
                                <a href="{{ route('add_ball') }}" class="add-new">
                                    Add New Ball
                                </a>
                            </center>
                        </td>
                    </tr>
                @endif
            </form>
        </tbody>
      </table>
</div>
@endsection