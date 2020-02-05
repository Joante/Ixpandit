<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ url('/') }}" style="margin: 0 auto; padding-top: 4px; padding-left: 0px;">
        <img alt="Brand" src="{{URL::asset('/img/logo.png')}}" height="40" width="40" >
      </a>
    </div>
    <ul class="nav navbar-nav navbar-right">
    <form class="navbar-form navbar-left" action="/" method="GET">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Buscar" name="search">
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
      </ul>
    </div><!-- /.navbar-collapse -->
</nav>