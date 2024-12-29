<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\DataSekolah;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GuestController extends Controller
{
    public function index()
    {
        return view('guest.index', [
            'data' => DataSekolah::latest()->first(),
            'galleries' => Gallery::all()
        ]);
    }

    public function contact(Request $request)
    {    
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'email' => 'required',
                'pesan' => 'required',
                
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Masukkan data');
            }
    
            Contact::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'pesan' => $request->pesan,
            ]);
    
            return redirect()->back()->with('success', 'Pesan berhasil terkirim');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal mengirim pesan'. $th->getMessage());   
        }
    }
}
