<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    <b>SIGALO</b> |  @auth {{ auth()->user()->name }}<a href="{{ route('logout') }}">&nbsp;Terminar a sessão</a> @endauth
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022-2023 <a href="#">Gestão de Alojamento</a>.</strong> All rights reserved.
</footer>