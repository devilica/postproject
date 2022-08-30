<?php

namespace App\Http\Controllers;

use App\Models\BlacklistUser;
use App\Models\Userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
class BlacklistUserController extends Controller
{




    public function index()
    {

        $lists = BlacklistUser::orderBy('id', 'desc')->paginate('20');

      

        return view('admin.blacklist.index',
            [
                'lists' => $lists,
               
            ]
        );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|regex:/^[\pL\s\-]+$/u|between:2,25',
            'birth_date' => 'nullable|date'
        ]);

        $user = new BlacklistUser();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        if ($request->birth_date != '') {
            $user->birth_date = $request->birth_date;
        } else {
            $user->birth_date = null;
        }
        $user->save();

        return back()->with('message', 'Successfully added user!');


    }


    public function editUser($id)
    {

        $user = BlacklistUser::find($id);

        return view('admin.blacklist.edit', [
            'user' => $user
        ]);

    }

    public function updateUser(Request $request, $id){
        $this->validate($request, [
            'firstname' => 'required|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|regex:/^[\pL\s\-]+$/u|between:2,25',
            'birth_date' => 'nullable|date'
        ]);
        $user = BlacklistUser::find($id);
        $user->firstname=$request->firstname;
        $user->lastname=$request->lastname;
        if($request->birth_date=='') {
            $user->birth_date=null;
        }else{
            $user->birth_date=$request->birth_date;
        }

        $user->save();

        return redirect('/blacklist')->with('message', 'Successfully updated user!');

    }

    public function destroy($id){
        $user = BlacklistUser::find($id);
        $user->delete();
        return back()->with('message', 'Successfully deleted user!');


    }

    public function uploadContent(Request $request)
    {
        $file = $request->file('uploaded_file');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $valid_extension = array("csv");
            $maxFileSize = 2097152;
            if (in_array(strtolower($extension), $valid_extension)) {
                if ($fileSize <= $maxFileSize) {

                    $location = 'uploads';

                    $file->move($location, $filename);

                    $filepath = public_path($location . "/" . $filename);
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {

                        $num = count($filedata);
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);
                    $j = 0;
                    foreach ($importData_arr as $importData) {
                        $j++;

                        try {

                            DB::beginTransaction();


                            if($importData[2]!='') {
                                BlacklistUser::create([
                                    'firstname' => $importData[0],
                                    'lastname' => $importData[1],
                                    'birth_date' => Carbon::parse($importData[2])->format('Y-m-d'),
                                ]);
                            }else{
                                BlacklistUser::create([
                                    'firstname' => $importData[0],
                                    'lastname' => $importData[1],
                                    'birth_date' => null,
                                ]);
                            }

                            DB::commit();
                        } catch (\Exception $e) {

                            DB::rollBack();
                        }
                    }

                    return back()->with('message', 'New users added on blacklist.');


                } else {
                    return back()->with('error', 'No file was uploaded.');

                }
            } else {

                return back()->with('error', 'Invalid file extension. Allowed file is CSV UTF-8(comma delimited).');


            }


        } else {
            return back()->with('error', 'No file uploaded.');
        }
    }





}