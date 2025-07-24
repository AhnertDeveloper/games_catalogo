@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalhes do Game</h1>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    @if($images && count($images))
                        <img src="{{ asset('storage/' . ltrim($images->first()->image, '/')) }}" alt="{{ $game->name }}" class="img-fluid mb-2" style="max-width:100%;margin-bottom:8px;">
                    @else
                        <span class="text-muted">Sem imagem</span>
                    @endif
                </div>
                <div class="col-md-9">
                    <h3>{{ $game->name }}</h3>
                    <p><strong>Gênero:</strong> {{ $game->genre }}</p>
                    <p><strong>Data de Lançamento:</strong> {{ $game->release_date ? date('d/m/Y', strtotime($game->release_date)) : '-' }}</p>
                    <p><strong>Descrição:</strong><br>{{ $game->description }}</p>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('games.edit', $game->id) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('games.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
