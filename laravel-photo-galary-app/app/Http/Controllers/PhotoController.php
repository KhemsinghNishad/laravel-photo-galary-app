<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
public function index()
{
    $photos = Photo::orderBy('id', 'asc')->get();

    $verticalRows = [];
    $horizontalRows = [];

    $pendingVertical = null;

    foreach ($photos as $p) {

        if ($p->view_type === 'vertical') {

            if ($pendingVertical === null) {
                $pendingVertical = $p;
            } else {
                $verticalRows[] = [
                    'type' => 'vertical',
                    'items' => [$pendingVertical, $p]
                ];
                $pendingVertical = null;
            }

        } else {

            $horizontalRows[] = [
                'type' => 'horizontal',
                'items' => [$p]
            ];
        }
    }
   
    if ($pendingVertical) {
        $verticalRows[] = [
            'type' => 'vertical-single',
            'items' => [$pendingVertical]
        ];
    }

    
    $rows = array_merge($verticalRows, $horizontalRows);

    return view('photo_gallery', compact('rows'));
}



    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'view_type' => 'required|in:vertical,horizontal',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);


        if ($validator->passes()) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);

            Photo::create([
                'name' => $request->name,
                'view_type' => $request->view_type,
                'image_path' => 'uploads/' . $imageName
            ]);

            return redirect()->back()->with('success', 'Photo added successfully!');
        }
    }
}
