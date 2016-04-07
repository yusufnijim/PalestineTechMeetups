<link rel="stylesheet" type="text/css" media="screen"
      href="http://formbuilder.online/assets/css/form-builder.min.css">
<textarea id="fb-template"></textarea>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="http://formbuilder.online/assets/js/form-builder.min.js"></script>
<script>

    $(document).ready(function ($) {

        var options = {
            controlPosition: 'right',
            controlOrder: [
                'text',
                'textarea',
                'checkbox-group',
                'date',
                'radio-group',
                'select',
            ],
            dataType: 'xml',
            prefix: 'fb-'
        };

        var fbTemplate = document.getElementById('fb-template');
        var formBuilder = $(fbTemplate).formBuilder(options);

        $(".fb-save").click(function (e) {
            e.preventDefault();
            var formData = formBuilder.data('formBuilder').formData;
            saveForm(formData);
        });
    });

    function saveForm(formData) {

        $.post("/survey/saveform", {formdata: formData})
                .done(function (data) {
                    alert("Data Loaded: " + data);
                });
    }

</script>
