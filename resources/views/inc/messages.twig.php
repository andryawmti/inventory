{% if errors | length > 0 %}
    {% for error in errors.all %}
        <div style="position:absolute;z-index:2;top:60px;right:20px;" class="alert alert-danger alert-dismissable">
            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
            {{ error }}
        </div>
    {% endfor %}
{% endif %}

{% if session('success') %}
    <div style="position:absolute;z-index:2;top:60px;right:20px;" class="alert alert-success alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        {{ session('success') }}
    </div>
{% endif %}

{% if session('error') %}
    <div style="position:absolute;z-index:2;top:60px;right:20px;" class="alert alert-danger alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        {{ session('error') }}
    </div>
{% endif %}
