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
        // $student = json_decode('{"lastfirst":"Fabela, Phoebe Arian","first_name":"Phoebe","middle_name":"Arian","last_name":"Fabela","student_number":60013447,"entrydate":"08/14/2014","exitdate":"05/23/2015","gender":"F","current_school":"South Elementary School","dob":"06/11/2008","street":"375 S 1000 W","city":"Cedar City","state":"UT","zip":"84720","next_school":"South Elementary School","enrollment_school":"South Elementary School","father":"","mother":"Behunin, Jennifer","grade":1,"ethnicity":"C","home_phone":"435-267-2381"}');
        // $responses = json_decode('[{"form":{"id":396527,"title":"IEP: SpEd 05E v.150501","description":"Statement Regarding Participation in Extracurricular Activities","type":"P"},"response":[{"field":"other-participant","type":"text","response":"Other Participant"},{"field":"date","type":"text","response":"11/05/2015"},{"field":"factors","type":"checkbox","response":"Participation in extracurricular activities|1, No accommodations needed|2, Participation addressed in IEP Addendum|3"},{"field":"attendance","type":"checkbox","response":"|Attendance"},{"field":"behavior","type":"checkbox","response":"|Behavior"},{"field":"participation","type":"checkbox","response":"|Participation"},{"field":"social-skills","type":"checkbox","response":"|Social Skills"},{"field":"other","type":"checkbox","response":"|Other"},{"field":"other-text","type":"text","response":"Other Area of accountability"},{"field":"attendance-criteria","type":"paragraph","response":"Attendance participation criteria."},{"field":"behavior-criteria","type":"paragraph","response":"Behavior participation criteria."},{"field":"participation-criteria","type":"paragraph","response":"Participation participation criteria."},{"field":"social-skills-criteria","type":"paragraph","response":"Socail skills participation criteria."},{"field":"other-criteria","type":"paragraph","response":"Other participation criteria."},{"field":"anecdotal-comments","type":"paragraph","response":"Adecdotal comments. Adecdotal comments.Adecdotal comments.Adecdotal comments.Adecdotal comments.Adecdotal comments.Adecdotal comments.Adecdotal comments.Adecdotal comments.Adecdotal comments.Adecdotal comments.Adecdotal comments.Adecdotal comments."},{"field":"parent","type":"text","response":"Mommy"},{"field":"student-participant","type":"text","response":"Student"},{"field":"reged-teacher","type":"text","response":"Regular Education Teacher"},{"field":"sped-teacher","type":"text","response":"Special Education Teacher"},{"field":"lea-rep","type":"text","response":"LEA Representative"}]}]');
        //
        // $info = $this->dispatch(
        //     new FillPdfCommand($student, $responses)
        // );
        //
        // return $info;

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
