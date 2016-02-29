<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ baseUrl() }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ baseUrl() }}/css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title>Abertay SA | {% block title %}{% endblock %}</title>
  </head>
  <body>
    <div id="wrap">
      {% include 'templates/partials/messages.php' %}
      {% include 'templates/partials/navigation.php' %}

      <div class="container">
        {% block content %}{% endblock %}
      </div>
    </div>
    {% include 'templates/partials/footer.php' %}

  </body>
</html>
