<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CustomerController extends Controller
{
    protected $data=[];
    public function home(){
        $customerData=Customer::orderBy('cid','desc')->paginate(5);
        return view('home',compact('customerData'),$this->data);
    }
    public function addCustomer(Request $request)
    {
        if ($request->isMethod('get')){
            return redirect()->back();
        }
        if ($request->isMethod('post')){
            $this->validate($request,[
                'name'=>'required|min:3',
                'address'=>'required',
                'mobile'=>'required',
                'organization'=>'required',
                'email'=>'email',
                'image'=>'required|mimes:jpeg,jpg,png,gif'
            ]);
            $data['customerName']=$request->name;
            $data['address']=$request->address;
            $data['mobile']=$request->mobile;
            $data['organization']=$request->organization;
            $data['email']=$request->email;
            $data['address']=$request->address;
            if ($request->hasFile('image'))
            {
                $image=$request->file('image');
                $ext=$image->getClientOriginalExtension();
                $image_name=Str::random(10).'.'.$ext;
                $uploadPath=public_path('lib/images');
                $image->move($uploadPath,$image_name);
                $data['image']=$image_name;
            }
            if(Customer::create($data)){
                return redirect()->route('home')->with('success','Record is successfully inserted');
            }
        }
    }
    public function deleteCustomer(Request $request)
    {
        $cid=$request->user_id;
        if($this->deleteImg($cid) && Customer::findOrFail($cid)->delete())
        {
            return redirect()->route('home')->with('success','Record deleted');
        }
    }
    public function editCustomer(Request $request)
    {
        $id=$request->user_id;
        $editData=Customer::findOrFail($id);
        return view('edit_customer',compact('editData'),$this->data);
    }
    public function editAction(Request $request)
    {
        if ($request->isMethod('get')){
            return redirect()->back();
        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|min:3',
                'address' => 'required',
                'mobile' => 'required',
                'organization' => 'required',
                'email' => 'email',
                'image' => 'mimes:jpeg,jpg,png,gif'
            ]);
            $data['customerName']=$request->name;
            $data['address']=$request->address;
            $data['mobile']=$request->mobile;
            $data['organization']=$request->organization;
            $data['email']=$request->email;
            $data['address']=$request->address;
            $id=$request->cus_id;
            if ($request->hasFile('image'))
            {
                $image=$request->file('image');
                $ext=$image->getClientOriginalExtension();
                $image_name=Str::random(10).'.'.$ext;
                $uploadPath=public_path('lib/images');
                if($this->deleteImg($id) && $image->move($uploadPath,$image_name)){
                    $data['image']=$image_name;
                }
            }
            if(Customer::where('cid',$id)->update($data)){
                return redirect()->route('home')->with('success','Record is updated');
            }
        }
    }
    public function deleteImg($cid)
    {
        $cus_data=Customer::findOrFail($cid);
        $imageName=$cus_data->image;
        $imagePath=public_path('lib/images/'.$imageName);
        if (file_exists($imagePath))
        {
            return unlink($imagePath);
        }
        return true;
    }
}
