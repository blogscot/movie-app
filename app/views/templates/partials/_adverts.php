{% block adverts %}
  {% if adverts is empty %}
    <p class="well text-danger text-center">You currently have no adverts.</p>
  {% else %}
    <table class="table table-bordered table-condensed table-hover">
      <thead>
      <tr>
        <th><strong>Category</strong></th>
        <th><strong>Movie Title</strong></th>
        <th><strong>Price</strong></th>
        <th><strong>Expires on</strong></th>
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
        <td>{{ advert.expires_on|date('d-m-Y') }}</td>
        <td><a href="{{ urlFor('advert.update', {id: advert.id}) }}"><button
          class="btn btn-primary btn-sm" type="button" name="button">Update</button></a></td>
        <td><a href="{{ urlFor('advert.remove', {id: advert.id}) }}"><button
          class="btn btn-danger btn-sm" type="button" name="button">Remove</button></a></td>
      </tr>
      </tbody>
    {% endfor %}
    </table>
  {% endif %}
{% endblock %}