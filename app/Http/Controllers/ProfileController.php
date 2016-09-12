<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Image;
use DB;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Imager;

class ProfileController extends Controller
{

  /* Require any user attempting to use profile functions
   * to be logged in
   */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //if someone tries to go to '/editprofile, redirects to /editprofile/$id'
    function editMyProfile(){
      $profile_id = Auth::id();
      return editProfile($profile_id);
    }

    //editProfile page
    function editProfile(User $user){
      return view('pages.editProfile', compact('user'));
    }

    //updates user values, and if an image has been uploaded, stores it and creates a thumbnail
    function update(Request $request, User $user){
      $user->update($request->all());

      //is there a value in the image section?
      if($request->image){

        //$img is the newly uploaded file
        $img = $request->file('image');
        $extension = $img->getClientOriginalExtension();
        $fileName = $img->getClientOriginalName();
        $publicPath = public_path();
        $filePath = "upld/prof/".$fileName;
        $request['filepath'] = $filePath;
        $request['image'] = $img;

        //validates that the new filepath and image are unique I guess, ask Cole.
        $this->validate($request, [
            'filepath' => 'unique:images,file_path',
            'image' => 'image'
        ]);

        //sticks the new image into the folder
        $img->move("upld/prof/", $fileName);

        //Stick that there image into this here database
        $image = new Image;
        $image->file_path = $filePath;
        $image->user_id = $user->id;

        //creates the thumbnail image and associates it with the uploaded image
        $image->thumb_path = $this->createThumbnail($filePath, $extension);

        $image->save();

        //and now make the user point to the new image

        $user->image_id = $image->id;
        $user->save();
        //$user->image()->save($image);
        //return var_dump($user->image_id);

      }//end image saving/replacing

      return redirect('members/'.$user->id);
    }

    public function createThumbnail($image, $extension)
    {
      $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $image);
        $img = Imager::make($image)->resizeCanvas(200, 200)->save($withoutExt.'_thumb.'.$extension);
        return $withoutExt.'_thumb.'.$extension;
    }
}
