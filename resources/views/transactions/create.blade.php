@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Upload a the transaction') }}</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow rounded">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">Enregistrer Candidat</h4>
                </div>
                <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="excel_file">Excel File</label>
                        <input type="file" name="excel_file" id="excel_file" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection