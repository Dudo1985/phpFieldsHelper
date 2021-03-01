<?php
/*

Copyright 2020 Dario Curvino (email : d.curvino@tiscali.it)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php

require_once 'phpFieldsHelper.php';

//initialize the class
$input = new phpFieldsHelper('input-container');

//a default value for Last Name (e.g. a value from a DB)
$last_name = 'Doe';

//Array key is the <option> value attribute, array value is the text
$select_array = [
    'it_IT'     => 'Italian',
    'en_GB'     => 'English (UK)',
    'de_DE'     => 'Deutsch',
    'es_ES'     => 'Español'
];

//Array key is the <radio> value attribute, array value is the text
$radio_array = [
    'small'     => 'Small',
    'medium'    => 'Medium',
    'large'     => 'Large',
];

//Just a text
$textarea_text = ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ornare quam quis erat faucibus porttitor. 
Proin erat orci, sagittis eu placerat vitae, condimentum ac lectus. Phasellus pulvinar lectus eu sem auctor aliquam. 
Proin in viverra urna, ut sollicitudin lorem. Donec pretium elit et metus faucibus mattis. Proin sollicitudin sapien sit 
amet nisi commodo iaculis. In hac habitasse platea dictumst. Sed fermentum purus id turpis ultricies, eget sollicitudin 
lacus interdum. Cras volutpat molestie congue. Mauris imperdiet volutpat urna et viverra.';

//Print a text field
echo phpFieldsHelper::text(
    false,                      //div class
    'First Name',               //label
    'first_name',              //name
    'first_name',                 //id
    'What\'s your name?', //placeholder
    ''                  //value
);

//Print another text field
echo phpFieldsHelper::text(
    false,         //div class
    'Last Name',   //label
    'last_name',  //name
    'last_name',     //id
    '',      //placeholder
    $last_name           //value
);

echo '<br />';

//Print radio block with values find into $radio_array
echo phpFieldsHelper::radio(
    'Select Size',     //Title
    false,            //single radio class
    $radio_array,           //array with values
    false,           //radio name
    'medium', //default value
    ''                  //id
);

//Print select block with values find into $select_array
echo phpFieldsHelper::select(
    false,                  //div class
    'Language',             //label
    $select_array,                //array with values that will popoplate select
    'language',            //select name
    'language',               //select language
    'English (UK)'  //select default value
);

//Print the textArea block with text find into $textarea_text
echo phpFieldsHelper::textArea(
    'custom-textarea',     //div class
    'label',               //label
    '',                   //textarea name
    '',                      //textarea id
    $textarea_text,              //placeholder
    '',              //default text to appear into the textarea
    'on'
);

?>

</body>
</html>