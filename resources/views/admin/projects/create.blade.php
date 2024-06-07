@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('admin.projects.store')}}" method="POST">

            @csrf
            <div class="mb-3">
                <div>
                    <label for="title">Titolo:</label>
                </div>
                <input type="text" name="title" id="title" class="form-control" placeholder="Titolo del Progetto">
            </div>

            <div class="mb-3">
                <div>
                    <label for="type_id">Type:</label>
                </div>
                <select name="type_id" id="type_id">
                    <option value="">--SELECT TYPE--</option>
                    @foreach ($types as $type)
                    <option @selected($type->id == old('type_id')) value="{{$type->id}}">{{$type->name}}</option>
                        
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <h2>Seleziona le tecnologie utilizzate</h2>
      
                <div class="d-flex gap-2">
                  @foreach ($technologies as $technology)
      
                    <div class="form-check">
                      <input @checked( in_array($technology->id, old('technologies',[])) ) name="technologies[]" class="form-check-input" type="checkbox" value="{{ $technology->id }}" id="technology-{{$technology->id}}">
                      <label class="form-check-label" for="technology-{{$technology->id}}">
                        {{ $technology->name }}
                      </label>
                    </div>
                      
                  @endforeach
                </div>
                
              </div>


            <div class="mb-3">
                <div>
                    <label for="title">Descrizione:</label>
                </div>
                <input type="text" name="description" id="description" class="form-control" placeholder="Descrizione progetto">
            </div>

            <div class="mb-3">
                <div>
                    <label for="title">Link Git:</label>
                </div>
                <input type="text" name="github_link" id="github_link" class="form-control" placeholder="Link per GitHub">
            </div>

            <button class="btn btn-primary">Crea</button>

        </form>

        <div>
            @if ($errors->any())
                        <p class="">
                          <ul>
                          @foreach ($errors->all() as $error )
                            <li class="alert alert-danger">{{ $error }}</li>
                          @endforeach
                          </ul>
                      </p>
            @endif

        </div>
    </div>
@endsection