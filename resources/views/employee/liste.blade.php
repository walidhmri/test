@extends('layouts.app')
@section('content')
  <!-- Liste des tickets -->

<div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Tickets existants</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Titre</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Priorité</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Statut</th>
                  </tr>
                </thead>
                <tbody id="ticketList">
                  @foreach ($tickets as $ticket)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{asset(path: 'storage/'.$ticket->file)}}" class="avatar avatar-sm rounded-circle me-2">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ \Illuminate\Support\Str::words($ticket->title, 3, '...') }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="badge 
                            @if($ticket->priority == 'low') bg-gradient-success
                            @elseif($ticket->priority == 'medium') bg-gradient-warning
                            @elseif($ticket->priority == 'high') bg-gradient-danger
                            @elseif($ticket->priority == 'urgent') bg-gradient-dark
                            @else bg-gradient-secondary
                            @endif">
                            {{ ucfirst($ticket->priority) }}
                        </span>
                    </td>
                    
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $ticket->created_at }}</p>
                      </td>
                      <td>
                        @php
                        $createdAt = \Carbon\Carbon::parse($ticket->created_at);
                        $now = \Carbon\Carbon::now();
                        $diffInHours = $createdAt->diffInHours($now);
                        @endphp
                    
                        @if($diffInHours < 24)
                        <form action="{{ route('employee.tickets.destroy', $ticket->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm bg-gradient-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket ?')">
                                <span class="text-white">Supprimer</span>
                            </button>
                        </form>
                        @else
                        <label for="down">u can't delete</label>
                        @endif
                        <a href="{{route('employee.tickets.edit', $ticket->id)}}" class="btn btn-sm bg-gradient-info">
                            <span class="text-white">Edit</span>
                        </a>
                        <a name="down" href="{{route('pdf.ticket',['id'=>$ticket->id])}}" class="btn btn-sm bg-gradient-dark">
                            Download
                        </a>
                      </td>
                      <td>
                        <span class="badge 
                            @if($ticket->status == 'pending') bg-gradient-warning
                            @elseif($ticket->status == 'solved') bg-gradient-success
                            @elseif($ticket->status == 'in_progress') bg-gradient-info
                            @elseif($ticket->status == 'closed') bg-gradient-secondary
                            @else bg-gradient-dark
                            @endif">
                            {{ $ticket->status }}
                        </span>
                    </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="flex justify-center mt-4">
                {{ $tickets->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection