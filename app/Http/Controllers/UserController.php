<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 08.10.2017
 * Time: 15:07
 */

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function getProfile()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function postSaveProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50'
        ]);

        $user = Auth::user();
        $user->name = $request['name'];
        $user->update();

        $file = $request->file('image');
        $filename = $request['name'] . '-' . $user->id . '.jpg';
        if ($file) {
           Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('profile');
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
}