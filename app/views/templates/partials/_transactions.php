{% block tranactionstable %}
<table class="table table-bordered table-hover table-striped table-condensed">
  <thead>
    <tr>
      <th> Date </th>
      <th> Reason </th>
      <th> Seller </th>
      <th> Note </th>
      <th> Amount </th>
      <th> Balance </th>
    </tr>
  </thead>
  <tbody>
    {% for transaction in transactions %}
    <tr>
      <td> {{ transaction.updated_at|date("d/m/Y") }} </td>
      <td> {{ transaction.reason }} </td>
      <td>
        {% if transaction.seller_id == 0 %}
          -
        {% else %}
          {{ auth.getUsernameById(transaction.seller_id)|capitalize }}
        {% endif %}
      </td>
      <td>
        {% if transaction.title is empty %}
          -
        {% else %}
          {{ transaction.title }}
        {% endif %}
      </td>
      <td> &pound;{{ transaction.amount|number_format(2,'.',',') }} </td>
      <td> &pound;{{ transaction.balance|number_format(2,'.',',') }} </td>
    </tr>
    {% endfor %}
  </tbody>
</table>
{% endblock %}