<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVocerRequest;
use App\Models\Vocer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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
    public function index(Request $request)
    {
        if(Auth::user()->role == 1){
            $vocer = Vocer::with('hadiahs')->paginate(10);
        }else{
            
        $filter = $_GET['show_playername'];
    
          if($filter == "true"){
            
            $vocer = Vocer::with('hadiahs')
                                          ->whereNotNull('player_name')
                                          ->orderBy('updated_at','desc')
                                          ->paginate(10);
                                        
            // foreach($vocer_with_playername as $player_name){
            //     $data = [
            //         'id' =>$player_name->id,
            //         "code" => $player_name->code,
            //         "type" => $player_name->type,
            //         "id_hadiah" => $player_name->id_hadiah,
            //         "status" => $player_name->status,
            //         "player_name" => $player_name->player_name,
            //         "hadiahs" => $player_name->hadiahs
            //     ];
            //     array_push($vocer,$data);
            // }
          }else{
                
            $vocer = Vocer::with('hadiahs')->inRandomOrder()
                                        ->whereNull('player_name')
                                        ->paginate(10);
            // foreach($vocer_without_playername as $player_names){
            //     $data = [
            //     'id' =>$player_names->id,
            //     "code" => $player_names->code,
            //     "type" => $player_names->type,
            //     "id_hadiah" => $player_names->id_hadiah,
            //     "status" => $player_names->status,
            //     "player_name" => $player_names->player_names,
            //     "hadiahs" => $player_names->hadiahs
            //     ];
            //     array_push($vocer,$data);
            //     }
          }
          

            
          
           
        
           

            
        }
       
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
