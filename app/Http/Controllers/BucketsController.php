<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bucket;
use App\Measurement;

class BucketsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $buckets = Bucket::all();

      $data = array(
        'buckets' => $buckets
      );

      return view('buckets.index')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $bucket = Bucket::findOrFail($id);
      $measurements = Measurement::where('bucket_id', $bucket->id)->latest('updated_at')->get();

      $data = array(
        'bucket' => $bucket,
        'measurements' => $measurements
      );

      return view('buckets.show')->with($data);
    }


}