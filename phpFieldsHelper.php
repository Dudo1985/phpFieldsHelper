<?php

if (!class_exists('PhpFieldsHelper') ) {

    class phpFieldsHelper {
        /**
         * Default class for container div
         *
         * @param string
         */
        public static $field_class;

        public function __construct($field_class = false) {
            if ($field_class) {
                self::$field_class = htmlspecialchars($field_class);
            }
        }

        /**
         * This method will return a container <div> with radio fields,
         * e.g.
         *  ```<div><label><input type="radio"><input type="radio"></div>```
         *
         * @author Dario Curvino
         *
         * All params are optional
         * @param bool|string     $title             title for radio group
         * @param bool|string     $class             class for radio field
         * @param array           $options           Array with all radio fields
         *                                           radio value is the key
         * @param bool|string     $name              name attribute for radio
         * @param bool|string|int $default_value     default selected value
         * @param bool|string     $id                prefix for id attribute
         * @param string          $autocomplete

         *
         * @return string
         */

        public static function radio(
            $title = false, $class = false, $options = [], $name = false, $default_value = false, $id = false,
            $autocomplete = 'off'
        ) {

            $attribute     = self::escape_attributes($class, $title, $name, $id, $default_value);
            $radio_options = self::escape_array($options);

            $title_string = '';

            if ($attribute['title']) {
                $title_string .= '<strong>' . $attribute['title'] . '</strong><br />';
            }

            $radio_fields = '';
            if (is_array($radio_options)) {

                foreach ($radio_options as $value => $radio_label) {
                    $id_string = $attribute['id'] . '-' . strtolower(trim(str_replace(' ', '', $value)));
                    //must be inside foreach, or when loop arrive to last element
                    //checked is defined
                    $checked = '';

                    //escape_attributes use htmlspecialchars that always return a string, so control must be weak
                    /** @noinspection TypeUnsafeComparisonInspection */
                    if ($attribute['value'] == $value) {
                        $checked = 'checked';
                    }

                    //string value must be empty
                    if ($value === 0) {
                        $value = '';
                    }

                    $radio_fields .= sprintf(
                '<div>
                            <label for="%s">
                                <input type="radio"
                                    name="%s"
                                    value="%s"
                                    class="%s"
                                    id="%s"
                                    autocomplete="%s"
                                    %s
                                >
                                %s
                            </label>
                        </div>',
                        $id_string, $attribute['name'], $value, $attribute['class'], $id_string, $autocomplete,
                        $checked, ucfirst($radio_label)
                    );

                } //end foreach
                return $title_string . $radio_fields;
            }
            return false;
        }

        /***
         * This method will return a container <div> with a text field,
         * e.g.
         *  ```<div><label><input type="text"></div>```
         *
         * @author Dario Curvino
         *
         * All params are optional
         *
         * @param bool|string     $class          div class
         * @param bool|string|int $label          label text
         * @param bool|string|int $name           name attribute for input field
         * @param bool|string|int $id             attribute id   for input field
         * @param bool|string|int $placeholder    attribute placeholder for input field
         * @param bool|string|int $default_value  attribute value for input field
         * @param string          $autocomplete
         *
         * @return string
         */
        public static function text(
            $class = false, $label = false, $name = false, $id = false, $placeholder = false, $default_value = false,
            $autocomplete='off'
        ) {
            $attribute = self::escape_attributes($class, $label, $name, $id, $default_value, $placeholder);

            $container     = "<div class='$attribute[class]'>";
            $label_string  = "<label for='$attribute[id]'>$attribute[label]</label>";
            $input_text    = "<input type='text' name='$attribute[name]' id='$attribute[id]' value='$attribute[value]'
                            placeholder='$attribute[placeholder]' autocomplete='$autocomplete'>";
            $end_container = "</div>";

            return ($container . $label_string . $input_text . $end_container);
        }

        /***
         * This method will return a container <div> with a select
         * e.g.
         *  ```<div><label><select></select></div>```
         *
         * @author Dario Curvino
         *
         * All params are optional
         *
         * @param bool|string     $class             div class
         * @param bool|string|int $label             label text
         * @param array           $options           Array with options to print into the select
         *                                           option value is the key
         * @param bool|string|int $name              name attribute for select
         * @param bool|string|int $id                id attribute for select
         * @param bool|string|int $default_value     default value to show
         * @param string          $autocomplete
         *
         * @return string
         */
        public static function select(
            $class = false, $label = false, $options = [], $name = false, $id = false, $default_value = false,
            $autocomplete = 'off'
        ) {
            $attribute      = self::escape_attributes($class, $label, $name, $id, $default_value);
            $select_options = self::escape_array($options);

            $container     = "<div class='$attribute[class]'>";
            $label_string  = "<label for='$attribute[id]'>$attribute[label]</label>";
            $select        = "<select name='$attribute[name]' id='$attribute[id]' autocomplete=$autocomplete>";
            $end_select    = "</select>";
            $end_container = "</div>";

            foreach ($select_options as $key => $option) {
                if ($option === $attribute['value']) {
                    $select .= "<option value='$key' selected>$option</option>";
                }
                else {
                    $select .= "<option value='$key'>$option</option>";
                }
            }

            return ($container . $label_string . $select . $end_select . $end_container);
        }

         /***
         * This method will return a container <div> with a textarea
         * e.g.
         *  ```<div><label><textarea></textarea></div>```
         *
         * @author Dario Curvino
         *
         * All params are optional
         * @param bool|string     $class            div class
         * @param bool|string|int $label            label text
         * @param bool|string|int $name             name attribute for textarea
         * @param bool|string|int $id               id attribute for textarea
         * @param bool|string|int $placeholder      textarea placeholder
         * @param bool|string|int $default_value    default text to appear into the textarea
         * @param string          $autocomplete
         *
         * @return string
         */
        public static function textArea(
            $class = false, $label = false, $name = false, $id = false, $placeholder = false, $default_value = false,
            $autocomplete = 'off'
        ) {
            $attribute = self::escape_attributes($class, $label, $name, $id, $default_value, $placeholder);

            $container     = "<div class='$attribute[class]'>";
            $label_string  = "<label for='$attribute[id]'>$attribute[label]</label>";
            $textarea      = "<textarea name='$attribute[name]' 
                                id='$attribute[id]' 
                                placeholder='$attribute[placeholder]'
                                autocomplete=$autocomplete>";
            $end_textarea  = "</textarea>";
            $end_container = "</div>";

            return ($container . $label_string . $textarea . $attribute['value'] . $end_textarea . $end_container);
        }


        /**
         * @param bool|string     $class
         * @param bool|string|int $label
         * @param bool|string|int $name
         * @param bool|string|int $id
         * @param bool|string|int $default_value
         * @param bool|string|int $placeholder
         * @param string          $autocomplete
         *
         * @return array
         */
        private static function escape_attributes(
            $class = false, $label = false, $name = false, $id = false, $default_value = false, $placeholder = false,
            $autocomplete = 'off'
        ) {

            $dbt    = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
            $caller = isset($dbt[1]['function']) ? $dbt[1]['function'] : null;

            //default value
            $title_or_label = 'label';

            if ($caller === 'radio') {
                $title_or_label = 'title';
                if (!$name) {
                    $name = 'radio_group';
                }
            }

            //Use the self::field_class attribute if $class is false or empty
            if (!$class && self::$field_class) {
                $class = self::$field_class;
            }

            //if id is not set but name is, id get same value as name
            if (!$id && $name) {
                $id = $name;
            }
            //viceversa
            elseif (!$name && $id) {
                $name = $id;
            }

            //Use a random string (uniqueid and str_shuffle to add randomness) if id is still empty
            if (!$id) {
                $id = str_shuffle(uniqid());
            }

            if($autocomplete !== 'on') {
                $autocomplete = 'off';
            }

            return array(
                'class'         => htmlspecialchars($class, ENT_QUOTES),
                'id'            => htmlspecialchars($id, ENT_QUOTES),
                $title_or_label => htmlspecialchars($label, ENT_QUOTES),
                'name'          => htmlspecialchars($name, ENT_QUOTES),
                'placeholder'   => htmlspecialchars($placeholder, ENT_QUOTES),
                'value'         => htmlspecialchars($default_value, ENT_QUOTES),
                'autocomplete'  => $autocomplete,
            );
        }

        private static function escape_array($array = []) {
            $cleaned_array = [];
            if (!is_array($array)) {
                return $cleaned_array;
            }

            foreach ($array as $key => $value) {
                $key                 = htmlspecialchars($key, ENT_QUOTES);
                $cleaned_array[$key] = htmlspecialchars($value, ENT_QUOTES);
            }

            return $cleaned_array;
        }

    }

}
