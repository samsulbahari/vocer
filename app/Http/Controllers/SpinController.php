<?php

namespace App\Http\Controllers;

use App\Models\Vocer;
use Illuminate\Http\Request;

class SpinController extends Controller
{
    public function spin(Request $request){
        $validatedData = $request->validate([
            'vocer' => ['required'],
        ]);

        $check_vocer = Vocer::with('hadiahs')->where('code',$request->vocer)->first();

        if($check_vocer)
        {
            if($check_vocer->status == 1){
                if($check_vocer->id_hadiah != null){
                    return response()->json([
                        'message' => 'vocer telah digunakan dan telah claim hadiah'
                    ]);
                }else{
                    return response()->json([
                        'message' => 'vocer telah digunakan'
                    ]);
                }
            }else{
                
                if($check_vocer->id_hadiah == null){
                    Vocer::where('code',$request->vocer)->update([
                        'status' => 1
                    ]);
                    return response()->json([
                        'message' => 'vocer ZONK !!'
                    ]);
                }else{
                     Vocer::where('code',$request->vocer)->update([
                        'status' => 1
                    ]);
                    return response()->json([
                        'message' => 'Selamat anda mendapatkan '.$check_vocer->hadiahs->nama
                    ]);
                }
            }
        }else{
            return response()->json([
                'message' => 'vocer invalid'
            ]);
        }

    
     

    }
}
