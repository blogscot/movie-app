{% extends 'templates/default.php' %}

{% block title %}Update Advert{% endblock %}

{% block content %}
<form class="login_form" action="{{ urlFor('advert.update.post', {id: advert.id}) }}" method="post" autocomplete="off">
   <ul class="center-block">
     <h2>Update Advert</h2>
      <li>
         <label for="title">Title: </label>
         <input type="text" name="title" id="title"
         value='{{ advert.title }}'>
         {% if errors.has('title') %} {{ errors.first('title') }} {% endif %}
      </li>
      </li>
      <li>
         <label for="price">Price: </label>
         <input type="number" step="0.01" name="price" id="price"
         value="{{ advert.price|number_format(2,'.',',') }}">
         {% if errors.has('price') %} {{ errors.first('price') }} {% endif %}
      </li>
      <li>
        <label for="title">Category: </label>
        <select class="movie_category" name="category">
          <option value="Romance"
          {% if advert.category == 'Romance' %}
            selected
          {% endif %}>Romance</option>
          <option value="Thriller"
            {% if advert.category == 'Thriller' %}
              selected
            {% endif %}>Thriller</option>
          <option value="Comedy"
            {% if advert.category == 'Comedy' %}
              selected
            {% endif %}>Comedy</option>
          <option value="Horror"
            {% if advert.category == 'Horror' %}
              selected
            {% endif %}>Horror</option>
          <option value="Scifi"
            {% if advert.category == 'Scifi' %}
              selected
            {% endif %}>SciFi</option>
        </select>
      </li>
      <li>
        <label for="title">Description: </label>
        <textarea name="description" rows="8" cols="40">{{ advert.description }}</textarea>
      </li>
      <li>
        <button class="btn btn-primary" type="submit">Update</button>
      </li>
   </ul>
   <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
</form>
{% endblock %}