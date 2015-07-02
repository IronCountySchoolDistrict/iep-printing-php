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
        $student = json_decode('{"lastfirst":"Fabela, Phoebe Arian","first_name":"Phoebe","middle_name":"Arian","last_name":"Fabela","student_number":60013447,"entrydate":"08/14/2014","exitdate":"05/23/2015","gender":"F","current_school":"South Elementary School","dob":"06/11/2008","street":"375 S 1000 W","city":"Cedar City","state":"UT","zip":"84720","next_school":"South Elementary School","enrollment_school":"South Elementary School","father":"","mother":"Behunin, Jennifer","grade":1}');
        $responses = json_decode('[{"form":{"id":316100,"title":"IEP: SpEd Preschool v.150501","description":"Referral for Evaluation for Special Education Services Preschool","type":"P"},"response":[{"field":"signature-date","type":"text","response":"05/05/2015"},{"field":"primary-home-language","type":"dropdown","response":"English/Spanish both"},{"field":"primary-language-student","type":"dropdown","response":"English"},{"field":"sensory-motor","type":"checkbox","response":"Hearing|1, Vision|2, Motor|3, Fine Motor|4, Gross Motor|5"},{"field":"self-help","type":"checkbox","response":"Toileting|1, Eating|2, Dressing|3"},{"field":"social-emotional","type":"checkbox","response":"Task Completion|1, Following Direction|2, Withdrawn|3, Acting Out|4, Peer Relationships|5"},{"field":"cognitive","type":"checkbox","response":"Attention and Memory|1, Academic Skills|2"},{"field":"communication","type":"checkbox","response":"Articulation|1, Language|2, Fluency/Stuttering|3, Voice|4, Listening/Understanding Skills|5"},{"field":"comments","type":"paragraph","response":"Comments that are very interesting to everyone involved. Referral for evaluation for special education services preschool. Special education preschool August 2011."},{"field":"other-preschool-services","type":"radio","response":"Y"},{"field":"date-of-vision-screening","type":"text","response":"05/05/2015"},{"field":"date-of-hearing-screening","type":"text","response":"05/05/2015"},{"field":"health","type":"radio","response":"Problem"},{"field":"given-medical-diagnosis","type":"radio","response":"Y"},{"field":"receiving-any-type-of-therapy","type":"radio","response":"Y"},{"field":"day-care-name","type":"text","response":"Day Care"},{"field":"if-yes-where","type":"text","response":"Over there"},{"field":"vision","type":"radio","response":"Pass"},{"field":"hearing","type":"radio","response":"Pass"},{"field":"health-comments","type":"text","response":"Got the black lung"},{"field":"medical-diagnosis-if-yes-what","type":"text","response":"Slivers"},{"field":"therapy-if-yes-what","type":"text","response":"Casual"},{"field":"day-care-address","type":"text","response":"123 Day Care Ln"},{"field":"vision-action","type":"text","response":"None taken"},{"field":"hearing-action","type":"text","response":"Some taken"},{"field":"medical-diagnosis-if-yes-where","type":"text","response":"Wood shop"},{"field":"day-care-phone","type":"text","response":"555-555-5555"},{"field":"other-educational-opportunities","type":"text","response":"She participates in food fighting club and has been for 2 days now."},{"field":"person-making-referral","type":"text","response":"Jedidiah Swanson"},{"field":"relationship","type":"radio","response":"A-ha!"},{"field":"referral-date","type":"text","response":"05/05/2015"},{"field":"parent-aware-of-referral","type":"radio","response":"Y"},{"field":"screening-recommended","type":"checkbox","response":"Screening Recommended"},{"field":"no-evaluation-recommended","type":"checkbox","response":"No evaluation recommended at this time"},{"field":"lea-or-designee-signature","type":"text","response":"Mr. Filch"}]}]');

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
