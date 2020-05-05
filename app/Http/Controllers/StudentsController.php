<?php

namespace App\Http\Controllers;

use App\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Students::all();
		return view('students.index',compact('students')); // fungsi compact digunakan jika nama variabel dan nama parameternya sama
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		 $request->validate([
			'mhs_nama' => 'required',
			'mhs_nim' => 'required|max:10',
		]);
		###--- Cara 1 ---###
        #$student = new Students;
		#$student->mhs_nama = $request->mhs_nama;
		#$student->mhs_nim = $request->mhs_nim;
		#$student->mhs_email = $request->mhs_email;
		#$student->mhs_jurusan = $request->mhs_jurusan;
		#$student->save();

		###--- Cara 2 ---###
		#Students::create([
		#	'mhs_nama'		=> 	$request->mhs_nama,
		#	'mhs_nim'		=> 	$request->mhs_nim,
		#	'mhs_email'		=> 	$request->mhs_email,
		#	'mhs_jurusan'	=> 	$request->mhs_jurusan
		#]);

		###--- Cara 3 ---###
		Students::create($request->all());

		return redirect('/students')->with('pesan', 'Data berhasil disaimpan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $student)
    {
		#return $student;
        return view('students.show',['mahasiswa'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Students $students)
    {
		Students::destroy($students->mhs_id);
        return redirect('/students')->with('pesan', 'Data berhasil dihapus !');
    }
}
