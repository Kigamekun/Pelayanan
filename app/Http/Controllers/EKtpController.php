<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EKtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ektp', [
            'data' => DB::table('ektp')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'nik' => 'required',
            'identitas' => 'required',
        ]);

        DB::table('ektp')->insert([
            'nik' => $request->nik,
            'identitas' => $request->identitas,
        ]);

        return redirect()->back()->with(['message'=>'Banner berhasil ditambahkan','status'=>'success']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $plant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        DB::table('ektp')->where('id',$id)->update([
            'nik' => $request->nik,
            'identitas' => $request->identitas,
        ]);



        return redirect()->back()->with(['message'=>'Banner berhasil di update','status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $plant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('ektp')->where('id',$id)->delete();
        return redirect()->route('admin.ektp.index')->with(['message'=>'Banner berhasil di delete','status'=>'success']);
    }
}
