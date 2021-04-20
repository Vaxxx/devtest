<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use Illuminate\Http\Request;

class GigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show all gigs
        $gigs = Gig::all();
        return $gigs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //save a gig
        $gig = new Gig;
        $gig->role = $request->role;
        $gig->company = $request->company;
        $gig->country = $request->country;
        $gig->state = $request->state;
        $gig->address = $request->address;
        $gig->salarymin = $request->salarymin;
        $gig->salarymax = $request->salarymax;
        $gig->tagid = $request->tagid;
        if($gig->save()){
            return response()->json([
                'status' => true,
                'message' => 'A New Gig Has Been  Added Successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'You encountered some errors'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function show(Gig $gig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function edit(Gig $gig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gig $gig)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gig = Gig::find($id);
        if($gig->delete()){
            return response()->json([
                'status' => true,
                'message' => 'Gig deleted successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Error in  deleting Gig'
            ]);
        }
    }
}
