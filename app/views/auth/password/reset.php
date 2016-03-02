{% extends 'templates/default.twig' %}

{% block title %}Reset Password{% endblock %}

{% block content %}
  <form action="{{ urlFor('auth.password.reset.post') }}?email={{ email }}&identifier={{ identifier|url_encode }}" method="post" autocomplete="off">
    <div>
      <label for="password">New Password:</label>
      <input type="password" name="password" id="password">
      {% if errors.has('password') %}{{ errors.first('password') }}{% endif %}
    </div>
    <div>
      <label for="passwordConfirm">Confirm New Password:</label>
      <input type="password" name="passwordConfirm" id="passwordConfirm">
      {% if errors.has('passwordConfirm') %}{{ errors.first('passwordConfirm') }}{% endif %}
    </div>
    <div>
      <input type="submit" value="Change Password">
    </div>
    <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
  </form>
{% endblock %}