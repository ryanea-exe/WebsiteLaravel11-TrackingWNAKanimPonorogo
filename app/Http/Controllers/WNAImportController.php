<?php

namespace App\Http\Controllers;

use App\Helpers\NotificationHelper;
use App\Imports\WNAImportExcel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WNAImportController extends Controller
{
    public function form()
    {
        return view('import.wna');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        NotificationHelper::send(
                'staff',
                'Import Data WNA',
                auth()->user()->username . ' melakukan import data WNA',
                'create',
                null
            );

        Excel::import(new WNAImportExcel, $request->file('file'));

        return back()->with('success', 'Data berhasil diupload ke staging!');
    }
}