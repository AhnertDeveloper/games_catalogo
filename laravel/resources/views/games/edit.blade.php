@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Game</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('games.update', $game->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $game->name) }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea name="description" class="form-control">{{ old('description', $game->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="genre">Gênero</label>
            <input type="text" name="genre" class="form-control" value="{{ old('genre', $game->genre) }}">
        </div>
        <div class="form-group">
            <label for="release_date">Data de Lançamento</label>
            <input type="date" name="release_date" class="form-control" value="{{ old('release_date', $game->release_date) }}">
        </div>
        <div class="form-group">
            <label for="image">Imagens</label><br>
            @if($images && count($images))
                @foreach($images as $img)
                    <img src="{{ asset('storage/' . ltrim($img->image, '/')) }}" alt="{{ $game->name }}" class="img-fluid mb-2" style="max-width:100%;margin-bottom:8px;">                @endforeach
            @else
                <span class="text-muted">Sem imagem</span>
            @endif
            <input type="file" name="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('games.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
