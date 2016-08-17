<?php

namespace App\Models\Survey;

use App\Models\BaseModel;

class SurveyQuestionModel extends BaseModel
{
    protected $table = 'survey_question';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    // ];

    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];


    public static function insert($request, $survey_id)
    {
        $s = SurveyQuestionModel::where('survey_id', $survey_id)->delete();
//        $instance->save();

        $form_data = $request->formdata; //get the xml from the request object(post)
        if (isset($form_data)) {
            $fields = static::get_form_fields($form_data); //parse the xml


            foreach ($fields as $field) { //loop through the form fields

                $instance = new Static();
                $instance->survey_id = $survey_id;


                $other['class'] = $field['class'];
                $other['required'] = @$field['required'];
                $other['placeholder'] = @$field['placeholder'];
                $instance->other = serialize($other);

                if ($field['type'] == "text") {
                    $instance->type_id = 1;
                    $instance->title = $field['label'];
//                    $instance->class = $field['class'];
                } elseif ($field['type'] == "textarea") {
                    $instance->type_id = 2;
                    $instance->title = $field['label'];
//                    $instance->class = $field['class'];
                } elseif ($field['type'] == "radio-group") {
                    $instance->type_id = 3;
                    $instance->choice = serialize($field['options']);
                    $instance->title = $field['label'];
//                    $instance->class = $field['class'];
                } elseif ($field['type'] == "checkbox-group") {
                    $instance->type_id = 4;
                    $instance->choice = serialize($field['options']);
                    $instance->title = $field['label'];
//                    $instance->class = $field['class'];
                } elseif ($field['type'] == "select") {
                    $instance->type_id = 5;
                    $instance->choice = serialize($field['options']);
                    $instance->title = $field['label'];
//                    $instance->class = $field['class'];
                } elseif ($field['type'] == "date") {
                    $instance->type_id = 8;
                    $instance->choice = serialize($field['options']);
                    $instance->title = $field['label'];
//                    $instance->class = $field['class'];
                } else { // matching nowthing !
                    continue;
                }

                $instance->save();
            }
        }
    }

    private static function get_form_fields($form_data)
    {
        $xml = simplexml_load_string($form_data);
        $result = [];

        if (isset($xml->fields) and isset($xml->fields->field)) {  // make sure the form is not empty !
            foreach ($xml->fields->field as $record) { // loop through every field
                $array = (array)$record; // covert it to an array

                $record = current($array); // get the field
                $record['options'] = next($array); //additional options, needed for radio buttons, select lists...etc

                $result[] = $record;
            }
        }

        return $result;
    }
//    public static function edit($id, $request)
//    {
//        $instance = static::_handleCreateEdit(Static::findOrFail($id), $request);
//        return $instance;
//    }

    private static function _handleInsertEdit($instance, $request)
    {
        $instance->fill([
            'question' => "a" . $request->question,
            'type_id' => 1, // $request->type_id,
            'choice' => serialize($request->choice),
        ]);
        $instance->save();

        return $instance;
    }


    public function type()
    {
        return $this->hasOne(SurveyQuestionTypeModel::class, 'id', 'type_id');
    }
}