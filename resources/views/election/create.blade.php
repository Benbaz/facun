@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Ajouter une election') }}</h1>

<div class="row justify-content-center">

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Add Election') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('election.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                        <div class="col-md-6">
                            <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required>
                                <option value="">-- Select Type --</option>
                                <option value="miss" @if(old('type')=='miss' ) selected @endif>Miss</option>
                                <option value="master" @if(old('type')=='master' ) selected @endif>Master</option>
                            </select>

                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date') }}</label>

                        <div class="col-md-6">
                            <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" required autocomplete="start_date">

                            @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('End Date') }}</label>

                        <div class="col-md-6">
                            <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" required autocomplete="end_date">

                            @error('end_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add Election') }}
                            </button>
                        </div>
                    </div>


            </div>

            @endsection