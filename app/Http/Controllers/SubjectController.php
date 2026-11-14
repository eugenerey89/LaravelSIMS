<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::search($request->q)->withCount('enrollments')
            ->orderBy('code')->paginate(10)->withQueryString();

        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        Subject::create($this->validated($request));
        return redirect()->route('subjects.index')->with('success', 'Subject added.');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update($this->validated($request, $subject));
        return redirect()->route('subjects.index')->with('success', 'Subject updated.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted along with its enrollments.');
    }

    private function validated(Request $request, ?Subject $subject = null): array
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:30', Rule::unique('subjects')->ignore($subject)],
            'name' => 'required|string|max:255',
            'units' => 'required|integer|between:1,12',
            'description' => 'nullable|string|max:1000',
        ]);
    }
}
