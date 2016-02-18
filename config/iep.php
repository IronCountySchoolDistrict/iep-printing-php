<?php

return [
	'district' => [
		'name' => env('IEP_DISTRICT_NAME', ''),
		'street' => env('IEP_DISTRICT_STREET', ''),
		'city' => env('IEP_DISTRICT_CITY', ''),
		'state'=> env('IEP_DISTRICT_STATE', ''),
		'zip' => env('IEP_DISTRICT_ZIP', ''),
		'phone' => env('IEP_DISTRICT_PHONE', ''),
		'fax' => env('IEP_DISTRICT_FAX', '')
	],
	'forms_storage_path' => str_finish(env('IEP_FORMS_STORAGE_PATH', storage_path('forms')), DIRECTORY_SEPARATOR),
	'blanks_storage_path' => str_finish(env('IEP_BLANKS_STORAGE_PATH', storage_path('forms')), DIRECTORY_SEPARATOR),
	'draft_watermark' => env('IEP_DRAFT_WATERMARK', storage_path('forms/watermarks/draft.pdf')),
	'copy_watermark' => env('IEP_COPY_WATERMARK', storage_path('forms/watermarks/copy.pdf')),
	'html_renderer_path' => env('IEP_HTML_RENDERER_PATH', ''),
	'html_renderer_zoom' => env('IEP_HTML_RENDERER_ZOOM', 1),
  'powerschool_url' => str_finish(env('POWERSCHOOL_URL', 'https://pstest.irondistrict.org/'), '/')
];
