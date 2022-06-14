<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'nama' => 'required',
            'syarat' => 'required',
        ]);

        DB::table('kk')->insert([
            'nama' => $request->nama,
            'syarat' => $request->syarat,
        ]);

        return redirect()->back()->with(['message'=>'KK berhasil ditambahkan','status'=>'success']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KK  $plant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        DB::table('kk')->where('id',$id)->update([
            'nama' => $request->nama,
            'syarat' => $request->syarat,
        ]);



        return redirect()->back()->with(['message'=>'KK berhasil di update','status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KK  $plant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('kk')->where('id',$id)->delete();
        return redirect()->route('admin.kk.index')->with(['message'=>'KK berhasil di delete','status'=>'success']);
    }
}
