<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTeacherRequest;
use App\Jam;
use App\Models\Role;
use App\Models\Siswa;
use App\Models\StatusAbsensi;
use Dirape\Token\Token;
use App\Models\Absen;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Excel;

class AdminEditController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
    }

    //Schedule
    public function editSchedule(){
        $data = Jadwal::all();
        $teacher = DB::table('USERS AS US')->join('GURU AS GU','GU.ID_USER','=', 'US.ID')->get();
        $class = Kelas::all();
        $time = Jam::all();
        $lesson = Pelajaran::all();
        return view('admin/schedule')
            ->with('data', $data)
            ->with('teacher', $teacher)
            ->with('lesson', $lesson)
            ->with('time', $time)
            ->with('class', $class);
    }
    public function addSchedule(Request $request){
        Jadwal::create([
            'id_kelas'=>$request->id_kelas,
            'id_guru'=>$request->id_guru,
            'id_pelajaran'=>$request->id_pelajaran,
            'hari'=>$request->hari,
            'jam'=>$request->jam,
        ]);
        return redirect()->route('admin.schedule');
    }
    public function updateSchedule(Request $request){
        Jadwal::where('id', '=', $request->id)->update([
            'id_kelas'=>$request->id_kelas,
            'id_guru'=>$request->id_guru,
            'id_pelajaran'=>$request->id_pelajaran,
            'hari'=>$request->hari,
            'jam'=>$request->jam,
        ]);
        return redirect()->route('admin.schedule');
    }
    public function deleteSchedule(Request $request){
        Jadwal::where('id','=',$request->id)->delete();
        return redirect()->route('admin.schedule');
    }

    //Lesson
    public function editLesson(){
        $data = Pelajaran::all();
        return view('admin/lesson')->with('data', $data);
    }
    public function addLesson(Request $request){
        Pelajaran::create($request->all([
            'nama'=>$request->nama,
            'deskripsi'=>$request->jurusan,
            'jam'=>$request->jam,
        ]));
        return redirect()->route('admin.lesson');
    }
    public function updateLesson(Request $request){
        Pelajaran::where('id', '=', $request->id)->update([
            'nama'=>$request->nama,
            'deskripsi'=>$request->jurusan,
            'jam'=>$request->jam,
        ]);
        return redirect()->route('admin.lesson');
    }

    //Class
    public function editClass(){
        $data = Kelas::all();
        return view('admin/class')->with('data', $data);
    }
    public function addClass(Request $request){
        Kelas::create($request->all());
        return redirect()->route('admin.class');
    }
    public function updateClass(Request $request){
        Kelas::where('id', '=', $request->id)->update([
            'kelas'=>$request->kelas,
            'jurusan'=>$request->jurusan,
            'pararel'=>$request->pararel,
            'kode_kelas'=>$request->kode_kelas,
        ]);
        return redirect()->route('admin.class');
    }
    public function deleteClass(Request $request){
        if ($this->userValidation($request)) {
            Kelas::where('id', '=', $request->id)->delete();
        }
        return redirect()->route('admin.class');
    }

    //Absence
    public function editAbsence(){
        $data = Absen::all();
        return view('admin/absence')->with('data', $data);
    }

    //Teacher
    public function editTeacher(){
        $data = DB::table('GURU AS GU')
            ->join('USERS AS US','GU.ID_USER','=','US.ID')
            ->select('US.*', 'GU.alamat', 'GU.telepon', 'GU.nomor_pegawai')->get();
        return view('admin/teacher')->with('data', json_decode(json_encode($data)));
    }
    public function addTeacher(Request $request){
        if ($this->userValidation($request)){
            $token = (new Token())->Unique('users', 'token_first_login', 20);
            $data = User::create([
                'name'=>$request->post('name'),
                'username'=>$request->post('username'),
                'password'=> Hash::make($token),
                'token_first_login'=> $token,
            ]);
            Guru::create([
                'id_user'=>$data->id,
                'nomor_pegawai'=>$request->post('nomor_pegawai'),
                'telepon' => $request->post('telepon'),
                'alamat'=>$request->post('alamat'),
            ]);
            $data->attachRole(Role::find(2));
            $data->save();
        }
        return redirect()->route('admin.teacher');
    }
    public function updateTeacher(Request $request){
        if ($this->userValidation($request)) {
            $data = User::where('id_user', '=', $request->id)->update([
                'name' => $request->name,
                'username' => $request->username,
            ]);
            Guru::where('id_user', '=', $request->id)->update([
                'id_user' => $data->id,
                'nomor_pegawai' => $request->nomor_pegawai,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
            ]);
        }
        return redirect()->route('admin.teacher');
    }
    public function deleteTeacher(Request $request){
        User::where('id','=',$request->id)->delete();
        return redirect()->route('admin.teacher');
    }
    public function importFile(Request $request){
        if($request->hasFile('file_upload')){
            $path = $request->file('file_upload')->getRealPath();
            $data = Excel::load($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = ['title' => $value->title, 'body' => $value->body];
                }
            }
        }
        return response()->json([
            'status'=>'OK',
            'data'=>$data
        ]);
    }
    public function  userValidation($request){
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'username'=> 'required|unique:users',
            'nomor_pegawai'=> 'required|unique:guru',
            'telepon' => 'required',
            'alamat'=> 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('admin.teacher')
                ->withErrors($validator)
                ->withInput();
        }
        return true;
    }

    //Student
    public function editStudent(){
        $data['data_student'] = Siswa::all();
        $data['data_class'] = Kelas::all();
        return view('admin/student')
            ->with('data_student', json_decode(json_encode($data['data_student'])))
            ->with('data_class', json_decode(json_encode($data['data_class'])));
    }
    public function addStudent(Request $request){
        if ($this->userValidation($request)){
            Siswa::create($request->all());
        }
        return redirect()->route('admin.student');
    }

    public function updateStudent(Request $request){
        Siswa::where('id', '=', $request->id)->update([
            'nomor_pelajar'=>$request->nomor_pelajar,
            'nama'=>$request->nama,
            'telepon'=>$request->telepon,
            'alamat'=>$request->alamat,
            'id_kelas'=>$request->id_kelas,
        ]);
        return redirect()->route('admin.student');
    }

    public function deleteStudent(Request $request){
        if ($this->userValidation($request)){
            Siswa::where('id', '=', $request->id)->delete();
        }
        return redirect()->route('admin.student');
    }

    //Status Absence
    public function setAbsence(){
        StatusAbsensi::create([
            'tanggal'=>date('Y-m-d'),
            'status'=>'buka'
        ]);
        return redirect()->route('home');
    }

    //Time
    public function editTime(){
        $data = Jam::all();
        return view('admin/time')->with('data', $data);
    }
    public function addTime(Request $request){
        Jam::create($request->all());
        return redirect()->route('admin.time');
    }
    public function updateTime(Request $request){
        Jam::where('id', '=', $request->id)->update([
            'jam'=>$request->jam,
        ]);
        return redirect()->route('admin.time');
    }
    public function deleteTime(Request $request){
        if ($this->userValidation($request)) {
            Jam::where('id', '=', $request->id)->delete();
        }
        return redirect()->route('admin.time');

    }

}
