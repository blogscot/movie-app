{% if auth %}
   <p>Hello {{ auth.getUsername() }},</p>
{% else %}
   <p>Hello there,</p>
{% endif %}

{% block content %}{% endblock %}
