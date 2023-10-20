<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Laravel\Facades\Telegram;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contact.index', ['title' => 'Kontak', 'contact' => Contact::All()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create', ['title' => 'Tambah Kontak']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $data =  $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);

        try {
            Contact::create($data);
            DB::commit();
            return redirect('/contact')->with('success', 'Sukses di Simpan!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/contact')->with('success', 'Gagal di Update');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contact.edit', ['title' => 'Edit Kontak', 'contact' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        DB::beginTransaction();

        $data =  $request->validate([
            'name' => 'required',
            'phone' => 'required'
        ]);

        try {
            Telegram::sendMessage([
                'chat_id' => env('TELEGRAM_CHAT_ID'), // Ganti dengan chat ID Anda
                'text' => 'Data berhasil disimpan!'
            ]);

            Contact::where('id', $contact->id)->update($data);
            DB::commit();
            return redirect('/contact')->with('success-edit', 'Sukses di Update!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/contact')->with('success-edit', 'Gagal di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Contact::destroy($id);
            DB::commit();
            return response()->json([
                'message' => 'Sukses di Hapus',
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal di Hapus',
            ], 422);
        }
    }
}
