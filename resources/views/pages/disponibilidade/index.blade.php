@extends('layouts.master')
@section('title', 'Disponibilidades')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-right">
                {{--<a class="btn btn-primary" href="{{ route('disponibilidades.create') }}"> Novo</a>--}}
            </div>
        </div>
    </div>
    <br/>

    
@endsection
@section('footer-scripts')
<script>
    $('.form-delete-button').on('click', function() {
        Swal.fire({
            title: 'Deseja eliminar o registo?',
            text: "Ao eliminar esse registo, poderás perder o acesso permanente a ele.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sim, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                var myform = $(this).closest("#list-form-delete");
                myform.submit();
            }
        })
    })
</script>
@endsection