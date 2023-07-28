<?php

namespace App\Http\Controllers;

use App\Models\employeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index(Request $request)
    {
        // get value search 
        $search = $request->get('search');
        $items = employeeModel::where('nama', 'like', '%' . $search . '%')->get();

        return view('employee.index', compact('items'));
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
        try {
            $item = employeeModel::findOrFail($id);
            return view('employee.edit', compact('item'));
        } catch (\Exception $e) {
            // Tampilkan pesan error jika terjadi kesalahan
            return redirect()->route('employee.index')->with('error', 'Gagal update data ' . $e->getMessage());
        }
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
        try {
            $item = employeeModel::findOrFail($id);

            $item->update([
                'nama' => $request->input('nama'),
                'jabatan' => $request->input('jabatan'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'alamat' => $request->input('alamat'),
            ]);

            // Tampilkan pesan success
            return redirect()->route('employee.index')->with('success', 'Data has been updated successfully.');
        } catch (\Exception $e) {
            // Tampilkan pesan error jika terjadi kesalahan
            return redirect()->route('employee.index')->with('error', 'Failed to update data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = employeeModel::findOrFail($id);
            $item->delete();

            // Tampilkan pesan success
            return redirect()->route('employee.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            // Tampilkan pesan error jika terjadi kesalahan
            return redirect()->route('employee.index')->with('error', 'Data gagal dihapus: ' . $e->getMessage());
        }
    }
    
    public function fetchAndSaveData(Request $request)
    {
        try {
            // Ambil data dari URL
            $response = Http::get($request->url);
            $data = $response->json();

            // Simpan data ke dalam database
            employeeModel::insert($data);

            // Tampilkan pesan success
            return redirect()->route('employee.index')->with('success', 'Data berhasil di save ke database.');
        } catch (\Exception $e) {
            // Tampilkan pesan error jika terjadi kesalahan
            return redirect()->route('employee.index')->with('error', 'Data sudah ada atau gagal di save ke database  ');
        }
    }

}
