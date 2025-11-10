<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
  public function index()
{
    $photos = Auth::user()
                  ->photos()
                  ->orderBy('id', 'asc')
                  ->get();

    $vertical = [];
    $horizontal = [];

    foreach ($photos as $p) {
        if ($p->view_type === 'vertical') {
            $vertical[] = $p;
        } else {
            $horizontal[] = $p;
        }
    }

    $rows = [];

    // First handle all vertical images (2 per row)
    for ($i = 0; $i < count($vertical); $i += 2) {
        if (isset($vertical[$i + 1])) {
            $rows[] = [
                'type' => 'vertical',
                'items' => [$vertical[$i], $vertical[$i + 1]]
            ];
        } else {
            $rows[] = [
                'type' => 'vertical-single',
                'items' => [$vertical[$i]]
            ];
        }
    }

    // Now push all horizontal images (1 per row)
    foreach ($horizontal as $h) {
        $rows[] = [
            'type' => 'horizontal',
            'items' => [$h]
        ];
    }

    return view('photo_gallery', compact('rows'));
}





    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'view_type' => 'required|in:vertical,horizontal',
            'image'     => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Save image in local public/uploads
        $imageName = time() . '_' . $request->image->getClientOriginalName();
        $request->image->move(public_path('uploads'), $imageName);

        // Store with relationship
        Auth::user()->photos()->create([
            'name'       => $request->name,
            'view_type'  => $request->view_type,
            'image_path' => 'uploads/' . $imageName,
        ]);

        return redirect()->back()->with('success', 'Photo added successfully!');
    }
}
