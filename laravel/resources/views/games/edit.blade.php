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
                <div class="mb-2">
                @foreach($images as $img)
                    <div style="display:inline-block; margin-right:10px; position:relative;">
                        <img src="{{ asset('storage/' . ltrim($img->image, '/')) }}" alt="{{ $game->name }}" class="img-fluid mb-2" style="max-width:120px; max-height:120px; display:block;">
                        <form action="{{ route('games.images.destroy', ['game' => $game->id, 'image' => $img->id]) }}" method="POST" style="position:absolute; top:0; right:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja apagar esta imagem?')">&times;</button>
                        </form>
                    </div>
                @endforeach
                </div>
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
