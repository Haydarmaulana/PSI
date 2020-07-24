<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\wisata;
use App\ajuan;

class OwnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kunjungans = DB::table('kunjungans')
                    ->join('wisatas','kunjungans.idwisata','=','wisatas.id')
                    ->select('kunjungans.*', 'wisatas.kapasitas as kapasitas')
                    ->get();
        $reviews = DB::table('reviews')->get();

        $categories = [];
        $data = [];
        foreach($kunjungans as $kunjung){
            if($kunjung->idwisata == 1){
                $categories[] = $kunjung->created_at;
                $data[] = $kunjung->jumlah;
            }
        }

        return view('dasbor', ['kunjungans' => $kunjungans, 'reviews' => $reviews, 'categories' => $categories, 'data' => $data]);
    }

    public function indexajuan()
    {
        $ajuans = DB::table('ajuans')->get();
        return view('ajuanuser', ['ajuans' => $ajuans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addajuan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ajuan = new ajuan;
        $ajuan->keluhan = $request->keluhan;
        $ajuan->idwisata = 1;
        $ajuan->save();

        return redirect('/ajuan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        DB::table('ajuans')->where('id',$id)->delete();
	    return redirect('/ajuan');
    }

    public function about()
    {
        $wisatas = DB::table('wisatas')->get();
        return view('about', ['wisatas' => $wisatas]);
    }

}
