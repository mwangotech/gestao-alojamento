@extends('layouts.master')
@section('title', 'Perfis')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="text-right">
            <a class="btn btn-default" href="{{ route('perfis.index') }}"> Voltar</a>
        </div>
        <br />
    </div>
</div>
   
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Editar Perfil</h3>
        </div>
        <div class="card-body">
         
        @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Oops!</strong> Preecha os campos obrigatorios.<br><br>
        </div>
        @endif

        <form action="{{ route('perfis.update',$perfil->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nome <span style="color:red">*</span>:</strong>
                        <input type="text" name="nome" value="{{ $perfil->nome }}" class="form-control" placeholder="Nome">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Ordem <span style="color:red">*</span>:</strong>
                        <input type="number" name="ordem" value="{{ $perfil->ordem }}" class="form-control" placeholder="Ordem">
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Activo?:</strong>
                        <input type="hidden" value="0" name="estado">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" name="estado" value="1" @if ($perfil->estado)checked="checked"@endif id="checkboxPrimary2">
                            <label for="checkboxPrimary2">
                            </label>
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