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
        $responses = json_decode('[{"form":{"id":404001,"title":"IEP: SpEd 1","description":"Regular Education Interventions/At Risk Documentation","type":"P"},"response":[{"field":"student","type":"text","response":"Fabela, Phoebe Arian"},{"field":"teacher","type":"text","response":"Mr.Example"},{"field":"dob","type":"text","response":"06/11/2008"},{"field":"date","type":"text","response":"11/05/2015"},{"field":"grade","type":"text","response":"1"},{"field":"parents-notified-on","type":"text","response":"11/05/2015"},{"field":"primary-home-language","type":"text","response":"Spanish"},{"field":"parents-notified-by","type":"text","response":"Mr. Example"},{"field":"student-ipt","type":"text","response":"9000"},{"field":"academic","type":"checkbox","response":"Written Expression/Sentence structure, Mathematics/Basic mathematics or problem solving, Reading fluency/decoding, Pre-Academics letter/number/color identification, Other"},{"field":"academic-other","type":"text","response":"Academic other"},{"field":"social-emotional","type":"checkbox","response":"Attention, Task Completion, Following Directions, Withdrawn, Acting Out, Peer Relationships, Other"},{"field":"social-emotional-other","type":"text","response":"Social/Emotional other"},{"field":"communication","type":"checkbox","response":"Atriculation and/or phonological awareness, Language, Voice, Listening Skills, Stuttering, Other"},{"field":"communication-other","type":"text","response":"Communication other"},{"field":"sensory-motor","type":"checkbox","response":"Hearing, Vision, Fine Motor, Gross Motor, Self Help/Adaptive, Other"},{"field":"sensory-motor-other","type":"text","response":"Sensory/Motor other"},{"field":"previous-assessments","type":"text","response":"Assessment informal"},{"field":"results","type":"text","response":"Positive"},{"field":"previous-assessments-date","type":"text","response":"11/05/2015"},{"field":"received-special-education","type":"radio","response":"Yes"},{"field":"date-of-vision-screening","type":"text","response":"11/05/2015"},{"field":"date-of-hearing-screening","type":"text","response":"11/05/2015"},{"field":"vision","type":"checkbox","response":"Pass, Fail"},{"field":"hearing","type":"checkbox","response":"Pass, Fail"},{"field":"vision-action","type":"text","response":"N/A"},{"field":"hearing-action","type":"text","response":"N/A"},{"field":"attendance","type":"checkbox","response":"Problem, No Problem"},{"field":"health","type":"checkbox","response":"Problem, No Problem"},{"field":"attendance-comments","type":"text","response":"Attendance comment"},{"field":"health-comments","type":"text","response":"Health comment"},{"field":"utilized-adaptive-equipment-started","type":"text","response":"11/05/2015"},{"field":"utilized-adaptive-equipment-ended","type":"text","response":"11/05/2015"},{"field":"utilized-adaptive-equipment","type":"checkbox","response":"Yes, No"},{"field":"changed-instructor-schedule-started","type":"text","response":"11/05/2015"},{"field":"changed-instructor-schedule-ended","type":"text","response":"11/05/2015"},{"field":"changed-instructor-schedule","type":"checkbox","response":"Yes, No"},{"field":"differentiated-instruction-started","type":"text","response":"11/05/2015"},{"field":"differentiated-instruction-ended","type":"text","response":"11/05/2015"},{"field":"differentiated-instruction","type":"checkbox","response":"Yes, No"},{"field":"utilized-supplemental-materials-started","type":"text","response":"11/05/2015"},{"field":"utilized-supplemental-materials-ended","type":"text","response":"11/05/2015"},{"field":"utilized-supplemental-materials","type":"checkbox","response":"Yes, No"},{"field":"progress-monitoring-data-started","type":"text","response":"11/05/2015"},{"field":"progress-monitoring-data-ended","type":"text","response":"11/05/2015"},{"field":"progress-monitoring-data","type":"checkbox","response":"Yes, No"},{"field":"implemented-contracts-started","type":"text","response":"11/05/2015"},{"field":"implemented-contracts-ended","type":"text","response":"11/05/2015"},{"field":"implemented-contracts","type":"checkbox","response":"Yes, No"},{"field":"differentiated-assignments-started","type":"text","response":"11/05/2015"},{"field":"differentiated-assignments-ended","type":"text","response":"11/05/2015"},{"field":"differentiated-assignments","type":"checkbox","response":"Yes, No"},{"field":"utilized-systematic-consequences-started","type":"text","response":"11/05/2015"},{"field":"utilized-systematic-consequences-ended","type":"text","response":"11/05/2015"},{"field":"utilized-systematic-consequences","type":"checkbox","response":"Yes, No"},{"field":"used-computer-assisted-instruction-started","type":"text","response":"11/05/2015"},{"field":"used-computer-assisted-instruction-ended","type":"text","response":"11/05/2015"},{"field":"used-computer-assisted-instruction","type":"checkbox","response":"Yes, No"},{"field":"provided-direct-teaching-started","type":"text","response":"11/05/2015"},{"field":"provided-direct-teaching-ended","type":"text","response":"11/05/2015"},{"field":"provided-direct-teaching","type":"checkbox","response":"Yes, No"},{"field":"modeled-desired-behavior-started","type":"text","response":"11/05/2015"},{"field":"modeled-desired-behavior-ended","type":"text","response":"11/05/2015"},{"field":"modeled-desired-behavior","type":"checkbox","response":"Yes, No"},{"field":"shared-data-with-parents-started","type":"text","response":"11/05/2015"},{"field":"shared-data-with-parents-ended","type":"text","response":"11/05/2015"},{"field":"shared-data-with-parents","type":"checkbox","response":"Yes, No"},{"field":"provided-direct-teaching-started","type":"text","response":"11/05/2015"},{"field":"provided-direct-teaching-ended","type":"text","response":"11/05/2015"},{"field":"provided-direct-teaching","type":"checkbox","response":"Yes, No"},{"field":"provided-practice-started","type":"text","response":"11/05/2015"},{"field":"provided-practice-ended","type":"text","response":"11/05/2015"},{"field":"provided-practice","type":"checkbox","response":"Yes, No"},{"field":"provided-peer-tutoring-started","type":"text","response":"11/05/2015"},{"field":"provided-peer-tutoring-ended","type":"text","response":"11/05/2015"},{"field":"provided-peer-tutoring","type":"checkbox","response":"Yes, No"},{"field":"modified-classwide-discipline-plan-started","type":"text","response":"11/05/2015"},{"field":"modified-classwide-discipline-plan-ended","type":"text","response":"11/05/2015"},{"field":"modified-classwide-discipline-plan","type":"checkbox","response":"Yes, No"},{"field":"other-evidence-based-interventions","type":"paragraph","response":"Other evidence based interventions/supplementary instruction/programs"},{"field":"refer-for","type":"checkbox","response":"504 Evaluation, Alternative language porgram, Special education evaluation, Referred to school problem solving team for further interventions(s) and all data transferred to student\'s classroom teacher(s)"},{"field":"","type":"text","response":"Mr. Example"},{"field":"","type":"text","response":"11/05/2015"}]}]');

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
