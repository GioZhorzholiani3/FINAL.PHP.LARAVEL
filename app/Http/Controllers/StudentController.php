<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Notifications\Notification;
use App\Notifications\SaveNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(){
        $students = Student::all();
//        return view('student',compact('students'));
        return view('student',['students'=>$students,'layout'=>'index']);
    }


    public function create(){
        $students = Student::all();
        return view('student',['students'=>$students,'layout'=>'create']);
    }

    public function store(Request $request){
        $student = new Student();
        $user=Auth::user();
        $student->cne = $request->input('cne');
        $student->firstName = $request->input('firstName');
        $student->secondName = $request->input('secondName');
        $student->age = $request->input('age');
        $student->speciality = $request->input('speciality');
        $data=[
            "text"=>'student has been add'
        ];
        $student->save();

        $user->notify(new SaveNotification($data));
        return redirect('/');
    }

    public function show($id){
        $student = Student::findOrFail($id);
        $students =Student::all();
        return view('student',['students'=>$students,'student'=>$student,'layout'=>'show']);
    }

    public function edit($id){
        $student = Student::findOrFail($id);
        $students =Student::all();
        return view('student',['students'=>$students,'student'=>$student,'layout'=>'edit']);

    }

    public function update(Request $request,$id){
        $student = Student::findOrFail($id);
        $student->cne = $request->input('cne');
        $student->firstName = $request->input('firstName');
        $student->secondName = $request->input('secondName');
        $student->age = $request->input('age');
        $student->speciality = $request->input('speciality');
        $student->save();
        return redirect('/');

    }

    public function destroy($id){
        $student = Student::findOrFail($id);
        $student->delete() ;
        return redirect('/');
    }
}
