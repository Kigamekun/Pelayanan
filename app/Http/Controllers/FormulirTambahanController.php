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

class FormulirTambahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.formulirtambahan', [
            'data' => DB::table('formulirtambahan')->get()
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
            'formulir' => 'required',
        ]);


        if ($request->hasFile('formulir')) {
            $file = $request->file('formulir');
            $thumbname = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/formulirtambahan' . '/', $thumbname);
            DB::table('formulirtambahan')->insert([
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
            $file->move(public_path() . '/formulirtambahan' . '/', $thumbname);
            DB::table('formulirtambahan')->where('id',$id)->update([
                'formulir' => $thumbname,
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

        DB::table('formulirtambahan')->where('id',$id)->delete();
        return redirect()->route('admin.formulirtambahan.index')->with(['message'=>'Banner berhasil di delete','status'=>'success']);
    }

    public function download($id)
    {

        $file = public_path() . "/formulirtambahan/".DB::table('formulirtambahan')->where('id',$id)->first()->formulir;
        $headers = array('Content-Type: text/html',);

        return Response::download($file, 'formulir', $headers);
    }

}
