<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Termin;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\Accommodation;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TerminRequest;
use App\Http\Requests\UpdateTerminRequest;
use Symfony\Component\HttpFoundation\AcceptHeader;

class TerminController extends Controller
{
    public function add($id){
        $accommodation = Accommodation::find($id);
        return view('termin.add', compact('accommodation'));
    }

    public function generate(TerminRequest $request, $id){
        $validated = $request->validated();
        $accommodation = Accommodation::find($id);
        $today = Carbon::now()->format('Y-m-d');
        if($request->termins_from <= $today){
            return back()->withErrors('Терминот може да почне најкасно од утре');
        };

        $terminsFrom = Carbon::create($request->termins_from);
        $terminsNumber = $request->termins_number;
        $numberOfNights = $request->number_of_nights;
        $termins = [];
        for($i = 1; $i<=$terminsNumber; $i++){
            $date_from = $terminsFrom->format('Y-m-d');
            $date_until = $terminsFrom->addDays($numberOfNights)->format('Y-m-d');
            $termin = ['date_from' =>  $date_from, 'date_until' => $date_until];
            $terminsFrom->addDays('number_of_nights');
            $termins[] = $termin;
        }

        return view('termin.termins', compact('termins', 'accommodation'));
    }

    public function store(Request $request, $id){
        $n = count($request->date_from);
        $termins = Termin::where('accommodation_id', $id)->get();
        if($termins->first()){
            foreach($termins as $termin){
                for($i = 0; $i < $n; $i++) {
                    if(($termin->date_from < $request->date_from[$i] && $termin->date_until > $request->date_from[$i]) || ($termin->date_from < $request->date_until[$i] && $termin->date_until > $request->date_until[$i])){
                        return back()->withErrors('Веке постои термин за избраното сместување во избраниот период');
                    }
                }
            }
        }

        for($i = 0; $i < $n; $i++){
            $newTermin = new Termin();
            $newTermin->accommodation_id = $id;
            $newTermin->date_from = $request->date_from[$i];
            $newTermin->date_until = $request->date_until[$i];
            $newTermin->price_per_night = $request->price_per_night[$i];
            if($request->note != null){
                $newTermin->note = $request->note;
            }
            $newTermin->save();
        }

        return redirect()->route('accommodation.show', $id)->with('status', 'Успешно додадовте термини');
    }

    public function reserve($id){
        $termin = Termin::find($id);
        if($termin->is_reserved === 0){
            $termin->is_reserved = true;
            if($termin->save()){
                return back()->with('status', 'Терминот е резервиран');
            } else {
                return back()->withErr('Терминот не можеше да се резервира, пробајте повторно');
            }
        } elseif ($termin->is_reserved === 1){
            $termin->is_reserved = false;
            if($termin->save()){
                return back()->with('status', 'Терминот е откажан');
            } else {
                return back()->withErr('Терминот не можеше да се откаже, пробајте повторно');
            }
        }
    }

    public function delete($id){
        $termin = Termin::find($id);
        if($termin->delete()){
            return back()->with('status', 'Успешно го избришавте терминот');
        } else {
            return back()->withErrors('Терминот неможеше да се избрише, обидете се повторно');
        }
    }

    // public function edit($id){
    //     $termin = Termin::find($id);
    //     $accommodationId = $termin->accommodation_id;
    //     $accommodation = Accommodation::find($accommodationId);

    //     return view('termin.edit', compact('termin', 'accommodation'));
    // }

    public function update(UpdateTerminRequest $request, $id){
        $validated = $request->validated();
        $editTermin = Termin::find($id);
        $accommodationId = $editTermin->accommodation_id;
        $termins = Termin::where('accommodation_id', $accommodationId)->get();
        if ($termins->first()) {
            foreach($termins as $termin){
                if(($termin->date_from < $request->date_from && $termin->date_until > $request->date_from) || ($termin->date_from < $request->date_until && $termin->date_until > $request->date_until)){
                    return back()->withErrors('Веке постои термин за избраното сместување во избраниот период');
                }
            }
        }

        if($request->date_from > $request->date_until){
            return back()->withErrors('Почетната дата за терминот е после крајната дата');
        }

        $editTermin->date_from = $request->date_from;
        $editTermin->date_until = $request->date_until;
        $editTermin->price_per_night = $request->price_per_night;
        $editTermin->note = $request->note;
        $editTermin->save();
        return redirect()->route('accommodation.show', $accommodationId)->with('status', 'Успешно извршивте промена на терминот');
    }

    public function editNote(Request $request){
        $termin = Termin::find($request->input('terminId'));
        $termin->note = $request->input('newNote');
        $termin->save();
        return response()->json('saved', 200);
    }













    // public function store(TerminRequest $request){
    //     $request->validated();
    //     if($request->accommodation === null) {
    //         return back()->withErrors('Изберете сместување');
    //     }

    //     $today = Carbon::now()->format('Y-m-d');
    //     if($request->termin_from <= $today){
    //         return back()->withErrors('Терминот може да почне најкасно од утре');
    //     };

    //     if ($request->termin_from > $request->termin_until){
    //         return back()->withErrors('Грешка во внесувањето, почетокот на терминот е после крајот на терминот!');
    //     }

    //     $termins = Termin::where('accommodation_id', $request->accommodation)->get();
    //     if (!$termins->first()){
    //         $newTermin = new Termin();
    //         $newTermin->accommodation_id = $request->accommodation;
    //         $newTermin->date_from = $request->termin_from;
    //         $newTermin->date_until = $request->termin_until;
    //         $newTermin->price_per_night = $request->price_per_night;
    //         if($request->note !== null){
    //             $newTermin->note = $request->note;
    //         }
    //         if($newTermin->save()){
    //             return redirect()->route('termin.add')->with('status', 'Успешно внесовте термин');
    //         }
    //     } else {
    //         foreach($termins as $termin){
    //             if(($termin->date_from > $request->termin_from && $termin->date_until > $request->termin_from) || ($termin->date_from > $request->termin_until && $termin->date_until > $request->termin_until)){
    //                 return back()->withErrors('Веке постои термин во избраниот период');
    //             }
    //         }
    //     }
    // }
}
