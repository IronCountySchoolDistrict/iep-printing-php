## iep-printing-php
iep-printing-php is the PHP service, or the power, behind the [iep-printing](https://github.com/IronCountySchoolDistrict/iep-printing) PowerSchool plugin.

- [Server Stuff](#server-stuff)
    - [Setup](#server-stuff-setup)
    - [Git iep-pritning-php](#server-stuff-git)
- [Configuration](#config)
    - [Apache Config](#config-apache)
    - [PHP config](#config-php)
    - [iep-printing-php config](#config-iep)
- [Development](#dev)
    - [Vagrant & VirtualBox](#dev-vagrant)
    - [URLs](#dev-url)
    - [Request flow](#dev-flow)
    - [HTML Rendering](#dev-html)
        - [Override HTML Renderer View](#dev-html-override)
    - [PDF Rendering](#dev-pdf)
        - [Override PDF Renderer](#dev-pdf-override)
    - [gulp](#dev-gulp)
- [FormBuilder conventions](#formbuilder)
- [Database stuff](#db)
    - [IEP tables](#db-iep)
    - [FormBuilder tables](#db-formbuilder)
    - [Powerschool tables](#db-powerschool)
- [Console commands](#console)


### <a name="server-stuff">#</a> Server stuff

See how I provision the vagrant box [here](vagrant-provision.sh). It is designed to mock production so you could use it as a guide when setting up your own production server.

#### <a name="server-stuff-setup"></a> Setup

Things that you'll need to install on the server are:
- git
- alien
- pdftk
- libaio1
- apache2
    - enable `rewrite` module
- PHP 7.0 + modules:
    - php7.0-dev php7.0-mcrypt php7.0-mbstring php7.0-xml php7.0-zip libapache2-mod-php7.0
- [Oracle InstantClient 12c](http://www.oracle.com/technetwork/topics/linuxx86-64soft-092277.html) (basic and sdk/development packages)
    - use `alien -i oracle-package.rpm` to install. basic first then sdk.
- oci8
    - install by `pecl install oci8`
    - if you run pecl and get a bunch of errors do this thingy here.
        - ``` nano `which pecl` ```
        - take out the `-n` option from the last line
        - try pecl install again. you'll get some errors at the end of the install but it will have worked.
- [composer](https://getcomposer.org/download/)
    - `curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer`
- [wkhtmltopdf](http://download.gna.org/wkhtmltopdf/0.12/0.12.2.1/)
    - download the right one for your server `curl -O http://download.gna.org/wkhtmltopdf/0.12/0.12.2.1/wkhtmltox-0.12.2.1_linux-trusty-amd64.deb`
    - install via `dpkg -i --force-depends wkhtmltox-0.12.2.1_linux-trusty-amd64.deb`
    - install the dependency packages `apt-get install -f`

#### <a name="server-stuff-git"></a> Git iep-printing-php

```bash
# use git to clone this repository to your server
git clone https://github.com/IronCountySchoolDistrict/iep-printing-php.git /var/www/iep-printing-php

# go into the new directory
cd /var/www/iep-printing-php/

# install dependency packages with composer
composer install
```

### <a name="config">#</a> Configuration

#### <a name="config-apache"></a> Apache2 config

Edit the apache config file.

```bash
sudo nano /etc/apache2/sites-available/000-default.conf
```

Since requests to this service is going to originate on PowerSchool you need to enable CORS with something like this.

```
# specify the web root
DocumentRoot /var/www/iep-printing-php/public

<Directory /var/www/iep-printing-php/public>
  AllowOverride All
  Header set Access-Control-Allow-Origin "*"
  Header set Access-Control-Allow-Methods "GET,POST,HEAD,DELETE,PUT,OPTIONS"
  Header set Access-Control-Allow-Headers "Content-Type"
</Directory>
```

You could change the `*` for the `Header set Access-Control-Allow-Origin` option to the domain name of your PowerSchool instance to only allow POST requests to originate from that domain.

Also note that since PowerSchool admin is https only all requests it makes to this server will also go over https. Therefore, you'll need to enable the apache ssl module `sudo a2enmod ssl` and get a certificate for this service. Checkout valid SSL certificates with [letsencrypt](https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-14-04).

If you don't go with letsencrypt you'll need to reference your SSL certificate and key and let apache2 listen on port 443 by adding something like the following at the end of `000-default.conf`

```
<IfModule mod_ssl.c>
  <VirtualHost _default_:443>
    ...
    DocumentRoot /var/www/iep-printing-php/public
    <Directory /var/www/iep-printing-php/public>
      AllowOverride All
    </Directory>
    ...
    SSLEngine on
    SSLCertificateFile /etc/apache2/ssl/iep-printing-php.cert
    SSLCertificateKeyFile /etc/apache2/ssl/iep-printing-php.key
    ...
  </VirtualHost>
</IfModule>
```

#### <a name="config-php"></a> PHP config

Most of the modules that are needed can be installed by the package manager `apt-get`. The Module `oci8` however, that you installed via pecl, needs to be added to the `php.ini` file. You'll need to do this for both apache and cli .ini files.

Open php config for apache
```bash
sudo nano /etc/php/7.0/apache2/php.ini
```

Add the line `extension=oci8.so` toward the end of the file. I usually add it in the section where all the other modules are loaded.

Open php config for cli and do the same
```bash
sudo nano /etc/php/7.0/cli/php.ini
```

#### <a name="config-iep"></a> Iep-printing-php config

```bash
# Copy the example config to its own file.
cp .env.example .env

# Generate an app key with php artisan
# this is necesssary just for laravel to work
# though this application doesn't encrypt/decrypt any data
php artisan key:generate

# open the .env file to change values
nano .env
```

Some of the values in the .env file are unimportant. Here are the ones that you should care about.

`APP_DEBUG=true` Set to false for production  
`DB_CONNECTION=oracle` PowerSchool's database is oracle

DB connection credentials  
`ORACLE_HOST=127.0.0.1` IP/Domain of OracleDB  
`ORACLE_DATABASE=PowerSchool`  
`ORACLE_USERNAME=PowerSchoolAdmin` User with read/write permissions  
`ORACLE_PASSWORD=secret`   
`ORACLE_SERVICE_NAME=OracleServiceName`  

`IEP_DISTRICT_NAME=Smallville School District`  
`IEP_DISTRICT_STREET=123 ABC Street`  
`IEP_DISTRICT_CITY=Smallville`  
`IEP_DISTRICT_STATE=Kansas`  
`IEP_DISTRICT_ZIP=12345`  
`IEP_DISTRICT_PHONE=555-555-5555`  
`IEP_DISTRICT_FAX=555-555-5555`

These are all for override only. Remove otherwise.  
`IEP_FORMS_STORAGE_PATH=/full/path/to/override-forms`  
`IEP_BLANKS_STORAGE_PATH=/full/path/to/override-forms`  
`IEP_DRAFT_WATERMARK=/full/path/to/watermarks/draft.pdf`  
`IEP_COPY_WATERMARK=/full/path/to/watermarks/copy.pdf`   
`IEP_HTML_RENDERER_PATH=iep.html` If you are overriding html version of forms. Specify where they are in the [blade heirarchy](https://laravel.com/docs/5.1/views#basic-usage) here.  
`IEP_HTML_RENDERER_ZOOM=0.75` Changes how zoomed in the forms appear that are rendered via HTML. I've noticed that on headless systems you need to zoom out, thus 75%. If this is being hosted on a machine that has a resolution higher than 800x600 than you'll have to play with the value until it looks okay.

### <a name="dev">#</a> Development

You can work on the iep-printing-php on your own environment seperated from production using vagrant with virtualbox. Reasons why you might want to do this is that you want to override how a form renders, add new forms, test printing, change font and other styles, and new features ;)

*Note:* When I say 'for printing' I basically mean looking at the PDF file before anyone would actually send to a printer for printing.

#### <a name="dev-vagrant"></a> Vagrant & VirtualBox

To get your own version running on your machine:
- download and install [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
- download and install [Vagrant](https://www.vagrantup.com/downloads.html)
- Clone or download this repo to your machine somewhere appropriate.
- In command line tool navigate to the root of the application.
- run the command `vagrant up`
    - the first time will take a while to download the ubuntu image and provision the virtual machine.
- Open your hosts file and add this line at the bottom  
``` 192.168.10.10 iep-dev ```
- Now configure your environment by following [these](#config-iep) steps. Keep in mind that this time you're doing it for a development environment, not production.
- Visit [iep.dev](iep.dev) in your browser and Bam~! You're ready to go.

#### <a name="dev-url"></a> URLs

There are 4 groups of URLs.

##### Frame URLs

Frame URLs are all URLs that have to do with the iframe that people see in powerschool. Each one requires some parameters to work.

- `/` Index page: requires the student's frn and the user id. This page loads up the main screen that people use to view and work on IEPs.
- `/iep` Iep page: This page simply loads data for the iep you give it. It is meant to be called via ajax to load the resulting html on the index page.
- `/iep/print` Post to this url to get the pdf for selected forms for the selected IEP.
- `/iep/delete` Post to this url to delete the given IEP. Meant to only delete IEPs without any responses. Validation for this happens on the frontend.
- `/iep/activate` Post to this url to activate the given IEP. As a result will deactivate any previously active IEP.
- `/iep/print-test` Requires paramters formid (id of the form to print), title (FormBuiler title of the form to print), and responseid(the response to the form so data can be found. Can give a 0 to purposefully find no data to fill into the form). This gives back the PDF. Can add html as a parameter (no value required) and it will try to give you back the rendered HTML for a form instead of the PDF.
- `/iep/response-count` Returns the count of form builder responses associated with an IEP.

##### PowerSchool URLs

These are URLs that are being called by the powerschool side. These all happen on FormBuilder pages.

- `/iep/update` Each time a form is submitted this is called to update the IEP by associating a new FormBuilder response to the IEP, updating the start date of an IEP if it was the right form or updating the case manager if it was the right form.
- `/iep/attach` Depricated. Was used to attach a response to an IEP but that is all included in the update.

##### Legacy routes

All of the urls associated with this are depricated. Only there in cases where they have not updated the powerschool plugin.

##### Static routes

These are pages of content built for some random reason. Only consists of one at this time.

- `/learning` It is basically a webpage that has a User guide documentation on it with some screenshots.

#### <a name="dev-flow"></a> Request flow (printing)

Requests that come in for printing can have a few different paths depending on what is available for the form selected.  
There is also some required data and some optional data that is passed at the beginning of a print request.

Parameters:
- `selected` This is an json array of selected forms. The data might look something like this for each item in the array.
```json
[
    {
        "formid": "123456",
        "title": "IEP: SpEd 6a1",
        "responseid": "1234567"
    },
    ...
]
```
- `student` This is a json object that has data for a student. Within the object it is looking specifically for the student's `dcid` so that we can fetch student data from the DB.
- `fileOption` This is the option of how the user wants the results back. Can concatenate all PDFs together or put them into a zip file. If it is only 1 form being requested the result will always be a PDF.
- `watermarkOption` This will can add a watermark to every resulting PDF page. Possible values are "final" (no watermark), "copy", and "draft"

After all these parameters check out we send it all to `App\Jobs\PrintPdf` class.  
When this class gets instantiated eash selected form, and accompanying data, is turned into a `App\Iep\Response` object.  
If a blade template view exists for the given form the HTML will be rendered and then transformed into a PDF file with the watermark added if applicable.
If however, a blade template view does not exist we fall back to some legacy stuff. We send it off to the `App\Iep\Legacy\Commands\FillPdfCommand` where the PDF file is copied, data is applied to it, and the watermark added. The result is sent back to the `PrintPdf` class where its concatenated with the other forms.  
If an exception is thrown during any of this process the error is saved to a variable associated with the formid and will return along with a file if one was generated from the other forms.

What gets returned is the URL for the generated file (so it can be downloaded) and an array of errors (if there were any).

#### <a name="dev-html"></a> HTML rendering

As mentioned, some forms have been rebuilt in HTML making them much more flexible in handling different amounts of data. Examples of this is strings of data ranging from 0 characters to 4000 characters. PDFs have a defined space for input and it can't be stretched on the fly. HTML can be. So for new forms it is strongly advised that you rebuild the PDF in HTML for filling in data.

Since this is a Laravel application, we use Blade templates for the HTML. The default location for these templates are located at `resources/views/iep/html`.

When naming the file there is a convention that you must follow. Name the file in all lowercase letters and "slugify" the FormBuilder title of the form. For example `IEP: SpEd 03a` will become `iep-sped-03a`. So the name of the blade template file will be named `iep-sped-03a.blade.php`. While you have the freedom to build out the HTML however you like, you can stick with what I've been doing which is inheriting from a base HTML theme, so to speak, and building out the body.

```php
@extends('iep.layouts.default') <!-- extend the HTML layout blade template -->

@section('title', 'IEP: SpEd 03a') <!-- give an HTML <title>. generally the title of the form -->

@section('stylesheet')
    @parent

    <style>
        .form-specific-style {
            font-size: 2em;
        }
    </style>
@endsection

@section('content')
    <div>
        Recreate the form here with HTML.
    </div>
@endsection
```

This default layout includes the bootstrap framework so you can use any of its classes and markup.

Some notable classes that I've added to help building out HTML that look like forms is the `.left` and `.right`.

`.left` Use with a div and the contents will take up as much space as is needed.  
`.right` Use with a div just after using `.left` and it will take up any remaining space that `.left` didn't take up.  
I use these two classes heavily as many forms label an input like this_________________________________________.  
Adding the class `.underline` with right will give that effect. Look in any template and you'll see it's use case.

Make use of the partial templates in `resources/views/iep/html/_partials`.

- `checkbox` here is an example  
```php
@include('iep.html._partials.checkbox', ['haystack' => $responses->get('checkbox#1'), 'needle' => 'Yes'])
```  
If the string `Yes` exists in `$responses->get('checkbox#1')` then the checkbox will be checked.
- `checkmark` works the same as checkbox only it will give you a checkmark with no box around it

If you find yourself having to repeat a snippet of HTML over and over. Move it out to a new partial and just `@include('myPartial')` as many times as you need to.

#### <a name="dev-html-override"></a> Override HTML renderer view

When you get to creating these PDFs from HTML you might notice some wierd things or you may get a request to change something. Or, maybe someone wants to you to change the form completely. In this case, don't go and edit the existing one. You can create your own folder within `resources/views` to house all of your own customizations to forms. You can use it as a way to override existing blade template views and create your own.

Lets say you created a folder to house all of your custom HTML blade templates for some forms you need changed in `resources/views/iep/overrides`. Open your `.env` file and change the value for `IEP_HTML_RENDERER_PATH` to equal `iep.overrides`. When printing requests come in it will look in the overrides folder first for an HTML template to use and fall back to `iep.html` if nothing is found.

#### <a name="dev-pdf"></a> PDF rendering

PDFs by default are located in `storage/forms`. The process of getting data to fill into a PDF file is all based on conventions that you need to follow for everything to work out okay. 

When you are creating the form in FormBuilder, you need to give input fields that corespond with a field in the PDF file a CSS class that uniquely identifies it that begins with `pdf_`. An example of this could be that you have an input for someone's first name so you give it the css class `pdf_first-name`. When this application looks for data for responses to this form it will match `first-name` with the given FormBuilder input. All of this information will be accessible in the `App\Iep\Response` object. In the templates for these you can get the input response by doing `$responses->get('first-name')`. The `$responses` variable could have a lot more data to like `$responses->get('last-name')` or `$responses->get('checkgroup1')`.

When the request comes in to fill in a PDF, much like the blade templates for HTML, you'll need to create a template for filling in a PDF. Instead of HTML though, these are custom blocks of code specific to a form. Again, you need to follow another convention when naming them and note that this one is different than the HTML version. If you have a form titled `IEP: SpEd 03a` you need to strip off `IEP: ` and keep all capilizations the same. So the blade template to fill in the PDF data would be `SpEd 03a.blade.php`. All blade templates for PDFs is located in `resoureces/views/iep/forms`.

Inside a blade template, use whatever logic that needs to happen to fill in the different fields. Assuming that when you created all the fillable fields in the PDF, you named the fields the SAME name you gave in FormBuilder. So we had `pdf_first-name` we would fill in the data on the PDF form field named `first-name`. To fill this in you would need this line of code `$pdf->setField('first-name', $responses->get('first-name')`.

FormBuilder assigns a `type` to each form field you give it. It makes it simple to detect what is easily fillable in the PDF without any logic. For example if you had a PDF with only text inputs and no checkboxes you could loop over the response data and fill in the PDF like this.  
```php
@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'paragraph' || $response['type'] == 'dropdown')
    @include('iep._partials.text')
  @endif
@endforeach
```  
Here we include the partial that has the logic to fill in the PDF the `$response['value']`.

Other partials are there for your use which are
- `@include('iep._partials.checkbox')` If the `$response['type'] == 'checkbox'` include this partial. It will split the `$response['value']` and see if any of them match checkboxes in the PDF. You could also specify the regex to which it splits the `$response[value]` which may be needed sometimes like this `@include('iep._partials.checkbox', ['split' => '/,\s+/'])`.
- `@include('iep._partials.radio')` This one works exactly like the checkbox partial.

#### <a name="dev-pdf-override"></a> Override PDF renderer

The default location for all fillable PDFs is in  `storage/forms`. If you want to start overriding then you can copy them all to your own folder on your server and specify the full path to it in the `.env` file's `IEP_FORMS_STORAGE_PATH` option.

Unlike the HTML way overriding it wont fallback to the default location. It will assume that your new folder contains all the forms for the requests that might come in. Thats why I say to copy them. But if at all possible it is much simpler to do things the HTML way. Just sayin'.

#### <a name="dev-gulp"></a> Gulp

All the CSS and JS in the project is done according to the guidelines in place on [laravel's documentation for elixir](https://laravel.com/docs/5.1/elixir). Take a look to find out how to use this to add your own styles or javascript. 

### <a name="formbuilder">#</a> FormBuilder conventions

It is important these conventions be followed when creating or editing forms in FormBuilder. It will have an effect on how this application behaves.

#### Naming things

When you create an element in FormBuilder it has a few properties, CSS class being one of them. Each form element that you want to match to a field for printing needs a unique css class that is prefixed with `pdf_`. For example if you create an element in FormBuilder intended to get a persons first name then you could uniquely identify that field with the CSS class of `pdf_first-name`. Don't use spaces. Dashes are preferred seperator but you could use other characters too.

#### Checkboxes and multiselect elements

These type of elements can have more than one answer and you can only give the checkbox group a single name like `pdf_checkbox-group`. If you had this checkbox group and the options were `1`, `2`, and `3` and if all three were checked, Formbuilder saves the response value for this element as `1, 2, 3` as a string. You can call this value in a template by doing this  
```php
$responses->get('checkbox-group') // "1, 2, 3"
```  
If you wanted to check the checkbox on the blade template for a form for the value of `3` you would have to do an something like this  
```php
if (strpos($responses->get('checkbox-group'), '3') !== false) {
    // check the box
}

// or just include the blade partial template already provided to handle this
@include('iep.html._partials.checkbox', ['haystack' => $responses->get('checkbox-group'), 'needle' => '3'])
// this will give you a checked box if '3' is in checkbox-group or a box with no check if otherwise
```  
In this case everything works fine because after it splits up all the values of the response (which is an array like this `['1', '2', '3']`), sometimes the values for these checkboxes can be long sentences with commas already in them. In that case, the needle needs to be a unique subset of the full sentence.  
For example if the possible values for `pdf_checkbox-group` was `funny`, `smart, sexy`, and `attractive`, the value of the `$responses->get('checkbox-group')` would end up being `funny, smart, sexy, attractive`. When this gets past to the partial it will split it up like this `['funny', 'smart', 'sexy', 'attractive']`. So in this case the needle would either be `smart` or `sexy`.

*Note:* In FormBuilder you can add a pipe `|` character followed by text that won't show up when filling out the forms but they will show up in the `$responses`.  
*Note:* Like the checkbox element checkbox values can have a pipe `\` character followed by text. However, this pipe character doesn't get passed through in the `$responses` object.

#### Form title

IEP forms need to begin with `IEP: `. If its not, this system wont think it is an IEP form and so will leave it out. The description has no restriction.

### <a name="db"></a> Database stuff

When you install the iep-printing plugin for PowerSchool it will create the tables necessary for tracking IEPs.

Also, this IEP project relies on the PowerSchool plugin [FormBuilder] by Accela School for collecting data. Along with this plugin comes their table schemas which are used to query the data from when looking to print a form.

#### IEP tables

##### u_sped_iep

A student can have many IEPs. Student is referenced by the column `studentsdcid`. Other data kept track of by this table is the `start_date` and the `case_manager`.

##### u_sped_iep_response

Kind of a weird relationship that links IEPs with FormBuilder responses. It contains the column `u_sped_iepid` to reference `u_sped_iep` table and then `u_fb_form_response_id` to reference FormBuilder's `u_fb_form_response` table which keeps track of responses to forms and also links details about the response.

#### FormBuidler tables

##### u_fb_form

Each form created in form builder is referenced here. Important colums are `id` (id of the form. a negitive id means it is a deleted form), `form_title` (title of the form).

##### u_fb_form_response

This keeps track of which student has a response to which form. A student can have many responses for each form. A form can have many students respond to it. It contains the columns `id` the id of the response, `created_by` the name of who filled out the form and submitted, `student_id` the ID of the student, `u_fb_form_id` the id of the form submitted.

#### PowerSchool tables

##### student

Has most of the data for a student.

##### School

Used to know which school a student is attending.

##### StudentCoreField

Has some extra columns used to autofill in some form fields.

### <a name="console"></a> Console commands

There is only one console command created for this project.

Upon first installing the iep-printing plugin to PowerSchool, if there are responses to IEP forms that are need to be included in an IEP run the artisan command `php artisan iep:create --all`. This will create an IEP for any student that has a response to an IEP form and then associate the latest response for each form they have a response to. This command is only meant to be ran once if at all. If you run it again it will create another IEP on top of what was already created and the result will be duplicated.

If somehow, a single student has responses to IEP forms but there is no IEP and there are no associated responses, you can run that same command specifying that particular student's DCID. `php artisan iep:create 12345` This will create essentially do the same thing as running this command with the `--all` option but it will only execute for the specified student.