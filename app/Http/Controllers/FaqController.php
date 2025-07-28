<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->get();
        return view('admin.faq.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        Faq::create($request->only('question', 'answer'));

        return redirect()->back()->with('success', 'FAQ added.');
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq->update($request->only('question', 'answer'));

        return redirect()->back()->with('success', 'FAQ updated.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ deleted.');
    }

    public function updateStatus(Faq $faq)
    {
        // Now this toggles correctly (boolean)
        $faq->status = !$faq->status;
        $faq->save();

        return redirect()->back()->with('success', 'FAQ status updated.');
    }
}
