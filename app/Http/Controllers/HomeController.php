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
        if (Request::isMethod('get')) {
            $forms = json_decode('[{"form_id":316100,"title":"IEP: SpEd Preschool v.150501","type":"P","desc":"Referral for Evaluation for Special Education Services Preschool"},{"form_id":316866,"title":"IEP: SpEd 05-1 v.150501","type":"P","desc":"PLAFFP"},{"form_id":319384,"title":"IEP: SpEd 11","type":"P","desc":"Notice to Parents and Students Regarding Age of Majority Rights That Transfer under IDEA"},{"form_id":319561,"title":"IEP: SpEd 6a1","type":"P","desc":"Individualized Education Program"},{"form_id":394525,"title":"IEP: SpEd 8","type":"P","desc":"Written Prior Notice of Evaluation/Re-Evaluation and Review of Existing Data"},{"form_id":396527,"title":"IEP: SpEd 05E v.150501","type":"P","desc":"Statement Regarding Participation in Extracurricular Activities"},{"form_id":397199,"title":"IEP: SpEd 12 v.150501","type":"P","desc":"Acknowledgement for Placement in Home Schooling"},{"form_id":401957,"title":"IEP: SpEd 4","type":"P","desc":"Notice of Meeting"},{"form_id":402659,"title":"IEP: SpEd 13","type":"P","desc":"Academic Observation Report"},{"form_id":403303,"title":"IEP: Sped 19","type":"P","desc":"Authorization for Release and Use of Health Information"},{"form_id":-432079,"title":"grade level archive","type":"P","desc":""},{"form_id":-316023,"title":"IEP: SpEd 21 v.150501","type":"P","desc":"Summary of Academic Achievement and Functional Performance"},{"form_id":319275,"title":"IEP: SpEd 6e","type":"P","desc":"Individualized Transition Plan"},{"form_id":396671,"title":"IEP: SpEd 7a","type":"P","desc":"Written Prior Notice and Consent for Initial Placement in Special Education"},{"form_id":397092,"title":"IEP: SpEd 11 v.150501","type":"P","desc":"Individualized Education Plan Summary"},{"form_id":401857,"title":"IEP: SpEd 6h","type":"P","desc":"Amendment to IEP"},{"form_id":402585,"title":"IEP: SpEd 24","type":"P","desc":"Authorization to Access Confidential Student Records"},{"form_id":403748,"title":"IEP: SpEd 9","type":"P","desc":"Written Prior Notice of Refusal to take Action"},{"form_id":410056,"title":"Iron 6-12 Computer Acceptable Use Policy- Student","type":"P","desc":"Computer Acceptable Use Policy"},{"form_id":-316502,"title":"IEP: SpEd 05 v.150501","type":"P","desc":"Individualized Education Program"},{"form_id":317013,"title":"IEP: SpEd 6c","type":"P","desc":"Measurable Annual Goal(s) and Report of Progress"},{"form_id":317658,"title":"IEP: SpEd 6f1","type":"P","desc":"Participation in Assessment Programs"},{"form_id":320290,"title":"IEP: SpEd 01 v. 150501","type":"P","desc":"Student Intervention Profile  Tier I, II and III"},{"form_id":-394910,"title":"IEP: SpEd 05d v.150501","type":"P","desc":"Participation in Assessment Programs"},{"form_id":396736,"title":"IEP: SpEd 7b","type":"P","desc":"Written Prior Notice and Consent for Change of Placement in Special Education"},{"form_id":396809,"title":"IEP: SpEd 10 v.150501","type":"P","desc":"Individualized Services Plan"},{"form_id":397256,"title":"IEP: SpEd 13 LD1 v.150501","type":"P","desc":"Learning Disabilities Observation Report"},{"form_id":397323,"title":"IEP: SpEd 15","type":"P","desc":"Consent for Agency Invitation to Transition Meeting"},{"form_id":397664,"title":"IEP: SpEd 20 v.150501","type":"P","desc":"Medicaid Reimbursement Notification"},{"form_id":397709,"title":"IEP: SpEd 34 v.150501","type":"P","desc":"Revocation of Consent for Special Education and Related Services  34 C.F.R SS 300.9(c)(3) and 300.300(b)(4)"},{"form_id":400315,"title":"IEP SpEd 6d 04.08","type":"P","desc":"ESY"},{"form_id":402186,"title":"IEP: SpEd4a","type":"P","desc":"Notice of Meeting for Adult Student"},{"form_id":402966,"title":"IEP: SpEd 12","type":"P","desc":"Consent for Disclosure of Confidential Information"},{"form_id":407322,"title":"Iron K-5 Acceptable Use Policy- Parent","type":"P","desc":"Computer Acceptable Use Policy"},{"form_id":-432071,"title":"grade level archive","type":"S","desc":""},{"form_id":432168,"title":"grade level","type":"S","desc":""},{"form_id":394668,"title":"IEP: SpEd 2a","type":"P","desc":"Referral for Evaluation for Special Education Services"},{"form_id":394835,"title":"IEP: SpEd 03a","type":"P","desc":"Written Prior Notice and Consent for Evaluation/Re-Evaluation"},{"form_id":396630,"title":"IEP: SpEd 05F v.150501","type":"P","desc":"Individualized Education Program (IEP) Addendum"},{"form_id":397382,"title":"IEP: SpEd 6i","type":"P","desc":"Agreement to Excuse IEP Team Member"},{"form_id":397491,"title":"IEP: SpEd 16","type":"P","desc":"Manifestation Determination"},{"form_id":399873,"title":"IEP: SpEd6g ESY","type":"P","desc":"Extended School Year Services-IEP Attachment"},{"form_id":402477,"title":"IEP: SpEd 17","type":"P","desc":"Record of Access"},{"form_id":404001,"title":"IEP: SpEd 1","type":"P","desc":"Regular Education Interventions/At Risk Documentation"},{"form_id":407365,"title":"Iron K-5 Acceptable Use Policy- Student","type":"P","desc":"Computer Acceptable Use Policy"},{"form_id":410549,"title":"Iron 6-12 Computer Acceptable use Policy- Parent","type":"P","desc":"Computer Acceptable Use Policy"},{"form_id":410991,"title":"Iron Safe Schools Policy","type":"P","desc":"Safe Schools Policy JFB"},{"form_id":415827,"title":"IEP: SpEd 12a","type":"P","desc":"Release of Student Records"}]');
            $action = 'getBlanks';

            $info = $this->dispatch(
                new GetBlankPdfListCommand($forms)
            );

            return response()->json($info);
            // return 'Hi!';
        } else if (Request::isMethod('post')) {
            $action = Request::input('action');
            $info = $this->{$action}();

            return response()->json($info);
        }
    }

    protected function getBlanks() {
        $forms = json_decode(Request::input('forms'));

        return $this->dispatch(
            new GetBlankPdfListCommand($forms)
        );
    }

    protected function printBlanks() {
        $forms = json_decode(Request::input('forms'));

        return $this->dispatch(
            new AssemblePdfCommand($forms)
        );
    }

    protected function printFillForm() {
        $student = json_decode(Request::input('student'));
        $responses = json_decode(Request::input('responses'));

        return $this->dispatch(
            new FillPdfCommand($student, $responses)
        );
    }

}
