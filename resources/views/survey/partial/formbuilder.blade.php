<link rel="stylesheet" type="text/css" media="screen"
      href="http://formbuilder.online/assets/css/form-builder.min.css">

<div id="fb-editor"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="http://formbuilder.online/assets/js/form-builder.min.js"></script>
<script>

    jQuery(function ($) {
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
{{--                formData: "{!!  $survey->raw_form !!}",--}}
                formData: '{!!  preg_replace('~[\r\n]+~', '', $survey->raw_form) !!}',
                prefix: 'fb-',
                disableFields: [
                    'header',
                    'paragraph',
                    'hidden'
                ]
            }
            ;
        var fbTemplate = $(document.getElementById('fb-editor'));
        var formBuilder = $(fbTemplate).formBuilder(options);

        $(".fb-save").click(function (e) {
            e.preventDefault();
            var formData = formBuilder.data('formBuilder').formData;
            console.log(formData);
            saveForm(formData);
        });
    });

    function saveForm(formData) {
        survey_id = $('#survey_id').val();
        console.log(formData);
        $.post("/survey/saveform/" + survey_id, {formdata: formData})
            .done(function (data) {
                alert('Saved successfully');
            });
    }

</script>
