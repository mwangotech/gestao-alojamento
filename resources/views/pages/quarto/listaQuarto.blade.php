
<table class="table-list table table-bordered table-striped">
    <thead>
    <tr>
        <th class="text-right" width="20px">Nº</th>
        <th>Tipo de Quarto</th>
        <th>Descrição</th>
        <th class="text-right">Preço</th>
        <th class="text-right" width="50px">Valor</th>
        <th class="text-right" width="50px">Adultos</th>
        <th class="text-right" width="50px">Crianças</th>
        <th class="text-center" width="10px"></th>
        <!--th class="text-center" width="10px">Info.</th-->
    </tr>
    </thead>
    <tbody>
    @foreach ($quartos as $quarto)
    <tr>
        <td class="text-right">{{$quarto->numero}}</td>
        <td>{{ $quarto->nomeTipoQuarto }}</td>
        <td>{{ $quarto->nome }}</td>
        <td class="text-right">{{number_format($quarto->preco,0,',',' ')}} kz</td>
        <td class="text-right">{{number_format($quarto->valor,0,',',' ')}} kz</td>
        <td class="text-right">{{$quarto->limit_adulto}}</td>
        <td class="text-right">{{$quarto->limit_crianca}}</td>
        <td class="text-center">
            <div class="icheck-success d-inline">
                <input type="radio" class="quartoSelecionado" data-preco="{{$quarto->preco}}" data-valor="{{$quarto->valor}}" value="{{$quarto->id}}" name="quartoSelecionado" id="quartoSelecionado_{{$quarto->id}}">
                <label for="quartoSelecionado_{{$quarto->id}}">
                </label>
            </div>
        </td>
        {{-- <!--td>
            <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-html="true" title='@foreach ($quarto->servicos as $servico)
            <span class="badge badge-secondary">{{$servico->nome}}</span>
            @endforeach'>
            Serviços
            </button>
            </td-->
        <!--td>
            @foreach ($quarto->comodidades as $comodidade)
            <span class="badge badge-secondary">{{$comodidade->nome}}</span>
        @endforeach
        </td-->--}}
    </tr>
    @endforeach
    </tbody>
</table>