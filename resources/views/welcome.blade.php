@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="addBtn">
            <a href="{{ route('bucket_suggestion') }}" class="add-new">
                Add Balls in Bucket
            </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{ route('add_ball') }}" class="add-new">
                Add New Ball
            </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{ route('add_bucket') }}" class="add-new">
                Add New Bucket
            </a>
        </div>
        @if (session('success_message'))
            <div class="alert alert-success" role="alert">
                {{ session('success_message') }}
            </div>
        @endif
        <div class="col-md-6">
            <center><b>Available Balls</b></center>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ball</th>
                    <th scope="col">Volume</th>
                  </tr>
                </thead>
                <tbody>
                    @if (count($ballTotalData) > 0)
                        @foreach ($ballTotalData as $key=>$value)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>
                                {{ $value['ball_name'] }}
                            </td>
                            <td>
                                {{ $value['volume'] }}
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="3"><center>No balls Available.</center></td>
                            </tr>
                        @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <center><b>Available Buckets</b></center>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Bucket</th>
                    <th scope="col">Total Volume</th>
                    <th scope="col">Remaining Volume</th>
                  </tr>
                </thead>
                <tbody>
                    @if (count($bucketTotalData) > 0)
                        @foreach ($bucketTotalData as $key=>$value)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>
                                {{ $value['bucket_name'] }}
                            </td>
                            <td>
                                {{ $value['volume'] }}
                            </td>
                            <td>
                                {{ $value['remaining_volume'] }}
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4"><center>No buckets Available.</center></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection