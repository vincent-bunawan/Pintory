<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Auth;

class StocksExport implements FromView
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
        $allData = Product::where('outlet_id',$outlet_id)->orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view ('backend.excel.stock_excel',compact('allData'));
    }
    public function headings():array
    {
        return ['No','Nama Supplier','Unit','Kategori','Nama Produk','Stok'];
    }
}
