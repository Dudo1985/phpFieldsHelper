<?php

class phpFieldsHelper {

    /**
     * Default class
     *
     * @var string
     */
    public $field_class;

    public function __construct($field_class=false) {
        if($field_class) {
            $this->field_class = htmlspecialchars($field_class);
        }
    }

    /**
     * @param bool|string $class
     * @param bool|string|int $label
     * @param bool|string|int $name
     * @param bool|string|int $id
     * @param bool|string|int $placeholder
     * @param bool|string|int $default_value
     *
     * @return string
     */
    public function input($class=false, $label=false, $name=false, $id=false, $placeholder=false, $default_value=false) {
        $attribute = $this->escape_attributes($class, $label, $name, $id, $placeholder, $default_value);

        $container     = "<div class='$attribute[class]'>";
        $label_string  = "<label for='$attribute[id]'>$attribute[label]</label>";
        $input_text    = "<input type='text' name='$attribute[name]' id='$attribute[id]' value='$attribute[value]'
                            placeholder='$attribute[placeholder]'>";
        $end_container = "</div>";

        return($container.$label_string.$input_text.$end_container);
    }

    /**
     * @param bool|string $class
     * @param bool|string|int $label
     * @param array $options
     * @param bool|string|int $name
     * @param bool|string|int $id
     * @param bool|string|int $default_value
     *
     * @return string
     */
    public function select($class=false, $label=false, $options=[], $name=false, $id=false, $default_value=false) {
        $attribute = $this->escape_attributes($class, $label, $name, $id, $default_value);
        $select_options = $this->escape_array($options);

        $container     = "<div class='$attribute[class]'>";
        $label_string  = "<label for='$attribute[id]'>$attribute[label]</label>";
        $select        = "<select name='$attribute[name]' id='$attribute[id]'>";
        $end_select    = "</select>";
        $end_container = "</div>";

        foreach ($select_options as $key=>$option) {
            if($option === $attribute['value']) {
                $select .= "<option value='$key' selected>$option</option>";
            } else {
                $select .= "<option value='$key'>$option</option>";
            }
        }

        return($container.$label_string.$select.$end_select.$end_container);
    }

    /**
     * @param bool|string $class
     * @param bool|string|int $label
     * @param bool|string|int $name
     * @param bool|string|int $id
     * @param bool|string|int $placeholder
     * @param bool|string|int $default_value
     *
     * @return string
     */
    public function textArea($class=false, $label=false, $name=false, $id=false, $placeholder=false, $default_value=false) {
        $attribute = $this->escape_attributes($class, $label, $name, $id, $default_value, $placeholder);

        $container     = "<div class='$attribute[class]'>";
        $label_string  = "<label for='$attribute[id]'>$attribute[label]</label>";
        $textarea      = "<textarea name='$attribute[name]' id='$attribute[id]' placeholder='$attribute[placeholder]'>";
        $end_textarea  = "</textarea>";
        $end_container = "</div>";



        return($container.$label_string.$textarea.$attribute['value'].$end_textarea.$end_container);
    }


    /**
     * @param bool|string $class
     * @param bool|string|int $label
     * @param bool|string|int $name
     * @param bool|string|int $id
     * @param bool|string|int $placeholder
     * @param bool|string|int $default_value
     *
     * @return array
     */
    private function escape_attributes($class=false, $label=false, $name=false, $id=false, $default_value=false, $placeholder=false ) {
        //Use the $this->field_class attribute if $class is false or empty
        if(!$class && $this->field_class) {
            $class = $this->field_class;
        }

        //Use a random string (uniqueid and str_shuffle to add randomness) if id is not set
        if(!$id) {
            $id = str_shuffle(uniqid('', true));
        }

        return array(
            'class'       => htmlspecialchars($class,         ENT_QUOTES),
            'id'          => htmlspecialchars($id,            ENT_QUOTES),
            'label'       => htmlspecialchars($label,         ENT_QUOTES),
            'name'        => htmlspecialchars($name,          ENT_QUOTES),
            'placeholder' => htmlspecialchars($placeholder,   ENT_QUOTES),
            'value'       => htmlspecialchars($default_value, ENT_QUOTES),
        );
    }

    private function escape_array($array=[]) {
        $cleaned_array = [];
        if(!is_array($array)) {
            return $cleaned_array;
        }

        foreach ($array as $key=>$value) {
            $key = htmlspecialchars($key, ENT_QUOTES);
            $cleaned_array[$key] = htmlspecialchars($value, ENT_QUOTES);
        }

        return $cleaned_array;
    }

}