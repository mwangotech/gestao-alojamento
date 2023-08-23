
<div class="card-body">
    <table class="table table-striped">
        <thead>
        <tr>
            <th width="10px">Cod.</th>
            <th>Nome</th>
            <th>Nº Identificação</th>
            <th>Email</th>
            <th width="70px">Telefone</th>
            <th width="70px">Tipo</th>
            <th width="70px">Genero</th>
            <th class="text-center" width="60px">Acção</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{ $cliente->id }}</td>
            <td>{{ $cliente->nome }}</td>
            <td>{{ $cliente->BI }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->telefone }}</td>
            <td>{{ $cliente->nomeTipo }}</td>
            <td>{{ $cliente->nomeGenero }}</td>
            <td>
                <a class="btn btn-success select-modal-pesquisa-cliente" href="#" data-idCliente="{{ $cliente->id }}" data-bi="{{ $cliente->BI }}" data-nome="{{ $cliente->nome }}" data-nomeTipo="{{ $cliente->nomeTipo }}"><i class="fas fa-user-check"></i></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>