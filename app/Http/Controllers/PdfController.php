<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\ticket;

class PdfController extends Controller
{
    public function create($id)
    {
       
        $ticket = ticket::find($id);
        $employee = User::where('id',$ticket->user_id)->first();
        

        $pdf = Pdf::loadView('pdf.tickettemp', compact('ticket','employee'));
        
        return $pdf->download('ticket_' . $ticket->id .'.pdf');

    }
}
