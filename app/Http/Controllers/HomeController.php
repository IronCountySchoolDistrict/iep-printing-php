<?php namespace App\Http\Controllers;

use Request;
use App\Iep\Pdf;
use App\Iep\Student;
use App\Commands\FillPdfCommand;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesCommands;

class HomeController extends Controller {

    use DispatchesCommands;

    public function index()
    {
        if (Request::isMethod('get')) {
            return 'Hi!';
        } else if (Request::isMethod('post')) {
            return $this->dispatch(
                new FillPdfCommand(
                    json_decode(Request::input('student')),
                    json_decode(Request::input('responses'))
                )
            );
        }
    }

}
