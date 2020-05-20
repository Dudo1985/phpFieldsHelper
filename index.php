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

$inputs = new phpFieldsHelper('input-container');

//a default value for Last Name (e.g. a value from a DB)
$last_name = 'Doe';

$lan_array = [
    'it_IT'     => 'Italian',
    'en_GB'     => 'English (UK)',
    'de_DE'     => 'Deutsch',
    'es_ES'     => 'Español'
];

$textarea_text = ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ornare quam quis erat faucibus porttitor. 
Proin erat orci, sagittis eu placerat vitae, condimentum ac lectus. Phasellus pulvinar lectus eu sem auctor aliquam. 
Proin in viverra urna, ut sollicitudin lorem. Donec pretium elit et metus faucibus mattis. Proin sollicitudin sapien sit 
amet nisi commodo iaculis. In hac habitasse platea dictumst. Sed fermentum purus id turpis ultricies, eget sollicitudin 
lacus interdum. Cras volutpat molestie congue. Mauris imperdiet volutpat urna et viverra.';

echo $inputs->input(false, 'First Name', 'first_name', 'first_name', 'What\'s your name?');
echo $inputs->input(false, 'Last Name',  'last_name',  'last_name',  '', $last_name);

echo $inputs->select(false, 'Language', $lan_array, 'language', 'language', 'English (UK)');


echo $inputs->textArea('custom-textarea', 'label', '', '', $textarea_text);


echo $end_container = '</div>';

?>

</body>
</html>