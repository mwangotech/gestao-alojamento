 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">@yield('title')</h1>
        </div><!-- /.col -->
        @if(isset($breadcrumbs)) 
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            @foreach($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item @if($breadcrumb['active']) active @endif">
                    @if($breadcrumb['url'])
                        <a href="{{$breadcrumb['url']}}">{{$breadcrumb['name']}}</a>
                    @else
                    {{$breadcrumb['name']}}
                    @endif
                </li>
            @endforeach
            </ol>
        </div><!-- /.col -->
        @endif
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
