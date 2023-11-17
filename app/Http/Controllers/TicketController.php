<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store(Request $request){
        $ticketData = new Ticket();
        $ticketData->firstname = $request->input('firstname');
        $ticketData->lastname = $request->input('lastname');
        $ticketData->email = $request->input('email');
        $ticketData->phone_number = $request->input('phone_number');
        $ticketData->from = $request->input('from');
        $ticketData->to = $request->input('to');
        $ticketData->travel_date = $request->input('travel_date');
        $ticketData->return_date = $request->input('return_date');
        $ticketData->type = $request->input('type');
        $ticketData->n_of_adults = $request->input('n_of_adults');
        $ticketData->n_of_kids = $request->input('n_of_kids');
        $ticketData->n_of_babies = $request->input('n_of_babies');
        $ticketData->class = $request->input('class');
        if($ticketData->save()){
            return response()->json('Saved', 200);
        } else {
            return response()->json('error', 500);
        }
    }

    public function index(){
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    public function confirm(Request $request){
        $ticket = Ticket::find($request->id);
        $ticket->status = 'completed';
        $ticket->save();
        return back()->with('status', 'Успешно го сменивте статусот на барањето за билет');

    }
}
