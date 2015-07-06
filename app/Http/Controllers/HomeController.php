<?php namespace App\Http\Controllers;

use Request;
use App\Iep\Pdf;
use App\Iep\Student;
use App\Commands\FillPdfCommand;
use App\Commands\AssemblePdfCommand;
use App\Http\Controllers\Controller;
use App\Commands\GetBlankPdfListCommand;
use Illuminate\Foundation\Bus\DispatchesCommands;

class HomeController extends Controller {

    use DispatchesCommands;

    public function index()
    {
        $student = json_decode('{"lastfirst":"Fabela, Phoebe Arian","first_name":"Phoebe","middle_name":"Arian","last_name":"Fabela","student_number":60013447,"entrydate":"08/14/2014","exitdate":"05/23/2015","gender":"F","current_school":"South Elementary School","dob":"06/11/2008","street":"375 S 1000 W","city":"Cedar City","state":"UT","zip":"84720","next_school":"South Elementary School","enrollment_school":"South Elementary School","father":"","mother":"Behunin, Jennifer","grade":1,"ethnicity":"C","home_phone":"435-267-2381"}');
        $responses = json_decode('[{"form":{"id":396736,"title":"IEP: SpEd 7b","description":"Written Prior Notice and Consent for Change of Placement in Special Education","type":"P"},"response":[{"field":"placement-effective-date","type":"text","response":"01/02/2003"},{"field":"placement","type":"checkbox","response":"Regular Class with part-time and/or itinerant special education services|1, Special Class|2, Special school|3, Home instruction|4, Hospital/Institutional|5, No longer eligible for services due to Graduation with a high school diploma|6, No longer eligible for services due to Reaching maximum age of eligibility, 22 years|7"},{"field":"this-option-was-selected","type":"radio","response":"OtherUtherAtherEtherItherYther"},{"field":"date","type":"hidden","response":"6/16/15"},{"field":"upon-exiting-the-lea","type":"checkbox","response":"Yes"},{"field":"attach-copy","type":"checkbox","response":"Yes, No"}]}]');

        $info = $this->dispatch(
            new FillPdfCommand($student, $responses)
        );

        return $info;

        if (Request::isMethod('get')) {
            if (Request::has('slugify')) {
                return str_slug(Request::input('slugify'));
            }

            return 'Hi!';
        } else if (Request::isMethod('post')) {
            $action = Request::input('action');
            $info = $this->{$action}();

            return response()->json($info);
        }
    }

    /**
     * dispatches command to get a list of blank printable forms
     *
     * @return array
     */
    protected function getBlanks() {
        $forms = json_decode(Request::input('forms'));

        return $this->dispatch(
            new GetBlankPdfListCommand($forms)
        );
    }

    /**
     * dispatches command to assemble blank pdfs to zip and download
     *
     * @return array
     */
    protected function printBlanks() {
        $forms = json_decode(Request::input('forms'));

        return $this->dispatch(
            new AssemblePdfCommand($forms)
        );
    }

    /**
     * dispatches command that fills pdf files and zips them for download
     *
     * @return array
     */
    protected function printFillForm() {
        $student = json_decode(Request::input('student'));
        $responses = json_decode(Request::input('responses'));

        return $this->dispatch(
            new FillPdfCommand($student, $responses)
        );
    }

}
