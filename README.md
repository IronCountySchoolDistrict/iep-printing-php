# iep-printing-php
iep-printing-php is the server side part of the [iep-printing](https://github.com/IronCountySchoolDistrict/iep-printing) project. This application uses the pdftk toolkit to fill out pdf files for printing with data collected with the PowerSchool plugin `FormBuilder`.

## Installation
Make sure you have composer installed on your machine. Clone the repository. Run `composer install` in the root folder to install laravel and other dependency packages. Take a look at the [laravel documentation](http://laravel.com/docs/5.0) for specifics on the laravel framework.

Run `composer update` on subsequent updates.

## Configuration
Directories within the `storage` and the `bootstrap/cache` directories should be writable by your web server.

Where the fillable pdf files reside can be configured in `app/iep.php`. The value is defaulted to `storage/forms` directory.

## Usage
Each form in your FormBuilder plugin must have a corresponding `View` that contains the logic for filling out the pdf file with the FormBuilder data correctly. These `View` files make use of the blade template engine commonplace in laravel. The `View` file must be named the same as the title of FormBuilder form excluding the `.` character. All `View` files must be in `resources/views/iep/forms`. An example filename could be `SpEd 05-1 v1.blade.php`.

Here is an example of what you might find in one of these files that takes advantage of blade.

```php
@foreach ($responses->response as $response)
  @include('iep._partials.text')
@endforeach

@include('iep._partials.addStudent')
```

In this instance the pdf file only is expecting text field data so it uses a partial template called text which contains reusable logic for filling out a text field in a pdf with the response data. Here is the same file without using blade.

```php
<?php foreach($responses->response as $response): ?>
  <?php echo $__env->make('iep._partials.text', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endforeach; ?>

<?php echo $__env->make('iep._partials.addStudent', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
```
