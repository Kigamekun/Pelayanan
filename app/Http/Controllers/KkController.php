<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kk', [
            'data' => DB::table('kk')->get()
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
            'no_kk' => 'required',
        ]);

        DB::table('kk')->insert([
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
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


        DB::table('kk')->where('id',$id)->update([
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
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

        DB::table('kk')->where('id',$id)->delete();
        return redirect()->route('admin.kk.index')->with(['message'=>'Banner berhasil di delete','status'=>'success']);
    }
}
