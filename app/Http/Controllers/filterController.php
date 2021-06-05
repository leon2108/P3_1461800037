<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;

class filterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cari(Request $req)
    {
         $data = DB::table('guru')
                    ->select('id','nama','mengajar')
                    ->where(function ($q) use ($req) {
                        $q->orWhere('nama','like','%'. $req->id.'%');
                        $q->orWhere('mengajar','like','%'. $req->id.'%');
                    })
                    ->get();
        return Response::json(['hasil'=>$data]);
    }

    public function simpan(Request $req)
    {
         if ($req->id == null) {

                DB::table('guru')->insert([
                    'id'=>DB::table('guru')->max('id') + 1,
                    'nama'=>$req->nama,
                    'mengajar'=>$req->mengajar,
                ]);

            return Response::json(['hasil'=>'1']);
         }else{

                DB::table('guru')->where('id',$req->id)->update([
                    'nama'=>$req->nama,
                    'mengajar'=>$req->mengajar,
                ]);

            return Response::json(['hasil'=>'1']);
         }
    }

    public function hapus(Request $req)
    {
         $data = DB::table('guru')
                    ->where('id',$req->id)
                    ->delete();

        return Response::json(['hasil'=>'1']);
    }


}
