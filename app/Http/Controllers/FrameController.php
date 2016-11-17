<?php

namespace App\Http\Controllers;

use App\Iep\Iep;
use App\Iep\User;
use Carbon\Carbon;
use App\Iep\Student;
use App\Jobs\PrintPdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrameController extends Controller
{
    /**
     * @param Request $request
     * @return View|string
     */
    public function index(Request $request)
    {
        if ($request->has('frn') && $request->has('user')) {
            $data = [
                'frn' => $request->get('frn'),
                'user' => User::where('dcid', $request->get('user'))->firstOrFail(),
                'student' => Student::where('dcid', substr($request->get('frn'), 3))->firstOrFail(),
                'ieps' => Iep::where('studentsdcid', substr($request->get('frn'), 3))->orderBy('start_date', 'desc')->get(),
            ];

            return view('frame.index', $data);
        }

        return 'IEP Printing!';
    }

    /**
     * @param Request $request
     * @return View
     */
    public function iep(Request $request): View
    {
        if ($request->has('iep')) {
            $frn = $request->get('frn');
            $iep = $request->get('iep');
            $data = Iep::getFormResponseData($iep);

            return view('frame.fetch.iep', compact('data', 'iep', 'frn'));
        }
    }

    /**
     * @param Request $request
     * @return View
     */
    public function save(Request $request): View
    {
        $user = User::where('dcid', $request->json('user')['dcid'])->firstOrFail();
        $student = Student::where('dcid', $request->json('student')['dcid'])->firstOrFail();

        $iep = new Iep();
        $iep->studentsdcid = $student->dcid;
        $iep->case_manager = $user->lastfirst;
        $iep->is_active = false;
        $iep->start_date = new Carbon($request->json('start_date'));
        $iep->whocreated = $user->lastfirst;
        $iep->whencreated = new Carbon();
        $iep->save();

        return view('frame.iep-snippet', ['iep' => $iep]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function print(Request $request)
    {
        $responses = Iep::getFormData($request->json('selected'));
        $student = Student::where('dcid', $request->json('student')['dcid'])->firstOrFail();
        $fileOption = $request->json('fileOption');
        $watermarkOption = $request->json('watermarkOption');

        $printPdf = new PrintPdf($student, $responses, $fileOption, $watermarkOption);
        $info = $printPdf->handle();

        return $info;
    }

    /**
     * @param Request $request
     * @return array|string
     */
    public function printTest(Request $request)
    {
        $studentsDcid = $request->get('studentsdcid');
        $fileOption = $request->get('fileOption') ?: 'concat';
        $watermarkOption = $request->get('watermarkOption') ?: 'final';
        if ($studentsDcid) {
            $student = Student::where('dcid', $studentsDcid)->firstOrFail();
        } else {
            $student = \Cache::remember('printTestStudent', 1440, function () {
                return Student::orderByRaw('DBMS_RANDOM.RANDOM')->firstOrFail();
            });
        }
        $selected = json_decode($request->get('selected'));
        $responses = Iep::getFormData($selected);

        $printPdf = new PrintPdf($student, $responses, $fileOption, $watermarkOption);
        $info = $printPdf->handle();

        if (isset($_GET['html'])) {
            return $info;
        }

        if (!empty($info['file'])) {
            return '<h2><a target="_blank" href="' . asset($info['file']) . '">' . $info['file'] . '</a></h2>';
        }

        return $info;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function responseCount(Request $request)
    {
        return Iep::find($request->get('iep'))->iepResponse->count();
    }

    /**
     * @param Request $request
     * @return int
     */
    public function delete(Request $request): int
    {
        $iep = Iep::find($request->json('iep'));

        if ($iep->delete()) {
            return 1; // true/success
        }

        return 0; // false/failure
    }

    /**
     * @param Request $request
     * @return int
     */
    public function activate(Request $request): int
    {
        $iep = Iep::find($request->json('iep'));
        $student = Student::where('dcid', $request->json('student')['dcid'])->firstOrFail();

        if ($iep->activate($student)) {
            return 1;
        }

        return 0;
    }
}
