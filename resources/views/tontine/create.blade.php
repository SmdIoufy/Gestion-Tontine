@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('tontines.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nom de la tontine</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
