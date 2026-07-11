<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Display the activity log timeline.
     */
    public function index(Request $request)
    {
        $query = ActivityLog::query();

        // Filter by action type
        if ($request->filled('action') && $request->action !== 'all') {
            $query->where('action', $request->action);
        }

        // Filter by target type
        if ($request->filled('target_type') && $request->target_type !== 'all') {
            $query->where('target_type', $request->target_type);
        }

        $totalLogs = ActivityLog::count();
        $logs = $query->orderBy('created_at', 'desc')
                      ->paginate(20)
                      ->withQueryString();

        // Group by date for timeline display
        $groupedLogs = $logs->getCollection()->groupBy(function ($log) {
            return $log->created_at->format('Y-m-d');
        });

        return view('pages.activity-log', compact('logs', 'groupedLogs', 'totalLogs'));
    }
}
