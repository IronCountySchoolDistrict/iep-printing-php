# iep-printing-php
iep-printing-php is the server side part of the [iep-printing](https://github.com/IronCountySchoolDistrict/iep-printing) project. This application uses the pdftk toolkit to fill out pdf files for printing with data collected with the PowerSchool plugin `FormBuilder`.

## Installation
### Server requirements
- See [laravel requirements](http://laravel.com/docs/5.0#server-requirements)
- [Composer](https://getcomposer.org/)
- [pdftk](https://www.pdflabs.com/tools/pdftk-server/)
- [zip](http://manpages.ubuntu.com/manpages/raring/man1/zip.1.html)
- [beanstalkd](http://kr.github.io/beanstalkd/) (Optional)

### Setup
- Run `git clone` on this repository
- Run `composer install` in the root of the cloned repository
- Run `composer update` on subsequent pulls

### Configuration
Directories within the `storage` and the `bootstrap/cache` directories should be writable by your web server as well as the `public` directory.

Where the fillable pdf files reside can be configured in `app/iep.php`. The value is defaulted to `storage/forms` directory.

By default, iep-printing-php is set up to keep all pdf and zip files it generates. You can either create a cron job that deletes these files in the public folder or change the default driver in `app/queue.php` from null to beanstalkd. By running `php artisan queue:listen` this will delete the files 10 minutes after they are generated.

### Running the queue as a system service
Create a file `/etc/init/queue.conf` with these contents and replacing paths as necessary

```
description "iep-printing-php file management queue listener"
start on filesystem
stop on runlevel [!2345]
respawn
respawn limit 5 2
script
exec php /var/www/iep-printing-php/artisan queue:listen
end script
```

The service will start automatically on reboot. Start and stop like any other service e.g.

```shell
service start queue
service status queue
service stop queue
```

## php-pdftk
php-pdftk is a php wrapper to the pdftk server toolkit which is what is used to handle all the pdf files. See the [original repo](https://github.com/mikehaertl/php-pdftk) on some of its usage. iep-printing-php extends the class to include the `$fields` property on the object, which is generated from fdf data after the pdf file is loaded.

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

**!Important**: Note that the response->field value is the Custom Css Class set in FormBuilder in Powerschool. This is how you will create logic that will actually be able to match fields in FormBuilder to fields in it's corresponding pdf.

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
