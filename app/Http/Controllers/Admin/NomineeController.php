<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nominee;
use Illuminate\Http\Request;

class NomineeController extends Controller
{
    public function index()
    {
        $nominees = Nominee::with(['category', 'subCategory'])
            ->withCount('nominations')
            ->latest()
            ->paginate(15);

        return view('admin.nominees.index', compact('nominees'));
    }

    public function destroy(Nominee $nominee)
    {
        $nominee->delete();
        return redirect()->route('admin.nominees')->with('success', 'Nominee deleted successfully.');
    }
}