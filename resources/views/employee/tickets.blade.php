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
 
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Créer un nouveau ticket</h6>
            </div>
          </div>

          <div class="card-body px-4 pb-2">
            <form id="ticketForm" method="post" action="{{route('employee.tickets.add')}}" enctype="multipart/form-data">
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
  
  </div>
</main>
@endsection