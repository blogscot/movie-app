<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
        data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ urlFor('home') }}">Sell Movies</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="{{ urlFor('home') }}">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
            aria-haspopup="true" aria-expanded="false">Adverts <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ urlFor('advert.viewall') }}">View Adverts</a></li>
            {% if auth %}
              <li><a href="{{ urlFor('advert.add') }}">Create New Advert</a></li>
            {% endif %}
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        {% if auth %}
          {% if auth.isAdmin %}
          <li><a href="#">Admin</a></li>
          {% endif %}
          <li><a href="#">Username: {{ auth.username}}</a></li>
          <li><a href="{{ urlFor('auth.logout') }}">Logout</a></li>
        {% else %}
          <li><a href="{{ urlFor('auth.login') }}">Login</a></li>
          <li><a href="{{ urlFor('auth.register') }}">Register</a></li>
        {% endif %}
      </ul>
    </div>
  </div>
</nav>