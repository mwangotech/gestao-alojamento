
<table class="table-list table-list-reserva table table-bordered table-striped">
    <thead>
    <tr>
        <th>Criado por</th>
        <th>Estado</th>
        <th class="text-right">Nota</th>
        <!--th class="text-center" width="10px">Info.</th-->
    </tr>
    </thead>
    <tbody>
    @foreach ($historicos as $historico)
    <tr>
        <td class="text-right"><a href="javascript:void(0)">{{$historico->nomeUtilizador}}</a>&nbsp;.:.&nbsp;{{$historico->created_at}}</td>
        <td><span class="right badge badge-{{ $historico->corEstadoReserva }}">{{ $historico->nomeEstadoReserva }}</span></td>
        <td>{{ $historico->notas }}</td>
    </tr>
    @endforeach
    </tbody>
</table>