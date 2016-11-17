<?php

namespace App\Http\Controllers;

use DB;
use URL;
use App\Iep\Iep;
use App\Iep\Student;
use App\Jobs\PrintPdf;
use Illuminate\Http\Request;
use App\Iep\Legacy\Commands\FillPdfCommand;
use App\Iep\Legacy\Commands\AssemblePdfCommand;
use App\Iep\Legacy\Commands\GetBlankPdfListCommand;

class BaseController extends Controller
{

    /**
     * action for /print-pdf for filling and printing pdfs
     * @param Request $request
     * @return array
     */
    public function printPdf(Request $request)
    {
        $student = is_string($request->get('student')) ? Student::where('id', $request->get('student'))->first() : $request->get('student');
        $responses = is_string($request->get('responses')) ? json_decode($request->get('responses')) : $request->get('responses');
        $fileOption = $request->get('fileOption');
        $watermarkOption = $request->get('watermarkOption');

        $printPdf = new PrintPdf($student, $responses, $fileOption, $watermarkOption);
        return $printPdf->handle();
    }

    /**
     * action for /get-blanks for getting a list of available pdfs to print
     * @param Request $request
     * @return array
     */
    public function getBlanks(Request $request): array
    {
        /**************
         * legacy block
         **************/
        $getBlankPdfListCommand = new GetBlankPdfListCommand($request->get('forms'));
        return $getBlankPdfListCommand->handle();
    }

    /**
     * action for /print-blanks for assembling blank pdfs to print
     * @param Request $request
     * @return array
     */
    public function printBlanks(Request $request): array
    {
        /**************
         * legacy block
         **************/
        $assemblePdfCommand = new AssemblePdfCommand($request->get('forms'));
        return $assemblePdfCommand->handle();
    }

    /**
     * generate the token for the session
     */
    public function token(): string
    {
        return response()->json(csrf_token());
    }
}
