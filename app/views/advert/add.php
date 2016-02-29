{% extends 'templates/default.php' %}

{% block title %}Create New Advert{% endblock %}

{% block content %}

   <form class="login_form" action="{{ urlFor('advert.add.post') }}" method="post" autocomplete="off">
      <ul class="center-block">
        <h2>Create New Advert</h2>
         <li>
            <label for="title">title: </label>
            <input type="text" name="title" id="title">
            {% if errors.has('title') %} {{ errors.first('title') }} {% endif %}
         </li>
         <li>
            <label for="price">price: </label>
            <input type="number" name="price" id="price">
            {% if errors.has('price') %} {{ errors.first('price') }} {% endif %}
         </li>         <li>
           <button class="btn btn-primary" type="submit">Add</button>
         </li>
      </ul>
      <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
   </form>

{% endblock %}