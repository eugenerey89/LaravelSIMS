<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // Return zero if a module's table has not been created.
        $studentCount = Schema::hasTable('students')
            ? DB::table('students')->count() : 0;

        $subjectCount = Schema::hasTable('subjects')
            ? DB::table('subjects')->count() : 0;

        $enrollmentCount = Schema::hasTable('enrollments')
            ? DB::table('enrollments')->count() : 0;

        $userCount = User::count();

        $statuses = [
            'enrolled' => 0,
            'pending' => 0,
            'dropped' => 0,
        ];

        if (
            Schema::hasTable('enrollments') &&
            Schema::hasColumn('enrollments', 'status')
        ) {
            $counts = DB::table('enrollments')
                ->select('status', DB::raw('COUNT(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status');

            foreach ($statuses as $status => $value) {
                $statuses[$status] = $counts[$status] ?? 0;
            }
        }

        // Combine recent records from the available tables.
        $activities = collect();

        $sources = [
            [
                'table' => 'students',
                'type' => 'student',
                'prefix' => 'New student registered',
                'name_column' => 'name',
            ],
            [
                'table' => 'subjects',
                'type' => 'subject',
                'prefix' => 'Subject added',
                'name_column' => 'name',
            ],
            [
                'table' => 'enrollments',
                'type' => 'enrollment',
                'prefix' => 'New enrollment',
                'name_column' => null,
            ],
        ];

        foreach ($sources as $source) {
            $table = $source['table'];

            if (
                !Schema::hasTable($table) ||
                !Schema::hasColumn($table, 'created_at')
            ) {
                continue;
            }

            $query = DB::table($table)
                ->select('id', 'created_at');

            $nameColumn = $source['name_column'];

            if (
                $nameColumn &&
                Schema::hasColumn($table, $nameColumn)
            ) {
                $query->addSelect($nameColumn);
            }

            $records = $query
                ->orderByDesc('created_at')
                ->limit(5)
                ->get();

            foreach ($records as $record) {
                $name = $nameColumn
                    ? ($record->{$nameColumn} ?? null)
                    : null;

                $description = $source['prefix'];

                if ($name) {
                    $description .= ': ' . $name;
                } else {
                    $description .= ' #' . $record->id;
                }

                $activities->push([
                    'type' => $source['type'],
                    'description' => $description,
                    'created_at' => $record->created_at,
                ]);
            }
        }

        $activities = $activities
            ->sortByDesc('created_at')
            ->take(5)
            ->values();

        return view('dashboard', compact(
            'studentCount',
            'subjectCount',
            'enrollmentCount',
            'userCount',
            'statuses',
            'activities'
        ));
    }
}
