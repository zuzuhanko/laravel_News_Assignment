<?php

namespace App\Http\Controllers;

use App\Models\newsList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class NewsController extends Controller
{
    public function main(){
       $data = newsList::get();
        return view('news.main')->with(['data'=>$data]);
    }

    //create
    public function create(Request $request){
return view('news.create');
    }


   public function insert(Request $request){
    $request->validate([
        'photo' => 'required',
        'title'=>'required',
        'type'=>'required',
         'detail'=>'required',
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now(),
    ]);

    $photo_id = $this->uploadPhoto($request);
    $new =[
        'title'=>$request->title,
        'detail'=>$request->detail,
        'type'=>$request->type,
        'photo'=>$photo_id,
    ];

    $data = newsList::create($new);

     return redirect()->route('main')->with(['data'=>$data]);

   }

   //delete
   public function delete($id){
    $this->deletePhoto($id);
    newsList::where('no',$id)->delete();
    return redirect()->route('main');
   }

   //edit
   public function edit($id){
    $data = newsList::where('no',$id)->first();
    return view('news.edit')->with(['data'=>$data]);
   }

   //update
   public function update($id,Request $request){
    $request->validate([
        'photo' => 'required',
        'title'=>'required',
        'type'=>'required',
         'detail'=>'required',
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now(),
    ]);
    if($request->hasFile('photo')){
        $this->deletePhoto($id);
        $photo_id = $this->uploadPhoto($request);
    $new =[
        'title'=>$request->title,
        'detail'=>$request->detail,
        'type'=>$request->type,
        'photo'=>$photo_id,
    ];
newsList::where('no',$id)->update($new);
    }

    $new =[
        'title'=>$request->title,
        'detail'=>$request->detail,
        'type'=>$request->type,
    ];
    $data = newsList::where('no',$id)->update($new);
return redirect()->route('main');


   }

   //important
   public function important(){
    $data = newsList::where('type','1')->get();
    return view('news.main')->with(['data'=>$data]);
   }

   //normal
   public function normal(){
    $data = newsList::where('type','0')->get();
    return view('news.main')->with(['data'=>$data]);
   }


//upload photo
private function uploadPhoto($request){
    $photo = $request->file('photo')->getClientOriginalName();
    $result = $request->file('photo')->storeOnCloudinaryAs('news_images', rand().$photo);
    $photo_id = $result->getPublicId();
return $photo_id;


}

//delete photo
private function deletePhoto($id){
$public_id = newsList::where('no',$id)->first()->photo;
Cloudinary::destroy($public_id);
}


}























