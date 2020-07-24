<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\wisata;

class PageController extends Controller
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
                    ->select('kunjungans.*','wisatas.nama as namawisata', 'wisatas.kapasitas as kapasitas')
                    ->get();
        
        $categories = [];
        $data = [];
        foreach($kunjungans as $kunjung){
            $categories[] = $kunjung->namawisata;
            if($kunjung->created_at == '2020-07-01'){
                $data[] = ($kunjung->jumlah / $kunjung->kapasitas) * 100;
            }
        }
        
        //dd($data);
        //dd(json_encode($categories));
        return view('index', ['kunjungans' => $kunjungans, 'categories' => $categories, 'data' => $data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexwisata()
    {
        $wisata = wisata::all();
        return view('datawisata', ['wisatas' => $wisata]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexajuan()
    {
        $ajuans = DB::table('ajuans')
                ->join('wisatas','ajuans.idwisata','=','wisatas.id')
                ->select('ajuans.*','wisatas.nama as namawisata')
                ->get();
        return view('dataajuan', ['ajuans' => $ajuans]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \App\wisata $wisata
     * @return \Illuminate\Http\Response
     */
    public function show(wisata $wisata)
    {
        $kunjungans = DB::table('kunjungans')
                ->join('wisatas','kunjungans.idwisata','=','wisatas.id')
                ->select('kunjungans.*','wisatas.kapasitas as kapasitaswisata')
                ->get();
        $reviews = DB::table('reviews')->get();
        $ajuans = DB::table('ajuans')->get();
        return view('detail',compact('wisata'), ['kunjungans' => $kunjungans, 'reviews' => $reviews, 'ajuans' => $ajuans]);
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

    public function search(Request $request)
	{
		// menangkap data pencarian
		$search = $request->get('search');
 
    	// mengambil data dari table pegawai sesuai pencarian data
		$wisatas = DB::table('wisatas')
        ->where('nama','like','%'.$search.'%')
		->paginate(5);
 
    		// mengirim data pegawai ke view index
		return view('datawisata',['wisatas' => $wisatas]);
 
    }
    
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  \App\ajuan $ajuan
     * @return \Illuminate\Http\Response
     */
    public function terima(Request $request, ajuan $ajuan)
    {
        ajuan::where('id', $ajuan->id)
                ->update([
                    'status' => 'diterima'
                ]);
        //return $request;
        return redirect('/dataajuan');
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  \App\ajuan $ajuan
     * @return \Illuminate\Http\Response
     */
    public function tolak(Request $request, ajuan $ajuan)
    {
        ajuan::where('id', $ajuan->id)
                ->update([
                    'status' => 'ditolak'
                ]);
        //return $request;
        return redirect('/dataajuan');
    }

}
