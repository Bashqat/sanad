<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
   public function list()
   {
     $subscriptions=Subscription::with('user_detail')->with('package')->get();
     return view('subscription/list',compact('subscriptions'));
   }
   public function view($id)
   {
     $subscriptions=Subscription::with('user_detail')->with('package')->where('id',$id)->get();
     return view('subscription/view',compact('subscriptions'));
   }
   public function status(Request $request)
   {
     $subscription_id=$request->input('subscription_id');
     $data=Subscription::where('id', $subscription_id)->get();
     $status='';
     if($data[0]->status=='active')
     {
       $status='deactive';
     }
     else {
       $status='active';
     }



     if(Subscription::where('id', $subscription_id)->update(['status'=>$status]))
     {
       return redirect()->route('subscription.list')->with('success','Status updated successfully.');


     }
   }
   public function subscriptionDetail($id)
   {
     $subscriptions=Subscription::with('user_detail')->with('package')->where('superadmin_id',$id)->get();
     return view('subscription/view',compact('subscriptions'));
   }
}
