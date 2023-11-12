<?php

namespace App\Http\Controllers;

use App\Models\complaint;
use App\Http\Requests\Complaint\StorecomplaintRequest;
use App\Http\Requests\Complaint\UpdatecomplaintRequest;

class ComplaintController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index ()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create ()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (StorecomplaintRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show (complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit (complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update (UpdatecomplaintRequest $request, complaint $complaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy (complaint $complaint)
    {
        //
    }

}
