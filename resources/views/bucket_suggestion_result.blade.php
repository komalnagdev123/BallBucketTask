@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="addBtn">
            <a href="{{ route('bucket_suggestion') }}" class="add-new">
                Add Balls in Bucket
            </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <a href="{{ route('welcome') }}" class="add-new">
                Home
            </a>
        </div>
        <div class="col-md-6">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ball</th>
                    <th scope="col">Volume</th>
                    <th scope="col">Quantity Added</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach ($purchasedBalls as $color=>$qty)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>
                            {{ $color }}
                        </td>
                        <td>
                           {{ $ballSizes[$color] }}
                        </td>
                        <td>
                            {{ $qty }}
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
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
                        <td colspan="3">
                            <center>No Buckets Available. First add Buckets Quantity to add balls in bucket.
                                <a href="{{ route('add_bucket') }}" class="add-new">
                                    Add New Bucket
                                </a>
                            </center>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        @php
            foreach ($result['buckets'] as $bucket => $balls) {
            $ballCount = count($balls);
            $distinctBallCount = array_count_values($balls);
           // $ballList = implode(', ', $balls);
            if($ballCount > 0)
            echo "<span style='color:rgb(14, 159, 16);font-weight:bold;'><u>$bucket :-> </u></span> contains total:- $ballCount ball(s) of color(s).<br />";
            if(isset($distinctBallCount) && count($distinctBallCount) > 0)
            {
                foreach($distinctBallCount as $ball=>$qty)
                {
                    echo "<b>$ball => $qty</b>";
                }
            }
        }
        echo "<br />";
        if (!empty($result['remainingBalls'])) {
            $remainingBallCount = count($result['remainingBalls']);
            //$remainingBallList = implode(', ', $result['remainingBalls']);
            $distincRemainingtBallCount = array_count_values($result['remainingBalls']);
            
            echo "<span style='color:rgb(255, 0, 0);'>Remaining Total Ball(s) => $remainingBallCount cannot be accommodated in any bucket since there is no available space in any bucket.</span>";
            foreach($distincRemainingtBallCount as $ball=>$qty)
            {
                echo $ball ."=>". $qty;
                echo "<br />";
            }
          //  echo "$remainingBallCount ball(s) of color(s) $remainingBallList cannot be accommodated in any bucket since there is no available space.<br />";
        }
        @endphp
    </div>
</div>
@endsection