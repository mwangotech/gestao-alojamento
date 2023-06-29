@extends('layouts.master')
@section('title', 'Gestão de Menus')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="text-right">
            <button type="submit" form="form-menu" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Guardar</button>
            <a class="btn btn-default" href="{{ route('menus.index') }}"><i class="fa fa-reply"></i>&nbsp;Voltar</a>
        </div>
        <br />
    </div>
</div>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="card card-primary" style="margin-bottom: 50px;">
            <div class="card-header">
                <h3 class="card-title">Novo Menu</h3>
            </div>
            <div class="card-body">
                
            @include('components.messages')
        
            <form id="form-menu" action="{{ route('menus.store') }}" method="POST">
                @csrf
                <div class="row">
        
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Parente:</strong>
                            <select name="idMenu" class="form-control">
                                <option value="-1">Nenhum</option>
                                @foreach ($menus as $menu)
                                    @if($menu->id == old('idMenu')) 
                                        <option selected="selected" value="{{$menu->id}}">{{$menu->nome}}</option>
                                    @else
                                    <option value="{{$menu->id}}">{{$menu->nome}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nome:<span style="color:red">*</span></strong>
                            <input type="text" name="nome" value="{{ old('nome') }}" class="form-control" placeholder="Nome">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Icone:</strong>
                            <input type="text" name="icone" value="{{ old('icone')??'far fa-circle' }}" class="form-control" placeholder="Icone">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Link:</strong>
                            <input type="text" name="link" value="{{ old('link') }}" class="form-control" placeholder="Link">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Rota:</strong>
                            <input type="text" name="route" value="{{ old('route') }}" class="form-control" placeholder="Rota">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Codigo:<span style="color:red">*</span></strong>
                            <input type="text" name="codigo" value="{{ old('codigo') }}" class="form-control" placeholder="Codigo">
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Tipo:<span style="color:red">*</span></strong>
                            <select name="tipo" class="form-control">
                                @if(old('tipo')=="collapse")
                                    <option value="item">Item</option>
                                    <option selected="selected" value="collapse">Collapse</option>
                                @else
                                    <option selected="selected" value="item">Item</option>
                                    <option value="collapse">Collapse</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Ordem:<span style="color:red">*</span></strong>
                            <input type="number" name="ordem" value="{{ old('ordem') }}" class="form-control" placeholder="Ordem">
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <strong>Visivel?:</strong>
                            <input type="hidden" value="0" name="visivel">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" name="visivel" value="1" @if (old('visivel'))checked="checked"@endif id="checkboxPrimary3">
                                <label for="checkboxPrimary3">
                                </label>
                            </div>
                        </div>
                    </div>
        
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                        <div class="form-group">
                            <strong>Activo?:</strong>
                            <input type="hidden" value="0" name="estado">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" name="estado" value="1" @if (old('estado'))checked="checked"@endif id="checkboxPrimary2">
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
                                @foreach ($perfis as $perfil)
                                    <div class="col-sm-3">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                        @if(in_array($perfil->id, (old('menu_perfil')??[])))
                                            <input type="checkbox" name="menu_perfil[]" value="{{$perfil->id}}" checked="checked" id="perfil-{{$perfil->id}}">
                                        @else
                                            <input type="checkbox" name="menu_perfil[]" value="{{$perfil->id}}" id="perfil-{{$perfil->id}}">
                                        @endif
                                        <label for="perfil-{{$perfil->id}}">
                                            {{$perfil->nome}}
                                        </label>
                                        </div>
                                    </div>
                                    </div> 
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {

    });
</script>  
@endsection
