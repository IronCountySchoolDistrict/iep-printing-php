<?php namespace App\Http\Controllers;

use Request;
use App\Iep\Pdf;
use App\Iep\Student;
use App\Commands\FillPdfCommand;
use App\Commands\AssemblePdfCommand;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesCommands;

class HomeController extends Controller {

    use DispatchesCommands;

    public function index()
    {
        if (Request::isMethod('get')) {
            $forms = json_decode('[{"id":"316866","title":"IEP: SpEd 05-1 v.150501"}]');
            $action = 'blank';
            $student = json_decode('{"lastfirst":"Fabela, Phoebe Arian","first_name":"Phoebe","middle_name":"Arian","last_name":"Fabela","student_number":60013447,"entrydate":"08/14/2014","exitdate":"05/23/2015","gender":"F","current_school":"South Elementary School","dob":"06/11/2008","street":"375 S 1000 W","city":"Cedar City","state":"UT","zip":"84720","next_school":"South Elementary School","enrollment_school":"South Elementary School","father":"","mother":"Behunin, Jennifer","grade":1}');
            $responses = json_decode('[{"form":{"id":316866,"title":"IEP: SpEd 05-1 v.150501","description":"PLAFFP","type":"P"},"response":[{"field":"iep-meeting","type":"text","response":"05/05/2015"},{"field":"classification","type":"dropdown","response":"Hearing Impairment/Deafness"},{"field":"plaafp","type":"paragraph","response":"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non metus sit amet augue consequat lacinia faucibus at dolor. Aenean efficitur, arcu a iaculis blandit, tortor nisi cursus metus, vel accumsan nisl odio in ante. Fusce lacus augue, bibendum sed maximus interdum, ullamcorper sed urna. Morbi vel nulla arcu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed tristique, augue quis pulvinar suscipit, purus justo sodales orci, efficitur porttitor libero odio et mauris. Nunc finibus, ligula a posuere egestas, nibh urna viverra justo, vel tristique eros ex et neque. Nunc facilisis velit ac elementum tristique. Ut sed ornare ex, non aliquam nibh. Ut vel fringilla eros. Nam mi enim, tempus vel lacus quis, ornare imperdiet nisl.Curabitur scelerisque, velit non faucibus eleifend, diam orci posuere sem, ut mattis nulla dui eu mauris. Nam orci diam, condimentum at eros eget, placerat lacinia mi. Vestibulum tortor sapien, pulvinar ut diam vel, sagittis consectetur neque. Suspendisse cursus massa vitae nisi ornare viverra. Nullam pulvinar lacus venenatis dapibus maximus. Morbi sollicitudin tempor elit sed tempus. Nam dolor erat, malesuada vel est eu, dictum malesuada nisi. Cras fermentum auctor tellus at rhoncus. Phasellus vel luctus tellus. Praesent sollicitudin augue et felis interdum, nec imperdiet elit facilisis. Maecenas tristique quis est eget rhoncus. Vivamus interdum ipsum sit amet sapien rutrum mollis. Nullam interdum lectus id libero sagittis hendrerit. Donec libero ex, cursus eget ex vitae, posuere pellentesque urna."},{"field":"grade","type":"dropdown","response":"3"},{"field":"eligibility-date","type":"text","response":"05/01/2015"},{"field":"attending-school","type":"dropdown","response":"East Elementary"},{"field":"next-re-evaluation","type":"text","response":"05/01/2016"},{"field":"primary-server","type":"text","response":"Mr. Alibaba"}]},{"form":{"id":396736,"title":"IEP: SpEd 7b","description":"Written Prior Notice and Consent for Change of Placement in Special Education","type":"P"},"response":[{"field":"placement-effective-date","type":"text","response":"01/02/2003"},{"field":"placement","type":"checkbox","response":"Regular Class with part-time and/or itinerant special education services|1, Special Class|2, Special school|3, Home instruction|4, Hospital/Institutional|5, No longer eligible for services due to Graduation with a high school diploma|6, No longer eligible for services due to Reaching maximum age of eligibility, 22 years|7"},{"field":"this-option-was-selected","type":"radio","response":"OtherUtherAtherEtherItherYther"},{"field":"date","type":"hidden","response":"6/16/15"},{"field":"upon-exiting-the-lea","type":"checkbox","response":"Yes"},{"field":"attach-copy","type":"checkbox","response":"Yes, No"}]}]');

            if ($action == 'blank') {
                $info = $this->dispatch(
                    new AssemblePdfCommand($forms)
                );
            } else {
                $info = $this->dispatch(
                  new FillPdfCommand($student, $responses)
                );
            }

            return response()->json($info);
            // return 'Hi!';
        } else if (Request::isMethod('post')) {
            if (Request::input('action') == 'blank') {
                $forms = json_decode(Request::input('forms'));

                $info = $this->dispatch(new AssemblePdfCommand($forms));
            } else {
                $info = $this->dispatch(
                    new FillPdfCommand(
                        json_decode(Request::input('student')),
                        json_decode(Request::input('responses'))
                    )
                );
            }

            return response()->json($info);
        }
    }

}
