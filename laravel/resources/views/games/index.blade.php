@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Catálogo de Games</h1>
    <div class="mb-3">
        <form method="GET" action="{{ route('games.index') }}" class="form-inline">
            <input type="text" name="search" class="form-control mr-2" placeholder="Buscar por nome ou gênero" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="{{ route('games.create') }}" class="btn btn-success ml-2">Novo Game</a>
        </form>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Gênero</th>
                <th>Data de Lançamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($games as $game)
                <tr>
                    <td>
                        @if($game->images && count($game->images))
                            <img src="{{ asset('storage/' . ltrim($game->images->first()->image, '/')) }}" alt="{{ $game->name }}" class="img-fluid mb-2" style="max-width:100%;margin-bottom:8px;">
                        @else
                            <span class="text-muted">Sem imagem</span>
                        @endif
                    </td>
                    <td>{{ $game->name }}</td>
                    <td>{{ $game->genre }} sss</td>
                    <td>{{ $game->release_date ? date('d/m/Y', strtotime($game->release_date)) : '-' }}</td>
                    <td>
                        <a href="{{ route('games.show', $game->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('games.edit', $game->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('games.destroy', $game->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nenhum game encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $games->links() }}
    </div>
</div>
@endsection
