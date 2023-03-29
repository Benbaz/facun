@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-warning">Résultats des élections des Miss</div>
        <div class="card-body">
          @if($electionResults)
          <div class="row">
            <div class="col-md-12">
              <h3>Résultats de l'élection des Miss</h3>
              <table class="table">
                <thead>
                  <tr>
                    <th>Candidat</th>
                    <th>Etablissement</th>
                    <th>Score</th>
                    <th>Pourcentage</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($candidates as $candidate)
                  <tr>
                    <td>
                      <a href="#" data-toggle="modal" data-target="#imageModal" data-candidat-nom="{{ $candidate->nom }}" data-image-src="{{ asset('candidat/photos/' . $candidate->photo) }}">
                        <img src="{{ asset('candidat/photos/' . $candidate->photo) }}" class="card-img-top" alt="{{ $candidate->nom }}" width="150" height="150">
                      </a>
                      {{ $candidate->nom }} {{ $candidate->prenom }}
                    </td>
                    <td>{{ $candidate->etablissement }}</td>
                    <td>{{ $candidate->score }}</td>
                    <td>
                      {{ $candidate->pourcentage }}%
                      <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{ $candidate->pourcentage }}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          @else
          <p>Aucun résultat disponible pour le moment.</p>
          @endif
        </div>
      </div>
      <br /><br /><br />
      <div class="card">
        <div class="card-header bg-warning">Résultats des élections des master</div>
        <div class="card-body">
          @if($electionResults)
          <div class="row">
            <div class="col-md-12">
              <h3>Résultats de l'élection des master</h3>
              <table class="table">
                <thead>
                  <tr>
                    <th>Candidat</th>
                    <th>Etablissement</th>
                    <th>Score</th>
                    <th>Pourcentage</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($candidatesMaster as $candidate)
                  <tr>
                    <td>
                      <a href="#" data-toggle="modal" data-target="#imageModal" data-candidat-nom="{{ $candidate->nom }}" data-image-src="{{ asset('candidat/photos/' . $candidate->photo) }}">
                        <img src="{{ asset('candidat/photos/' . $candidate->photo) }}" class="card-img-top" alt="{{ $candidate->nom }}" width="150" height="150">
                      </a>
                      <b>{{ $candidate->nom }} {{ $candidate->prenom }}</b>
                    </td>
                    <td>{{ $candidate->etablissement }}</td>
                    <td>{{ $candidate->score }}</td>
                    <td>
                      {{ $candidate->pourcentage }}%
                      <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{ $candidate->pourcentage }}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          @else
          <p>Aucun résultat disponible pour le moment.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<br /><br /><br /> <br />
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p>&copy; {{ date('Y') }} Design and create by OOREDOO. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>

<!-- display the candidat picture in a modal -->

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="" class="img-fluid mx-auto d-block" alt="">
      </div>
    </div>
  </div>
</div>

@endsection