@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Bem-vindo ao Catálogo de Games</h1>
    <div id="carouselFeatured" class="carousel slide mb-4" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($featured as $key => $game)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-center">
                        @if($game->images && count($game->images))
                            <img src="{{ asset('storage/' . ltrim($game->images->first()->image, '/')) }}" class="d-block" alt="{{ $game->name }}" style="max-height: 250px;">
                        @else
                            <span class="text-muted">Sem imagem</span>
                        @endif
                    </div>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $game->name }}</h5>
                        <p>{{ $game->genre }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselFeatured" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselFeatured" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>
    <h2 class="mb-3">Games Recentes</h2>
    <div class="row">
        @forelse($games as $game)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($game->images && count($game->images))
                        <img src="{{ asset('storage/' . ltrim($game->images->first()->image, '/')) }}" class="card-img-top" alt="{{ $game->name }}" style="max-height: 180px; object-fit: cover;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 180px;">
                            <span class="text-muted">Sem imagem</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $game->name }}</h5>
                        <p class="card-text">{{ $game->genre }}</p>
                        <a href="{{ route('games.show', $game->id) }}" class="btn btn-primary btn-sm">Ver detalhes</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>Nenhum game cadastrado.</p>
            </div>
        @endforelse
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('games.index') }}" class="btn btn-outline-secondary">Ver catálogo completo</a>
    </div>
</div>
@endsection
