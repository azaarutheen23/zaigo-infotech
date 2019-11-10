<?php


namespace App\Http\Controllers;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeManagement extends Controller
{
    public function list()
    {
        $employees = Employee::paginate(5);;
        return view("employee_list")->with('employee',$employees);
    }
    public function register()
    {
       
        return view("register");
    }
    public function insert(Request $request)
    {
        $c = $request->input('known_technologies');
        $known_technologies = implode(',', $c);
            if($request->hasFile('profile_picture'))
            {
            
                $file = $request->file('profile_picture');
                $profile_picture = $file->getClientOriginalName();
                $destinationPath = 'uploads';
                $file->move($destinationPath,$profile_picture);


            }
                $employee = Employee::create(    
                [
                'name' => $request->name,
                'email' => $request->email,
                'known_technologies'=>$known_technologies,
                'joining_date'=>$request->joining_date,
                'profile_picture'=>$profile_picture
                ]);
        $employee->save();
        return redirect('/');
    }
    public function delete($id){
    $employee = Employee::findorFail($id);
    $employee->delete();
    return redirect('/');  

    }
    public function edit($id)
    {
        $employee = Employee::findorFail($id);
        return view("edit")->with('employees',$employee);
    }

    public function update(Request $request)
    {
        // dd($request);
        $c = $request->input('known_technologies');
        $known_technologies = implode(',', $c);
            if($request->hasFile('profile_picture'))
            {
            
                $file = $request->file('profile_picture');
                $profile_picture = $file->getClientOriginalName();
                $destinationPath = 'uploads';
                $file->move($destinationPath,$profile_picture);


            }
            else{

                $profile_picture=$request->current_profile;
            }
                $employee = Employee::where('id',$request->id)->update(    
                [
                'name' => $request->name,
                'email' => $request->email,
                'known_technologies'=>$known_technologies,
                'joining_date'=>$request->joining_date,
                'profile_picture'=>$profile_picture
                ]);
        return redirect('/');
    }
    function chkmail(Request $request){
        $employee = Employee::where('email',$request->a)->first();
        if($employee)
        {
            return response('This Email Id Already Exists', 200);
        }


    }

}
