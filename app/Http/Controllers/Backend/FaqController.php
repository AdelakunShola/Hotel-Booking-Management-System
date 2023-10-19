<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class FaqController extends Controller
{

    public function AllFaq(){

        $faq = Faq::latest()->get();
        return view('backend.faq.all_faq',compact('faq'));

    }// End Method 

    public function StoreAllFaq(Request $request){

        Faq::insert([
            'topic' => $request->topic,
            'message' => $request->message,

        ]);

        $notification = array(
            'message' => 'Faq Added Successfully',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    }// End Method 


    public function EditAllFaq($id){

        $faq = Faq::find($id);
        return response()->json($faq);
    }// End Method 

    


    public function UpdateAllFaq(Request $request){

        $topic_id = $request->topic_id;
        

        Faq::find($topic_id)->update([
            'topic' => $request->topic,
            'message' => $request->message,
        ]);

        $notification = array(
            'message' => 'Faq Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }// End Method 


    public function DeleteAllFaq($id){

        Faq::find($id)->delete();

        $notification = array(
            'message' => 'Faq Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method 

   

    



}
    

