<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;

use App\Models\Appointment;




class AdminController extends Controller
{
    // add doctor
    public function addview()
    {


        return view('admin.add_doctor');
    }
    
    // upload doctor
    public function upload(Request $request)
    {
        $doctor=new doctor;

        $image=$request->file;

        $imagename=time().'.'.$image-> getClientoriginalExtension();

        $request->file->move('doctorimage',$imagename);

        $doctor->image=$imagename;


        $doctor->name=$request->name;

        $doctor->phone=$request->number;

        $doctor->room=$request->room;

        $doctor->speciality=$request->speciality;



        $doctor->save();

        return redirect()->back()->with('message', 'Doctor Added Successfully');

        
    }

    // Show appointment
    public function showappointment()
    {
        $data=appointment::all();

        return view('admin.showappointment',compact('data'));
    }

    // Approve appoint
    public function approved($id)
    {
        $data=appointment::find($id);

        $data->status='Approved';

        $data->save();

        return redirect()->back();
    }

    // Cancel appoint
    public function canceled($id)
    {
        $data=appointment::find($id);

        $data->status='Canceled';

        $data->save();

        return redirect()->back();
    }


    // Show doctors
    public function showdoctor()
    {
        $data = doctor::all();

        return view('admin.showdoctor',compact('data'));
    }


    // Delete doctors
    public function deletedoctor($id)
    {
        $data=doctor::find($id);

        $data->delete();

        return redirect()->back();
    }

    // Update doctor
    public function updatedoctor($id)
    {
        $data = doctor::find($id);

        return view('admin.update_doctor',compact('data'));
    }

    // Edit doctors data and submit
    public function editdoctor(Request $request , $id)
    {
        $doctor = doctor::find($id);

// the first (name) is from database and the second (name) is from update_doctor class and the same for the others
        $doctor->name=$request->name;
        
        $doctor->phone=$request->phone;
        
        $doctor->speciality=$request->speciality;
       
        $doctor->room=$request->room;

        $image=$request->file;

        if($image)
        {

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->file->move('doctorimage',$imagename);

        $doctor->image=$imagename;

        }

        $doctor->save();

        return redirect()->back()->with('message','Doctor Details Updated Successfully');
    }


}
