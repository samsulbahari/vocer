<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVocerRequest;
use App\Models\Vocer;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
class VocerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vocer = Vocer::with('hadiahs')->paginate(10);
        return response()->json(['message'=> 'succes get data',
                                 'data' => $vocer
                                ]);
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
    public function store(StoreVocerRequest $request)
    {
        $validated = $request->validated();
      
        
        if($request->type == 0){
            //zonk , generate 100 vocer
            for($i = 1 ; $i<=100; $i++){
                $random_vocer = Str::random(7);
                $vocer = Vocer::where('code',$random_vocer)->first();
                if ($vocer){
                    $i--;
                }else{
                    //kalo belum ada
                    Vocer::insert([
                        'code'  => $random_vocer,
                        'type'  =>0,
                        'id_hadiah' => null,
                        'status' => 0 ,
                    ]);
                }
            } 
        }else{
            for ($k = 1; $k <= $request->jumlah ; $k ++){
                $random_vocer = Str::random(7);
                $vocer = Vocer::where('code',$random_vocer)->first();
                if ($vocer){
                    $k--;
                }else{
                    
                    //kalo belum ada
                    Vocer::insert([
                        'code'  => $random_vocer,
                        'type'  =>1,
                        'id_hadiah' => $request->id_hadiah,
                        'status' => 0 ,
                    ]);
                }
            }
            //ada hadiah
        }
        return response()->json([
            'message'   => 'success insert'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vocer  $vocer
     * @return \Illuminate\Http\Response
     */
    public function show(Vocer $vocer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vocer  $vocer
     * @return \Illuminate\Http\Response
     */
    public function edit(Vocer $vocer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vocer  $vocer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vocer $vocer)
    {
        Vocer::where('id',$vocer->id)->update([
            'player_name' => $request->player_name
        ]);
        return response()->json([
            'message' => 'success update',
            
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vocer  $vocer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vocer $vocer)
    {
        Vocer::where('id',$vocer->id)->delete();
        return response()->json([
            'message' => 'success delete',
            
        ],200);
    }
}
