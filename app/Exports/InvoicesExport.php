<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Auth;

class InvoicesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $request;
    public function __construct($request)
    {
    $this->request = $request;
    }

    public function view(): View
    {
        $request = $this->request;
        $outlet_id = $request->session()->get('outletId') || Auth::guard('employee')->user()->outlet_id;
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $allData = Invoice::whereBetween('date',[$sdate,$edate])->where('status','1')->where('outlet_id',$outlet_id)->get();
        return view ('backend.excel.invoice_excel',compact('allData'));
    }
    public function headings():array
    {
        return ['Sl','Customer Name','Tanggal','Deskripsi','Jumlah'];
    }
}
