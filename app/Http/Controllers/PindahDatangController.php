<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\{
    Hash,
    Auth,
    Mail,
    Response
};

class PindahDatangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pindahdatang', [
            'data' => DB::table('pindahdatang')->get()
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
            'formulir' => 'required',
        ]);


        if ($request->hasFile('formulir')) {
            $file = $request->file('formulir');
            $thumbname = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/pindahdatang' . '/', $thumbname);
            DB::table('pindahdatang')->insert([
                'nama' => $request->nama,
                'syarat' => $request->syarat,
                'formulir' => $thumbname,
            ]);
        }



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

        if ($request->hasFile('formulir')) {
            $file = $request->file('formulir');
            $thumbname = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/pindahdatang' . '/', $thumbname);
            DB::table('pindahdatang')->where('id',$id)->update([
                'nama' => $request->nama,
                'syarat' => $request->syarat,
                'formulir' => $thumbname,
            ]);
        }else {
            DB::table('pindahdatang')->where('id',$id)->update([
                'nama' => $request->nama,
                'syarat' => $request->syarat,

            ]);
        }



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

        DB::table('pindahdatang')->where('id',$id)->delete();
        return redirect()->route('admin.pindahdatang.index')->with(['message'=>'Banner berhasil di delete','status'=>'success']);
    }

    public function download($id)
    {

        $file = public_path() . "/pindahdatang/".DB::table('pindahdatang')->where('id',$id)->first()->formulir;
        $headers = array('Content-Type: text/html',);

        return Response::download($file, 'formulir', $headers);
    }
}
