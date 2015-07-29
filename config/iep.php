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
    'name' => env('IEP_DISTRICT_NAME', ''),
    'street' => env('IEP_DISTRICT_STREET', ''),
    'city' => env('IEP_DISTRICT_CITY', ''),
    'state'=> env('IEP_DISTRICT_STATE', ''),
    'zip' => env('IEP_DISTRICT_ZIP', ''),
    'phone' => env('IEP_DISTRICT_PHONE', ''),
    'fax' => env('IEP_DISTRICT_FAX', '')
  ],
  'forms_storage_path' => env('IEP_FORMS_STORAGE_PATH', storage_path() . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR),
  'blanks_storage_path' => env('IEP_BLANKS_STORAGE_PATH', storage_path() . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR),
  'draft_watermark' => env('IEP_DRAFT_WATERMARK', storage_path() . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'watermarks' . DIRECTORY_SEPARATOR . 'draft.pdf'),
  'copy_watermark' => env('IEP_COPY_WATERMARK', storage_path() . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'watermarks' . DIRECTORY_SEPARATOR . 'copy.pdf'),
];
