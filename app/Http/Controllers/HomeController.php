<?php namespace App\Http\Controllers;

use Request;
use Response;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use mikehaertl\pdftk\Pdf;
use mikehaertl\pdftk\FdfFile;

class HomeController extends Controller {

    public function index()
    {
        if (Request::isMethod('get')) {
            return 'Hi!';
        } else if (Request::isMethod('post')) {
            $responses = json_decode(Request::input('responses'));

            $pdfFiles = [];
            foreach ($responses as $response) {
                $file = storage_path() . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . $response->form->title . '.pdf';
                if (file_exists($file)) {
                    $pdf = new Pdf($file);

                    $fillForm = [];
                    foreach ($response->response as $formFields) {
                        $fillForm[$formFields->title] = $formFields->response;
                    }

                    $pdf->fillForm($fillForm)
                        ->flatten()
                        ->needAppearances()
                        ->saveAs(); // TODO: save as what? can we get the temp location?
                }
            }

            // TODO: zip if $pdfFiles length > 1

            // TODO: move files to a location where we can give a link to it (not temp_dir)

            return Response::json($pdf->getDataFields());
        }
    }

}