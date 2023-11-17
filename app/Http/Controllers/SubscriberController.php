<?php

namespace App\Http\Controllers;

use App\Events\Subscribed;
use App\Models\Subscriber;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


class SubscriberController extends Controller
{
    public function show(){
        $subscribers = Subscriber::all();
        return view('subscribers.index', compact('subscribers'));
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(),
        [
            'name' => 'required',
            'email' => 'required|email'
        ],
        [
            'name.required' => 'Полето за име е празно',
            'email.required' => 'Полето за емаил е празно',
            'email.email' => 'неважечка емаил адреса'
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $subscriber = Subscriber::where('email', $request->input('email'))->first()->toArray();
        if (!empty($subscriber)){
            return response()->json(['error' => 'Веке постои корисник со внесената емаил адреса'], 409);
        }

        $newSubscriber = new Subscriber();
        $newSubscriber->name = $request->input('name');
        $newSubscriber->email = $request->input('email');
        if($newSubscriber->save()){
            event(new Subscribed($newSubscriber));
            return response()->json('saved', 200);
        } else {
            return response()->json('error', 500);
        }
    }

    public function delete(Request $request){
        $subscriber = Subscriber::find($request->id);
        $subscriber->delete();
        return back()->with('status', 'Успешно го избришавте претплатениот корисник');
    }
}
