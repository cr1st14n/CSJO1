<?php

namespace App\Http\Controllers;

use App\recHuman;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;

use App\especialidad;

class RecHumanController extends Controller
{
    public function index()
    {
        return view('viewRRHH.homeRH');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $casa=Array();
        array_push($casa,"{'nombre':'juan'}");
        return especialidad::get();
        return $casa;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\recHuman  $recHuman
     * @return \Illuminate\Http\Response
     */
    public function show(recHuman $recHuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\recHuman  $recHuman
     * @return \Illuminate\Http\Response
     */
    public function edit(recHuman $recHuman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\recHuman  $recHuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, recHuman $recHuman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\recHuman  $recHuman
     * @return \Illuminate\Http\Response
     */
    public function destroy(recHuman $recHuman)
    {
        //
    }
}
