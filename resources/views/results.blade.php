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
                      <img src="{{ asset('candidat/photos/' . $candidate->photo) }}" alt="Photo de {{ $candidate->nom }} {{ $candidate->prenom }}" width="50" height="50">
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
                      <img src="{{ asset('candidat/photos/' . $candidate->photo) }}" alt="Photo de {{ $candidate->nom }} {{ $candidate->prenom }}" width="50" height="50">
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
    </div>
  </div>
</div>
@endsection
