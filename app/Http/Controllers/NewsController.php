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

   //insert data
   public function insert(Request $request){

    // $validator = Validator::make($request->all(), [
    //     'photo' => 'required',

    //     'title'=>'required',
    //     'type'=>'required',
    //    'created_at'=>Carbon::now(),
    //    'updated_at'=>Carbon::now(),
    //  ]);

    //  if ($validator->fails()) {
    //      return back()
    //                  ->withErrors($validator)
    //                  ->withInput();
    //  }

$uploadedFileUrl = cloudinary()->upload($request->file('photo')->getRealPath(),['folder'=>'news_images'])->getSecurePath();


   newsList::create([
    'photo'=>$uploadedFileUrl,
    'title'=>$request->title,
    'type'=>$request->type,
    'detail'=>$request->detail,
   ]);



  return redirect()->route('main')->with(['create'=>'Data is created!']);
   }

   //edit data
   public function edit($id){

   $data = newsList::where('no',$id)->first();
   return view('news.edit')->with(['data'=>$data]);
   }

   //update data
   public function update($id,Request $request){

    $updatedData = $this->updatedData($request);
    if($request->hasFile('photo')){
        $data = newsList::select('photo')->where('no',$id)->first();
       $oldPhoto = $data['photo'];
       Cloudinary::destroy($oldPhoto);
       $uploaded  = cloudinary()->upload($request->file('photo')->getRealPath(),
        ['folder'=>'news_images'])->getSecurePath();

    }
    newsList::where('no',$id)->update($updatedData);
    return redirect()->route('main')->with(['update'=>'Data is updated!']);
   }



   //delete data
   public function delete($id){

    $data = newsList::select('photo')->where('no',$id)->first();
    $oldPhoto = $data['photo'];
    newsList::where('no',$id)->delete();
     Cloudinary::destroy([$oldPhoto]);

    return redirect()->route('main')->with(['delete'=>'Data is deleted!']);
   }

   //choose important
   public function important(){
    $data = newsList::where('type','1')->get();
    return view('news.main')->with(['data'=>$data]);
   }

   //choose normal
   public function normal(){
   $data = newsList::where('type','0')->get();
    return view('news.main')->with(['data'=>$data]);
   }

   private function updatedData($request){
    $arr = [
        'title'=>$request->title,
        'type'=>$request->type,
        'detail'=>$request->detail,

    ];
    if($request->hasFile('photo')){
        $arr['photo']= $request->photo;
            }
            return $arr;

   }


}
