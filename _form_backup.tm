<div class="container border">
  {# {{ form_widget(form, { attr: { class: "form-control" } }) }} #}

  {{ form_start(form) }}
  {{ form_row(form.nom, { attr: { class: "input-group mb-3" } }) }}
  {{ form_row(form.description, { attr: { class: "input-group mb-3" } }) }}
  {{ form_row(form.category, { attr: { class: "" } }) }}

  <!-- =================================================================== -->
  <!-- Form d'ajout de photos -->
  <!-- =================================================================== -->
  {# Liste de preview#}
  <ul
    id="photos-fields-list"
    data-prototype="{{ form_widget(form.photos.vars.prototype) | e }}"
    data-widget-tags="{{ '<li></li>' | e }}"
    data-widget-counter="{{ form.photos | length }}"
  >
    {% for row in form.photos|batch(4) %}
    <div class="row border">
      {% for photoField in row %} {# Card #}
      <div class="border">
        <img
          src="{{ asset('/uploads/' ~ photoField.vars.value.name)}}"
          alt="Preview photo"
          height="200"
        />
        <div>
          <form
            action="{{
              path('app_delete_photo', { id: photoField.vars.value.id })
            }}"
            method="post"
          >
            <input
              type="hidden"
              name="token"
              value="{{ csrf_token('delete_'~ photoField.vars.value.id) }}"
            />
            <button type="submit">Delete picture</button>
          </form>

          <li style="list-style-type: none">
            {{ form_errors(photoField.name) }}
            {{ form_widget(photoField.name) }}
          </li>
        </div>
      </div>

      {% endfor %}
    </div>
    {% endfor %}
  </ul>

  {# bouton d'ajout photos #}
  <button
    type="button"
    class="add-another-collection-widget"
    data-list-selector="#photos-fields-list"
  >
    Ajouter une autre photo
  </button>

  <!-- =================================================================== -->
  <!-- Form d'ajout de videos -->
  <!-- =================================================================== -->
  <ul
    id="videos-fields-list"
    data-prototype="{{ form_widget(form.videos.vars.prototype) | e }}"
    data-widget-tags="{{ '<li></li>' | e }}"
    data-widget-counter="{{ form.videos | length }}"
  >
    {% for videoField in form.videos %}

    <li style="list-style-type: none">
      {{ form_errors(videoField.embedded) }}
      {{ form_widget(videoField.embedded) }}
    </li>

    {% endfor %}
  </ul>

  {# bouton d'ajout videos #}
  <button
    type="button"
    class="add-another-collection-widget"
    data-list-selector="#videos-fields-list"
  >
    Ajouter une autre video
  </button>

  {% if app.request.attributes.get('_route') == 'app_edit' %}
  <!-- =================================================================== -->
  <!-- Preview des photos -->
  <!-- =================================================================== -->
  {% for photo in form.photos %} {# toute les photos relie au this trick #}
  <div>
    <img src="{{ asset('/uploads/'~ photo.name)}}" alt="preview photo" />
    <a
      href="{{ path('app_delete', { id: photo.id }) }}"
      data-delete
      data-token="{{ csrf_token('delete'~ photo.id)}}"
      >Delete</a
    >
  </div>
  {% endfor %}
  <!-- =================================================================== -->
  <!-- Preview des videos -->
  <!-- =================================================================== -->

  {% endif %}

  <!-- =================================================================== -->
  <!-- Submit bouton  POST -->
  {# ne pas affiche les labels #}
  <!-- =================================================================== -->
  <input
    type="submit"
    value="{{ submitButtonText|default('Create Trick') }}"
    formnovalidate
  />
  {# Si route edit changer le bouton submit pour une methode PUT // erreur
  method not allowd #}

  {{ form_end(form) }}
</div>

<!-- ======================================================================= -->
<!-- JAVASCRIPT Add bouton -->
<!-- ======================================================================= -->
<script>
  // add-collection-widget.js
  jQuery(document).ready(function () {
    jQuery(".add-another-collection-widget").click(function (e) {
      var list = jQuery(jQuery(this).attr("data-list-selector"));
      // Try to find the counter of the list or use the length of the list
      var counter = list.data("widget-counter") || list.children().length;
      // grab the prototype template
      var newWidget = list.attr("data-prototype");
      // replace the "__name__" used in the id and name of the prototype
      // with a number that's unique to your emails
      // end name attribute looks like name="contact[emails][2]"
      newWidget = newWidget.replace(/__name__/g, counter);
      // Increase the counter
      counter++;
      // And store it, the length cannot be used if deleting widgets is allowed
      list.data("widget-counter", counter);
      // create a new list element and add it to the list
      var newElem = jQuery(list.attr("data-widget-tags")).html(newWidget);
      newElem.appendTo(list);
    });
  });
</script>