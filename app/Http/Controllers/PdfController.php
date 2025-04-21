<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\Ticket;

class PdfController extends Controller
{
    public function create($id)
    {
       
        $ticket = Ticket::find($id);
        $employee = User::where('id',$ticket->user_id)->first();
        

        $pdf = Pdf::loadView('pdf.Tickettemp', compact('ticket','employee'));
        
        return $pdf->download('Ticket_' . $ticket->id .'.pdf');

    }
}
