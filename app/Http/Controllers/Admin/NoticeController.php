<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Notice;
use App\Events\NoticePostByAdmin;
use Illuminate\Support\Facades\Mail;

class NoticeController extends Controller
{
     public function index(){
    	return view('admin/post_notice');
    }

    public function submitNotice(Request $request){
    	$validatedData = $request->validate([
        'notice_title' => 'required|max:255',
        'notice_description' => 'required|max:3000',
        'notice_file.*' => 'mimes:jpg,jpeg,pdf',
        ]);

        $data=array();
        $data['admin_id']=$request->admin_id;
        $data['notice_title']=$request->notice_title;
        $data['notice_description']=$request->notice_description;
        $data['notice_post_date']=$request->notice_post_date;
        $data['notice_post_time']=$request->notice_post_time;
        $image=$request->file('notice_file');

        if ($image) {
            $image_name= str::random(5);
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='notices/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if ($success) {
                $data['notice_file']=$image_url;
                $notice_id = DB::table('notices')
                         ->insertGetId($data);

                 $notice = Notice::find($notice_id);
                 event(new NoticePostByAdmin($notice));

                 if ($notice_id) {
                 $notification=array(
                 'message'=>'Notice Posted Successfully',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                     
             }else{
              $notification=array(
                 'message'=>'Could not be able to post the Notice',
                 'alert-type'=>'error'
                  );
                 return Redirect()->back()->with($notification);
             }  
            }else{

              return Redirect()->back();
            	
            }
        }else{
        	  $notice = DB::table('notices')
                         ->insert($data);
              if ($notice) {
                 $notification=array(
                 'message'=>'Notice Posted Successfully',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                     
             }else{
              $notification=array(
                 'message'=>'Could not be able to post the Notice',
                 'alert-type'=>'error'
                  );
                 return Redirect()->back()->with($notification);
             }  
        }
    }

    public function myNotice($id){
    	$notices = DB::table('notices')->where('admin_id',$id)->paginate(4);
    	return view('admin/my_notices',compact('notices'));
    }

	public function viewNotice($id){
    	$viewnotices = DB::table('notices')->where('id',$id)->first();
    	return view('admin/view_notices',compact('viewnotices'));
    }

    public function allNotice(){
    	$allnotices = DB::table('notices')->paginate(4);
    	return view('admin/all_notices',compact('allnotices'));
    }

    public function deleteNotice($id){
    	$delete = DB::table('notices')
    			->where('id',$id)
    			->first();

    	$file = $delete->notice_file;
    	if($file){
    		unlink($file);

    	$dltuser = DB::table('notices')
    			->where('id',$id)
    			->delete();

    	if ($dltuser) {
                 $notification=array(
                 'message'=>'Notice Deleted Successfully',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'Could not able to delete the Notice ',
                 'alert-type'=>'warning'
                  );
                 return Redirect()->back()->with($notification);
        	}     
    	}else{
    		$dltuser = DB::table('notices')
    			->where('id',$id)
    			->delete();

    	if ($dltuser) {
                 $notification=array(
                 'message'=>'Notice Deleted Successfully',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification);                      
             }else{
              $notification=array(
                 'message'=>'Could not able to delete the Notice ',
                 'alert-type'=>'warning'
                  );
                 return Redirect()->back()->with($notification);
        	}     
    	}
    	
    }
}
