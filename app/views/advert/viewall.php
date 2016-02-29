{% extends 'templates/default.php' %}

{% block title %}Create New Advert{% endblock %}

{% block content %}
  <table style="width: 300px">
    <thead>
      <tr> <th> <strong>Item</strong></th> <th> <strong>Price</strong></th> </tr>
    </thead>
    {% for advert in adverts %}
      <tbody>
        <tr> <td> {{ advert.title }} </td> <td> {{ advert.price }} </td> </tr>
      </tbody>
    {% endfor %}
  </table>

{% endblock %}