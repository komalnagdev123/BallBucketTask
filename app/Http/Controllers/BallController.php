<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Ball;
use App\Models\Bucket;
use App\Models\TempSuggestion;
use Illuminate\Support\Facades\DB;
class BallController extends Controller
{
    public function index()
    {
        return view('add_balls');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ball_name' => 'required|min:2|unique:balls,ball_name',
            'volume' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $ball = new Ball();
            $ball->ball_name = $request->ball_name;
            $ball->volume = $request->volume;
            $ball->save();

            //copy old value volume data in buckets table
            $bucketTotalData = Bucket::get()->toArray();
            if(count($bucketTotalData) > 0){
                DB::statement('UPDATE buckets SET remaining_volume = volume');
            }
            return redirect()->route('welcome')
            ->with('success_message', 'Ball Added Successfully!');
        }
    }

    public function bucket_suggestion()
        {
            $balls = Ball::get();
            return view('bucket_suggestion', ['balls' => $balls]);
        }

    public function check_suggestion(Request $request)
    {
        $balls = $request->balls;
        $quantity = $request->quantity;
        $purchasedBalls = array_combine($balls,$quantity);
        $bucketCapacities = Bucket::get()->pluck('remaining_volume','bucket_name')->toArray();
        $ballSizes = Ball::get()->pluck('volume','ball_name')->toArray();
        
        //dd($purchasedBalls,$bucketCapacities,$ballSizes);

        // Example usage
        $bucketCapacities = $bucketCapacities;
        $ballSizes = $ballSizes;
        $purchasedBalls = $purchasedBalls;

        $result = $this->storeBallsInBuckets($bucketCapacities, $ballSizes, $purchasedBalls);
        $bucketTotalData = Bucket::get()->toArray();
        return view('bucket_suggestion_result', ['result' => $result, 'bucketTotalData' => $bucketTotalData, 'purchasedBalls' => $purchasedBalls,'ballSizes' => $ballSizes]);
    }

    //Main function to calculate result
    public function storeBallsInBuckets($bucketCapacities, $ballSizes, $purchasedBalls) {
        $buckets = array_fill_keys(array_keys($bucketCapacities), []); 
        
        // Initialize empty buckets
        $remainingBalls = []; // Initialize empty array for remaining balls
    
        foreach ($purchasedBalls as $color => $count) {
            $ballSize = $ballSizes[$color];
    
            while ($count > 0) {
                $bucketSelected = false;
    
                // Try to put the ball in each bucket
                foreach ($buckets as $bucket => &$balls) {
                    if ($bucketCapacities[$bucket] >= $ballSize) 
                    {
                        $bucketData = Bucket::select('id')->where('bucket_name',$bucket)->get();
                        //deduct capacity from bucket table
                        $bucketDeduct = Bucket::find($bucketData[0]->id);
                        $bucketDeduct->remaining_volume = $bucketDeduct->remaining_volume - $ballSize;
                        $bucketDeduct->save();

                        $bucketCapacities[$bucket] -= $ballSize;
                        $balls[] = $color;
                        $count--;
                        $bucketSelected = true;
                        break; // Move to the next ball after putting one in the bucket
                    }
                }
    
                if (!$bucketSelected) {
                    // If no bucket has space, add the remaining balls to the remainingBalls array
                    $remainingBalls[] = $color;
                    $count--;
                }
            }
        }
    
        return ['buckets' => $buckets, 'remainingBalls' => $remainingBalls];
    }
    
}
