<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Bucket;
use App\Models\Ball;
use Illuminate\Support\Facades\DB;
class BucketController extends Controller
{

    public function welcome()
    {
        $bucketTotalData = Bucket::get()->toArray();
        $ballTotalData = Ball::get()->toArray();
        return view('welcome', ['bucketTotalData' => $bucketTotalData, 'ballTotalData' => $ballTotalData,]);
    }

    public function index()
    {
        return view('add_buckets');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bucket_name' => 'required|min:2|unique:buckets,bucket_name',
            'volume' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $bucket = new Bucket();
            $bucket->bucket_name = $request->bucket_name;
            $bucket->volume = $request->volume;
            $bucket->remaining_volume = $request->volume;
            $bucket->save();

            //copy old value volume data in buckets table
            $bucketTotalData = Bucket::get()->toArray();
            if(count($bucketTotalData) > 0){
                DB::statement('UPDATE buckets SET remaining_volume = volume');
            }

            return redirect()->route('welcome')
            ->with('success_message', 'Bucket Added Successfully!');
        }
    }
}
