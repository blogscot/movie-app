{% extends 'templates/default.php' %}

{% block title %}Create New Advert{% endblock %}

{% block content %}
  <table class="movie_table">
    <thead>
      <tr>
        <th><strong>Category</strong></th>
        <th><strong>Movie Title</strong></th>
        <th><strong>Price</strong></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    {% for advert in adverts %}
      <tbody>
        <tr>
          <td>{{ advert.category }}</td>
          <td>{{ advert.title }}</td>
          <td>{{ advert.price|number_format(2,'.',',') }}</td>
          <td><a href="{{ urlFor('advert.update', {id: advert.id}) }}">Update</a></td>
          <td><a href="{{ urlFor('advert.remove', {id: advert.id}) }}">Remove</a></td>
        </tr>
      </tbody>
    {% endfor %}
  </table>

{% endblock %}