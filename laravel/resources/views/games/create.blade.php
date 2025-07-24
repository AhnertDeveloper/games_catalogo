@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Cadastrar Novo Game</h1>
    <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="genre">Gênero</label>
            <input type="text" name="genre" class="form-control" value="{{ old('genre') }}">
        </div>
        <div class="form-group">
            <label for="release_date">Data de Lançamento</label>
            <input type="date" name="release_date" class="form-control" value="{{ old('release_date') }}">
        </div>
        <div class="form-group">
            <label for="image">Imagem</label>
            <input type="file" name="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
        <a href="{{ route('games.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection

