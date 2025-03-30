<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index(Request $request){
      $from = Carbon::parse($request->from);
      $to = Carbon::parse($request->to);

      $appointments = Appointment::whereBetween('date',[$from,$to])->orderBy('date','asc')->with(['customer:id,name','car:id,name','salesPerson:id,name'])->get();

      $start = date('Y-m-d', strtotime($from));
      $end = date('Y-m-d', strtotime($to));
      $pdf = Pdf::loadView('report', compact('appointments','start','end'));

      return $pdf->download(env('APP_NAME')." report {$start}-{$end}.pdf");

    }
}
