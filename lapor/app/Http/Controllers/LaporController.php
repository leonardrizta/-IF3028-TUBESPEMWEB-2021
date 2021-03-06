<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\Lapor;
use App\Models\Comment;
use App\Models\SetCities;
use App\Models\SetLibraries;
use App\Models\SetProvinces;

class LaporController extends Controller
{
    
    public function index()
    {
        $listLokasi = SetCities::orderBy('name', 'asc')->get();
        $listInstansi = SetProvinces::orderBy('name', 'asc')->get();
        $listKategori = SetLibraries::where('category_id', '13')->orderBy('name', 'asc')->get();
        return view('lapor.page.landing')->with([
            'listLokasi' => $listLokasi,
            'listInstansi' => $listInstansi,
            'listKategori' => $listKategori
        ]);
    }

    public function postLapor(request $input)
    {
        $this->validate($input, [
            'title'                 => 'required',
            'laporan'               => 'required|min:20',
            'tgl_kejadian'          => 'required',
            'location'          => 'required',
            'instansi_tujuan'          => 'required',
            'category'          => 'required',
        ]);

        $lapor                          = new Lapor;
        $lapor->laporan_type_id         = $input->type_laporan;
        $lapor->title                   = $input->title;
        $lapor->laporan                 = $input->laporan;
        $lapor->tgl_kejadian            = $input->tgl_kejadian;
        $lapor->instansi_tujuan_id      = $input->instansi_tujuan;
        $lapor->category_id             = $input->category;
        $lapor->anonim                  = $input->anonim;
        $lapor->rahasia                 = $input->rahasia; 
        $lapor->location_id             = $input->location;
        $lapor->user_id                 = 1;
        $lapor->status_id               = 1201;

        // return $lapor;
        
        if($lapor->save()){
            // return "berhasil";
            return redirect()->back()->with('success', 'Berhasil insert data');
        } else return redirect()->back()->with('success', 'Berhasil insert data');

    }

    public function listView()
    {
        $listLokasi = SetCities::orderBy('name', 'asc')->get();
        $listInstansi = SetProvinces::orderBy('name', 'asc')->get();
        $listKategori = SetLibraries::where('category_id', '13')->orderBy('name', 'asc')->get();
        $listLapor = Lapor::orderBy('created_at', 'desc')->get();
        return view('Lapor.page.listLapor')->with([
            'listLapor' => $listLapor,
            'listLokasi' => $listLokasi,
            'listInstansi' => $listInstansi,
            'listKategori' => $listKategori
        ]);
    }

    public function viewLapor($id)
    {
        $listLapor = Lapor::where('id', $id)->first();
        $listComment = Comment::where('lapor_id', $id)->get();
        return view('Lapor.page.viewLapor')->with([
            'listLapor' => $listLapor,
            'listComment' => $listComment
        ]);
    }

    public function viewSearch(Request $search)
    {
        $cari = $search->q;
        $listSearch = Lapor::where('title', 'regexp', $cari)->get();
        // print_r($listSearch);
        // print_r($listSearch[0]->libraries_status_id);
        return view('Lapor.page.search')->with([
            'queue' => $cari,
            'listSearch' => $listSearch
        ]);
    }

    public function instansiListView()
    {
        return view('Lapor.page.instansiListView');
    }

}
