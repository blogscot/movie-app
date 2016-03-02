{% extends 'templates/default.php' %}

{% block title %}Create New Advert{% endblock %}

{% block content %}

   <form class="login_form" action="{{ urlFor('advert.add.post') }}" method="post" autocomplete="off">
      <ul class="center-block">
        <h2>Create New Advert</h2>
         <li>
            <label for="title">Title: </label>
            <input type="text" name="title" id="title">
            {% if errors.has('title') %} {{ errors.first('title') }} {% endif %}
         </li>
         </li>
         <li>
            <label for="price">Price: </label>
            <input type="number" step="0.01" name="price" id="price">
            {% if errors.has('price') %} {{ errors.first('price') }} {% endif %}
         </li>
         <li>
           <label for="title">Category: </label>
           <select class="movie_category" name="category">
             <option value="Comedy">Comedy</option>
             <option value="Horror">Horror</option>
             <option value="Romance">Romance</option>
             <option value="Scifi">SciFi</option>
             <option value="Thriller">Thriller</option>
           </select>
         </li>
         <li>
           <label for="title">Description: </label>
           <textarea name="description" rows="8" cols="40"></textarea>
         </li>
         <li>
           <button class="btn btn-primary" type="submit">Create</button>
         </li>
      </ul>
      <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
   </form>

{% endblock %}