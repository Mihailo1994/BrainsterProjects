<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\AccommodationImage;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function delete(Request $request){
        $id = $request->input('id');
        $image = Image::find($id);
        Storage::delete($image->image_path);
        $image->delete();
        return response()->json('deleted', 200);
    }

}
