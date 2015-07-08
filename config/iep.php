<?php

return [

  /*
	|--------------------------------------------------------------------------
	| Forms storage path
	|--------------------------------------------------------------------------
	|
	| This is where you will specifiy where the IEP forms are located on your
	| server. This can be generated using laravel's helper functions or
	| hardcoded full path to the folder containing the forms.
	|
	*/

  'district' => [
    'name' => 'Iron County School District',
    'street' => '2077 W. Royal Hunte Dr.',
    'city' => 'Cedar City',
    'state'=> 'Utah',
    'zip' => '84720',
    'phone' => '435-586-2804',
    'fax' => '435-586-2815'
  ],
  'forms_storage_path' => storage_path() . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR,
  'blanks_storage_path' => storage_path() . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR,
];
