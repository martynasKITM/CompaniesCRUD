<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $cred = $request->only(['email', 'password']); //gauna teisingus prisijungimo duomenis
        $token = auth()->attempt($cred);
        if(!$token = auth()->attempt($cred)) { //jei duomenys neteisingi, login tokeno neduoda
            return response()->json(['error' => 'Duomenys neteisingi']);
        }else{
            $userId = auth()->user()->id;
            return response()->json(['token' => $token, 'userID' => $userId]);
        }


    }
}
