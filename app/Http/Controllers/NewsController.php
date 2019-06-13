<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\News;
use DB; 

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $post = new StudentImportOrg;
    }

    public function readFromFile()
    {
        $sTime=microtime();
        $contents = Storage::disk('public')->get('183627.txt');
        $contentJSON=json_decode($contents);
        // dd($contentJSON);
        foreach ($contentJSON as $content) {
            $student_import_org_basic=$content->基本資料;
            $student_import_org_basic_string=json_encode($student_import_org_basic,JSON_UNESCAPED_UNICODE);

            $student_import_org_regs=$content->學籍資料; //多筆
            $student_import_org_regs_string=json_encode($student_import_org_regs,JSON_UNESCAPED_UNICODE);

            if (property_exists($content,'輔導資料')) {
                $student_import_org_counseling=$content->輔導資料;
                $student_import_org_counseling_string=json_encode($student_import_org_counseling,JSON_UNESCAPED_UNICODE);
            }
            else $student_import_org_counseling_string="";

            if (property_exists($content,'期中資料')) {
                $student_import_org_current=$content->期中資料;  //多筆 
                $student_import_org_current_string=json_encode($student_import_org_current,JSON_UNESCAPED_UNICODE);
            }
            else $student_import_org_current_string="";
            //dd($student_import_org_basic);

            //寫入資料表 student_import_org
            $post = new News;
            $post->student_import_org_basic = $student_import_org_basic_string;
            $post->student_import_org_regs = $student_import_org_regs_string;
            $post->student_import_org_counseling = $student_import_org_counseling_string;
            $post->student_import_org_current = $student_import_org_current_string;            
            // $post->save();
            // exit;

        }
        $eTime=microtime();
        $wTime="$eTime-$sTime";
        // dd($wTime);
        // $contents = Storage::makeDirectory('test_20190612'); //D:\wagon\uwamp\www\ashan\storage\app\test_20190612
        // dd($contents);       
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        DB::insert('insert into `users` (`name`, `email`, `password`) values (?, ?, ?)', ['陳潔熙','jc861217@gmail.com','cc861217']);
    }


    public function storeByModel(Request $request)
    {
        $post = new News;
        $post->name = '李宜靜';
        $post->email = 'zing@hotmail.com';
        $post->password = '123456';
        $post->save();
    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $users = DB::table('users')->get();
        dd($users);
        // foreach($users as $user){
        //     return $user->name;
        // }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $updated = DB::update('update users set name = "林金山" where id=1');
        return $updated;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        $deleted = DB::delete('delete from users where id = 5');
        return $deleted;
    }
}
