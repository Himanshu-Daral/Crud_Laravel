<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crud;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Validator;


class CrudController extends Controller
{
    function index()
    {
        return view('welcome');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:5|max:16',
        ]);

        $registration = Crud::where('email', '=', $request->email)
            ->where('usertype', '=', 'Admin')
            ->first();
        if ($registration) {
            if (Hash::check($request->password, $registration->password)) {
                $request->session()->put('id', $registration->id);
                $request->session()->put('firstname', $registration->firstname);
                $request->session()->put('lastname', $registration->lastname);
                return redirect('registration');
            } else {
                return back()->with('Failed', 'Password not matched.');
            }
        } else {
            $user = Crud::where('email', '=', $request->email)
                ->where('usertype', '=', 'User')
                ->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('id', $user->id);
                    $request->session()->put('firstname', $user->firstname);
                    $request->session()->put('lastname', $user->lastname);
                    $request->session()->put('email', $user->email);
                    return redirect('registration');
                } else {
                    return back()->with('Failed', 'Password not matched.');
                }
            } else {
                return back()->with('Failed', 'This email is not registered with us.');
            }
        }
    }

    function homeadmin()
    {
        $employee = Crud::where('usertype', '=', 'User')->get();
        return view('registration', ['data' => $employee]);
    }

    public function fetchemployee()
    {
        $employee = Crud::orderBy('created_at', 'DESC')->get();
        return response()->json([
            'employee' => $employee,
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required | min:3',
            'lastname' => 'required | min:4',
            'email' => 'required | email|unique:crud,email',
            'password' => 'required|min:8|max:16',
            'mobile' => 'required | min:10|max:10|unique:crud,mobile',
            'usertype' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        } else {
            $employee = new Crud;
            $employee->firstname = $request->input('firstname');
            $employee->lastname = $request->input('lastname');
            $employee->email = $request->input('email');
            $employee->password = Hash::make($request->input('password'));
            $employee->mobile = $request->input('mobile');
            $employee->usertype = $request->usertype;
            $employee->save();

            return response()->json([
                'status' => 200,
                'message' => 'Employee Added Successfully'
            ]);
        }
    }

    function logout()
    {
        if (Session::has('id')) {
            Session::pull('id');
            return redirect('/');
        }
    }


    public function editEmp($id)
    {
        $employee = Crud::find($id);

        if ($employee) {
            return response()->json([
                'status' => 200,
                'employee' => $employee
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Not Found'
            ]);
        }
    }

    public function updateEmp(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required | min:3',
            'lastname' => 'required | min:4',
            'email' => 'required | email',
            'mobile' => 'required | min:10|max:10',
            'usertype' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->getMessageBag()
            ]);
        } else {
            $employee = Crud::find($id);
            if ($employee) {
                $employee->firstname = $request->input('firstname');
                $employee->lastname = $request->input('lastname');
                $employee->email = $request->input('email');
                $employee->mobile = $request->input('mobile');
                $employee->usertype = $request->usertype;
                $employee->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Employee Updated Successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Not Found'
                ]);
            }
        }
    }

    function deleteEmp($id)
    {
        $data =  Crud::find($id);
        $des = array('msg' => 'Something Goes Wrong');
        $delete = $data->delete($id);
        if ($delete) {
            $des = array('msg' => 'Deleted Successfully');
        }
        return response()->json($des);
    }
}
