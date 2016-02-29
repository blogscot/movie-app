{% extends 'email/templates/default.php' %}

{% block content %}
  <p>You have registered</p>

  <p>Activate your account using this link: {{ baseUrl }}{{ urlFor('auth.activate') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}</p>
{% endblock %}