<?php

namespace App\Http\Controllers;

use App\Exports\VisitorsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminVisitorExportController extends Controller
{
    public function export(Request $request)
    {
        $eventId = $request->filled('event_id')
            ? (int) $request->input('event_id')
            : null;

        $search = $request->filled('search')
            ? trim($request->input('search'))
            : null;

        $filename = 'senarai-pengunjung-'
            . now()->format('Ymd_His')
            . '.xlsx';

        return Excel::download(
            new VisitorsExport($eventId, $search),
            $filename
        );
    }
}