<link rel="stylesheet" type="text/css" media="screen"
      href="http://formbuilder.online/assets/css/form-builder.min.css">

<textarea id="fb-template">{{ $survey->raw_form }}</textarea>

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
            prefix: 'fb-',
            disableFields: [
                'header',
                'paragraph',
                'hidden'
            ]
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
        survey_id = $('#survey_id').val();
        $.get("/survey/saveform/" + survey_id, {formdata: formData})
                .done(function (data) {
                    alert('Saved successfully');
                });
    }

</script>
