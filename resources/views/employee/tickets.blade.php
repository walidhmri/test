@extends('layouts.app')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Dashboard</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tickets</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Tickets</h6>
      </nav>
    </div>
  </nav>
  <!-- End Navbar -->

  <div class="container-fluid py-4">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
      <div class="alert-body">
        <strong>{{ session('success') }}</strong>
      </div>
    </div>
    @endif
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Créer un nouveau ticket</h6>
            </div>
          </div>

          <div class="card-body px-4 pb-2">
            <form id="ticketForm" method="post" action="{{ route('employee.tickets.create') }}" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label class="form-label">Titre</label>
                <input type="text" name="title" class="form-control border-custom" id="ticketTitle" placeholder="Entrez le titre du ticket" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control border-custom" id="ticketDescription" rows="3" placeholder="Décrivez le problème" required></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Priorité</label>
                <select name="priority" class="form-control border-custom" id="ticketPriority" required>
                  <option value="">Sélectionnez une priorité</option>
                  <option value="low">Basse</option>
                  <option value="medium">Moyenne</option>
                  <option value="high">Haute</option>
                  <option value="urgent">Urgente</option>
                </select>
                <label for="file">Si il existe</label>
                <input type="file" name="file" class="form-control-file border-custom">
              </div>
              <button type="submit" class="btn bg-gradient-primary">Envoyer le ticket</button>
            </form>
          </div>
        </div>
      </div>
    </div>

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
                            <h6 class="mb-0 text-sm">{{ $ticket->title }}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $ticket->priority }}</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $ticket->created_at }}</p>
                      </td>
                      <td>
                        <form action="{{ route('employee.tickets.destroy', $ticket->id) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm bg-gradient-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket ?')">
                            <span class="text-white">Supprimer</span>
                          </button>
                        </form>
                      </td>
                      <td>
                        <span class="badge bg-gradient-success">{{ $ticket->status }}</span>
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
  </div>
</main>
@endsection