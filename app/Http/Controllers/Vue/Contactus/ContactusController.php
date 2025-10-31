<?php
namespace App\Http\Controllers\Vue\Contactus;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;  // Add this import

class ContactusController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        ContactUs::create($validated);

        // Inertia-friendly: Redirect back with flash message (no plain JSON!)
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}