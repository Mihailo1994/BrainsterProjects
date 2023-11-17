<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    public function index(){
        $testimonials = Testimonial::all();
        return view('testimonial.index', compact('testimonials'));
    }

    public function add(){
        return view('testimonial.add');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),
        [
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'arrangement' => 'required',
            'rating' => 'required'
        ],
        [
            'required.title' => 'Полето за наслов е задолжително',
            'required.image' => 'Полето за слика е задолжително',
            'required.description' => 'Полето за опис е задолжително',
            'required.rating' => 'Полето за рејтинг е задолжително',
            'required.arrangement' => 'Полето за аранжман е задолжително',
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator);
        }

        $testimonial = new Testimonial();
        $testimonial->title = $request->title;
        $path = $request->file('image')->store('images/testimonials');
        $testimonial->image = $path;
        $testimonial->description = $request->description;
        $testimonial->rating = $request->rating;
        $testimonial->arrangement = $request->arrangement;
        if($testimonial->save()) {
            return redirect()->route('testimonial.index')->with('status', 'Успешно внесовте тестимониал');
        } else {
            return back()->withErrors('Грешка при зачувување');
        }
    }

    public function delete($id){
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        return back()->with('status', 'Успешно го избришавте тестимониалот');
    }
}
