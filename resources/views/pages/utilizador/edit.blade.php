@extends('layouts.master')
@section('title', 'Utilizadores')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="text-right">
            <a class="btn btn-default" href="{{ route('utilizadores.index') }}"> Voltar</a>
        </div>
        <br />
    </div>
</div>
   
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Editar Utilizador</h3>
        </div>
        <div class="card-body">
         
        @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Oops!</strong> Preecha os campos obrigatorios.<br><br>
        </div>
        @endif

        <form action="{{ route('utilizadores.update',$utilizador->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nome <span style="color:red">*</span>:</strong>
                        <input type="text" name="name" value="{{ $utilizador->name }}" class="form-control" placeholder="Nome">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Utilizador <span style="color:red">*</span>:</strong>
                        <input type="text" name="username" value="{{ $utilizador->username }}" class="form-control" placeholder="Utilizador">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email <span style="color:red">*</span>:</strong>
                        <input type="email" name="email" value="{{ $utilizador->email }}" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Senha:</strong>
                        <input type="password" name="password" value="" class="form-control" placeholder="Senha">
                    </div>
                </div>
                
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Activo?:</strong>
                        <input type="hidden" value="0" name="status">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" name="status" value="1" @if ($utilizador->status)checked="checked"@endif id="checkboxPrimary2">
                            <label for="checkboxPrimary2">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Perfis</h3>
                        </div>
                        <div class="card-body">
                          <!-- Minimal style -->
                          <div class="row">
                            @foreach ($perfis as $perfi)
                                <div class="col-sm-3">
                                <!-- checkbox -->
                                <div class="form-group clearfix">
                
                                    <div class="icheck-primary d-inline">
                                    @if( in_array($perfi->id, ($selectPerfil??[])) || in_array($perfi->id, (old('utilizador_perfil')??[])))
                                        <input type="checkbox" name="utilizador_perfil[]" value="{{$perfi->id}}" checked="checked" id="perfil-{{$perfi->id}}">
                                    @else
                                        <input type="checkbox" name="utilizador_perfil[]" value="{{$perfi->id}}" id="perfil-{{$perfi->id}}">
                                    @endif
                                    <label for="perfil-{{$perfi->id}}">
                                        {{$perfi->nome}}
                                    </label>
                                    </div>
                                </div>
                                </div> 
                            @endforeach
                          </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection
<script>
    $(function () {

    });
</script>  