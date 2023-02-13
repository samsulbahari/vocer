<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHadiahRequest;
use App\Models\Hadiah;
use Illuminate\Http\Request;

class HadiahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hadiah = Hadiah::get();
        return response()->json([
            'message'   => 'success get data',
            'data'  =>$hadiah
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreHadiahRequest $request)
    {
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHadiahRequest $request)
    {
        $validated = $request->validated();
        $path = $request->file('image')->store('public/images');
        $explode = explode('/',$path);
        Hadiah::insert(['nama' => $request->nama,
                        'image' => asset('storage/images/'.$explode[2])
                      ]);
        return response()->json([
            'message'   => 'success insert',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hadiah  $hadiah
     * @return \Illuminate\Http\Response
     */
    public function show(Hadiah $hadiah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hadiah  $hadiah
     * @return \Illuminate\Http\Response
     */
    public function edit(Hadiah $hadiah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hadiah  $hadiah
     * @return \Illuminate\Http\Response
     */
    public function update(StoreHadiahRequest $request, Hadiah $hadiah)
    {
    
        $validated = $request->validated();
        Hadiah::where('id',$hadiah->id)->update($validated);
        return response()->json([
            'message' => 'success update',
            
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hadiah  $hadiah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hadiah $hadiah)
    {
        Hadiah::where('id',$hadiah->id)->delete();
        return response()->json([
            'message' => 'success delete',
            
        ],200);
        
    }
}
