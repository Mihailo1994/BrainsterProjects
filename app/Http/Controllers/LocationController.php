<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Country;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Accommodation;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CountryRequest;
use App\Http\Requests\LocationRequest;
use Illuminate\Contracts\Database\Eloquent\Builder;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function index(){
        $countries = Country::orderBy('name')->get();
        $locations = DB::table('locations')->join('countries', 'countries.id', '=', 'locations.country_id')->select('locations.id as id', 'countries.name as name', 'locations.region as region')->orderBy('countries.name')->get();
        return view('location.index', compact('countries', 'locations'));
    }


    public function storeCountry(CountryRequest $request){
        $request->validated();
        $country = new Country();
        $country->name = $request->name;
        if($country->save()){
            return back()->with('status', 'Државата е успешно додадена');
        } else {
            return back()->withErrors('Грешка при запишување, обидете се повторно');
        }
    }

    public function deleteCountry(Request $request){
        $country = Country::find($request->id);
        $accommodation = Accommodation::whereRelation('location', 'country_id', '=', $country->id)->get();
        if ($accommodation->first()){
            return back()->withErrors('Државата која сакате да ја избришете е поврзана со сместување');
        } else {
            if($country->delete()){
                return back()->with('status', 'Успешно ја избришавте државата');
            } else {
                return back()->withErrors('Проблем при бришење, обидете се повторно');
            }
        }

    }

    public function updateCountry(Request $request){
        $country = Country::where('name', $request->name)->get();
        if($country->first()){
            return back()->withErrors('Држава со тоа име веке постои');
        } else {
            $updatedCountry = Country::find($request->id);
            $updatedCountry->name = $request->name;
            if($updatedCountry->save()){
                return back()->with('status', 'Успешно ја изменивте државата');
            } else {
                return back()->withErrors('Проблем при едитирање, пробајте повторно');
            }
        }
    }


    public function storeLocation(LocationRequest $request){
        $request->validated();
        $location = Location::where('country_id', $request->country_id)->where('region', $request->region);
        if($location->first()){
            return back()->withErrors('Таков регион веке постои во таа држава');
        } else {
            $newLocation = new Location();
            $newLocation->country_id = $request->country_id;
            $newLocation->region = $request->region;
            if ($newLocation->save()){
                return back()->with('status', 'Успешно додадовте дестинација');
            } else {
                return back()->withErrors('Проблем при додавање, пробајте повторно');
            }
        }
        }

    public function deleteLocation(Request $request){
        $location = Accommodation::where('location_id' , $request->id);
        if($location->first()){
            return back()->withErrors('Дестинацијата не може да се избрише бидејќи е поврзана со постоечко сместување!');
        } else {
            $locationDelete = Location::find($request->id);
            $locationDelete->delete();
            return redirect()->route('location.index')->with('status', 'Дестинацијата е успешно избришана');
        }
    }

    public function editLocation($id){
        $location = Location::find($id);
        $countries = Country::all();
        return view('location.edit', compact('location', 'countries'));

    }

    public function updateLocation(LocationRequest $request, $id){
        $request->validated();
        $location = Location::where('country_id', $request->country_id)->where('region', $request->region);
        if($location->first()){
            return back()->withErrors('Таков регион веќе постои во таа држава');
        } else {
            $updatedLocation = Location::find($id);
            $updatedLocation->country_id = $request->country_id;
            $updatedLocation->region = $request->region;
            if ($updatedLocation->save()){
                return redirect()->route('location.index')->with('status', 'Успешно ја едитиравте дестинацијата');
            } else {
                return back()->withErrors('Проблем при едитирање, пробајте повторно');
            }
        }
        }
    }

