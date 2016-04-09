<?php

//phpinfo();

$xml = '<form-template><fields>
	<field type="textarea" name="textarea-1460034136031" label="Text Area" class="form-control text-area"></field>
		<field subtype="text" type="text" name="text-1460034137447" label="Text Field" class="form-control text-input"></field>
	</fields>
</form-template>';

echo "<textarea>", $xml, "</textarea>";

$xml = simplexml_load_string($xml);

echo "<pre>";

foreach ($xml->fields->field as $record) {
    $array = (array)$record;
    $record = current($array);

    print_r($record);
}

