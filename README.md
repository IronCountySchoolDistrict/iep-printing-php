# iep-printing-php
iep-printing-php is the server side part of the [iep-printing](https://github.com/IronCountySchoolDistrict/iep-printing) project. This application uses the pdftk toolkit to fill out pdf files for printing with data collected with the PowerSchool plugin `FormBuilder`.

## Installation
Make sure you have composer installed on your machine. Clone the repository. Run `composer install` in the root folder to install laravel and other dependency packages. Take a look at the [laravel documentation](http://laravel.com/docs/5.0) for specifics on the laravel framework.

Run `composer update` on subsequent updates.

## Configuration
Directories within the `storage` and the `bootstrap/cache` directories should be writable by your web server.

Where the fillable pdf files reside can be configured in `app/iep.php`. The value is defaulted to `storage/forms` directory.

## php-pdftk
Pdftk-php is a php wrapper to the pdftk server toolkit which is what is used to handle all the pdf files. See the [original repo](https://github.com/mikehaertl/php-pdftk) on some of its usage. iep-printing-php extends the class to include the `$fields` property on the object, which is generated from fdf data after the pdf file is loaded.

### Setting fields
Set all the fields at once.

```php
$array = [
  'name' => 'John Smith',
  'dob' => 'Jan 1, 1972'
];

$pdf->setFields($array);

// or

$pdf->fields = $array;
```

Set a single field

```php
$pdf->setField($key, $value);

// or

$pdf->fields[$key] = $value;
```

## How to create logic to fill out a form
This is an example object of what you can expect. This will be json_decode()ed into a standard php class and thats how you can use it.

```json
[
  {
    "form": {
      "id": 123456,
      "title": "IEP: SpEd 05-1  v.150501",
      "description": "PLAFFP",
      "type": "P"
    },
    "response": [
      {
        "field": "iep-meeting",
        "type": "text",
        "response": "01/02/2003"
      },
      {
        "field": "classification",
        "type": "dropdown",
        "response": "Hearing Impariment/Deafness"
      }
    ]
  },
  ...
]
```

The pdf files must be named after the form->title without `IEP:`. In this case iep-printing-php will look for the pdf file named `SpEd 05-1 v.150501.pdf` wherever your forms are stored.

### Blade templates (where the magic happens)
iep-printing-php uses the [laravel's blade templates](http://laravel.com/docs/5.0/templates), not for html, but for creating dynamic scripts by including reusable logic easily.

#### Template naming convention
Create a file in `resources/views/iep/forms` named the form title with `IEP:` and all `.` characters stripped out with the extension `blade.php`. Continuing our example we would name this file `SpEd 05-1 v150501.blade.php`.

#### Using the response object
Your template for handling the logic will be passed the `$pdf` for setting the fields and the `$responses` which is everthing with the response key of the above json object.

##### looping

```php
@foreach ($response->response as $response)
  <?php $pdf->setField($response->field, $response->response); ?>
@endforeach
```

##### including templates

```php
@foreach ($response->response as $response)
  @if ($response->type == 'checkbox')
    @include('iep._partials.checkbox', ['checked' => 'Yes'])
  @else
    @include('iep._partials.text')
  @endif
@endforeach
```

In this script, it is looking for field types of the type checkbox, then including the checkbox template to handle filling out that the field. Otherwise it assumes its a text field and includes that partial template to handle those.

The checkbox file may look something like this.

```php
<?php

if (!isset($checked)) $checked = 'Yes';

$values = preg_split("/,\s(?<=\|\d,\s)/", $response->response);
$key = $response->field;

foreach ($values as $checkbox) {
    if (isset($pdf->fields[$key.':'.$checkbox])) {
        $pdf->fields[$key.':'.$checkbox] = $checked;
    }
}

?>
```

Case in point. Do what you gotta do to get the pdf file filled out!
