<?php namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use mikehaertl\pdftk\Pdf;
use mikehaertl\pdftk\FdfFile;

class HomeController extends Controller {

    public function index()
    {
        // $pdf = new Pdf(storage_path() . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'SpEd 05-1 pg1-fillable.pdf');

        // $values = [
        //     "Attending School" => "Value",
        //     "Classification" => "Value",
        //     "DOB" => "Value",
        //     "Eligibility Date" => "Value",
        //     "Grade" => "Value",
        //     "IEP Meeting" => "Value",
        //     "Next ReEvaluation" => "Value",
        //     "PLAAFP" => "ValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValueValue",
        //     "Primary Server" => "Value",
        //     "Student" => "Value",
        // ];

        // $pdf->fillForm($values)
        //     ->flatten()
        //     ->needAppearances()
        //     ->saveAs(storage_path() . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'filled.pdf');

        // dd($pdf);

        if (Request::isMethod('get')) {
            return 'hi';
        } else if (Request::isMethod('post')) {
            return 'hello';
        }
        
        dd(Request::all());
    }

}