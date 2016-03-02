{% extends 'templates/default.twig' %}

{% block title %}Recover Password{% endblock %}

{% block content %}
  <p>Enter your email address to start your password recovery</p>
  <form class="{{ urlFor('auth.password.recover.post')}}" method="post">
    <div>
      <label for="email">Email:</label>
      <input type="text" name="email" id="email" {% if request.post('email') %}  value="{{ request.post('email') }}" {% endif %}>
      {% if errors.has('email') %}
        {{ errors.first('email') }}
      {% endif %}
    </div>
    <div>
      <input type="submit">
    </div>
    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
  </form>
{% endblock %}