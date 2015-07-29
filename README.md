# iep-printing-php
iep-printing-php is the server side part of the [iep-printing](https://github.com/IronCountySchoolDistrict/iep-printing) project. This application uses the [pdftk](https://github.com/mikehaertl/php-pdftk) toolkit to fill out pdf files for printing with data collected from the PowerSchool plugin [Form Builder](http://www.accelaschool.com/formbuilder).

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
- `storage`, `bootstrap/cache`, and the `public` directories all need to be writable by your web server.
- Copy/rename `.env.example` to `.env` located in the project root. Change these values to match your environment. The important ones to make sure you set are `IEP_DISTIRCT_NAME, IEP_DISTRICT_CITY, IEP_FORMS_STORAGE_PATH, IEP_BLANKS_STORAGE_PATH, IEP_DRAFT_WATERMARK, IEP_COPY_WATERMARK`.

#### Running the queue as a system service
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
start queue
status queue
stop queue
```

## Filling out PDFs

### Matching Form Builder fields with PDF fields

First you must name the fields in the PDF the same as you named them in the Form Builder form. For example, in Form Builder lets say you named a text field `pdf_student-name`. In the PDF you would name the field where that goes to `student-name`. When the field name is pulled out of form builder `pdf_` is stripped from the name.

### Form Builder field types

#### text, paragraph, dropdown, hidden

All of these fields are text based. When they get pulled from a Form Builder response, The value of that field response will be plain text. For example, if you have a Form Builder dropdown field named `pdf_student-grade` with the options `9th grade`, `10th grade`, `11th grade`, and `12th grade`, and the user selected `9th grade`, then you would simple fill out the PDF text field named `student-grade` with the value selected.

#### checkbox

Checkboxes come in groups. A checkbox group is considered to be one field in Form Builder. If multiple checkboxes are checked the value of this field value is comma separated text. For example, if there is a checkbox group named `pdf_checkbox-group1` with the options Yes, No, and Maybe, the value of this field will come out as `Yes, No, Maybe`, meaning all three checkboxes were checked.

PDF checkboxes are not grouped like this at all so the naming convention I've been following, in order to name the PDF checkbox fields, is to name these PDF checkbox fields the name of the FormBuilder field name, followed by a `:` followed by the Form Builder value. So to continue this example I would have 3 checkboxes named `checkbox-group1:Yes`, `checkbox-group1:No`, and `checkbox-group1:Maybe`.

Sometimes Form Builder will add a `|` character followed by more text. This is used by Form Builder for workflow but still comes out with the value. So the values for `pdf_checkbox-group1` could come out as `Yes|1, No|2, Maybe|3`. Therefore, you'll have to rename your PDF checkbox fields accordingly.

#### radio

Radios are nearly identical to checkboxes except that for each radio group only one option can be selected. For example, if we have a radio field named `pdf_radio-group1` with options `Yes, No, Maybe`. It will only come out as one of these option instead of two, or all three of them.

The convention I've been folowing for the PDF side of things it to convert radios into checkboxes so these fill out, on the PDF side, the same as checkboxes do. So to continue the example of they chose `Yes`. The one that gets checked on the PDF would be the checkbox named `radio-group1:Yes`.

Another important note is that radio options can also have the `|` character followed by more text. However, this is the main difference between radios and checkboxes in Form Builder, if our options were as follows `Yes|1, No|2, Maybe|3`, and the person filling out hte form chose Yes. Instead of the value being `Yes|1`, as it would have been with a checkbox, it will just be `1`. The value of the radio is everything *after* the `|` character.

### Blade templates (where the magic happens)

There is one blade template that is the "master script" for each Form Builder form. These blade template files are located in `resources/views/iep/forms/`.

#### naming convention

The blade template file must be named the same as the PDF, minus the pdf file extension, plus `blade.php`. If we have a PDF file named `SpEd 22.pdf`. Then the blade template file should be named `SpEd 22.blade.php`.

#### blade template syntax

[Laravel documentation](http://laravel.com/docs/5.0/templates) has everything you need to know about the syntax. Instead of creating html we'll be creating php scripts for filling out the PDF.

Instead of actually using the blade syntax, it is fine to open PHP tags and simply use regular PHP for the script.

```php
<?php

foreach ($responses->responses as $response) {
  if ($response['type'] == 'checkbox') {
    $values = preg_split('/,\s+/', $response['value']);
    $key = $response['field'];

    foreach ($values as $checkbox) {
    	if (isset($pdf->fields["$key:$checkbox"])) {
    		$pdf->fields["$key:$checkbox"] = $checked;
    	}
    }
  } else if ($response['type'] == 'text') {
    $pdf->setField($response['field'], $response['value']);
  }
}

?>
```

But you can levarage blade templating to include other scripts with yours so the previous script would look like this.

```php
@foreach ($responses->responses as $response)
  @if ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox')
  @elseif ($response['type'] == 'text')
    @include('iep._partials.text')
  @endif
@endforeach
```

The `iep._partials.checkbox` is a file containing logic to handle filling in checkboxes located in `resources/views/iep/_partials/checkbox.blade.php`.
