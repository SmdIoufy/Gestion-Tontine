@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tirage pour les gagnants</h1>
    <form method="POST" action="{{ route('tirages.tirage') }}">
        @csrf
        <div class="form-group">
            <label for="tontine_id">Sélectionnez une tontine</label>
            <select name="tontine_id" class="form-control" id="tontine_id" required>
                @foreach($tontines as $tontine)
                    <option value="{{ $tontine->id }}">{{ $tontine->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Effectuer le tirage</button>
    </form>
</div>
@endsection
