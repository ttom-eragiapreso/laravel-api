<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function create(Request $request){

        $data = $request->all();

        // Valido la request
        $data_validation = Validator::make($data,[
            'name' => 'required|min:2|max:255',
            'email' => 'required|email',
            'message' => 'required|min:10|max:255'
        ]);



        if($data_validation->fails()){
            $errors = $data_validation->errors();
            return response()->json(compact('errors'));
        }

        $new_lead = Lead::create($data);

        return response()->json('Email sent successfully');

    }
}
