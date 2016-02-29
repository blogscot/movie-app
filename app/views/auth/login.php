{% extends 'templates/default.php' %}

{% block title %}Login{% endblock %}

{% block content %}
   <form class="login_form" action="{{ urlFor('auth.login.post') }}" method="post" autocomplete="off">
      <ul class="center-block">
        <h2>Please login</h2>
         <li>
            <label for="identifier">Username/Email: </label>
            <input type="text" name="identifier" id="identifier">
            {% if errors.has('identifier') %} {{ errors.first('identifier') }} {% endif %}
         </li>
         <li>
            <td><label for="password">Password: </label></td>
            <td><input type="password" name="password" id="password"></td>
            {% if errors.has('password') %} {{ errors.first('password') }} {% endif %}
         </li>
         <li>
           <button class="btn btn-primary" type="submit">Login</button>
         </li>
         <li>
           <a href="{{ urlFor('auth.password.recover') }}">Forgotten your password?</a>
         </li>
      </ul>
      <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
   </form>
{% endblock %}
