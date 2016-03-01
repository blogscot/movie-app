{% extends 'templates/default.php' %}

{% block title %}Register{% endblock %}

{% block content %}
  <form class="register_form" action="{{ urlFor('auth.register.post') }}" method="post" autocomplete="off">
    <ul class="center-block">
      <h2>Please register</h2>
      <li>
        <label for="firstname">Firstname: </label>
        <input type="text" name="firstname" id="firstname" {% if request.post('firstname') %}
          value="{{ request.post('firstname') }}" {% endif %}>
        {% if errors.has('firstname') %}{{ errors.first('firstname') }} {% endif %}
      </li>
      <li>
        <label for="surname">Surname: </label>
        <input type="text" name="surname" id="surname" {% if request.post('surname') %}
          value="{{ request.post('surname') }}" {% endif %}>
        {% if errors.has('surname') %}{{ errors.first('surname') }} {% endif %}
      </li>
      <li>
        <label for="username">Username: </label>
        <input type="text" name="username" id="username" {% if request.post('username') %}
          value="{{ request.post('username') }}" {% endif %}>
        {% if errors.has('username') %}{{ errors.first('username') }} {% endif %}
      </li>
      <li>
        <label for="email">Email: </label>
        <input type="text" name="email" id="email" {% if request.post('email') %}
          value="{{ request.post('email') }}" {% endif %}>
        {% if errors.has('email') %}{{ errors.first('email') }} {% endif %}
      </li>
      <li>
        <label for="password1">Password: </label>
        <input type="password" name="password1" id="password1">
        {% if errors.has('password1') %}{{ errors.first('password1') }} {% endif %}
      </li>
      <li>
        <label for="password2">Confirm Password: </label>
        <input type="password" name="password2" id="password2">
        {% if errors.has('password2') %}{{ errors.first('password2') }} {% endif %}
      </li>
      <li>
       <button class="btn btn-primary" type="submit">Register</button>
      </li>
    </ul>
    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
  </form>
{% endblock %}
