<?php

namespace App\Http\Controllers;

use App\Models\Grave;
use App\Models\Relative;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GraveController extends Controller
{

    public function __construct()
    {
        $this->middleware('user')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Home';

        if (request('search')) {
            $title = 'Hasil pencarian ' . request('search');
        }

        return view('home', [
            'title' => $title,
            'graves' => Grave::search(request('search'))->orderBy('nama')->paginate(15),
            'tools' => true,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("create", [
            'title' => 'Data Baru',
            'days' => static::tanggal(),
            'months' => static::bulan(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        static::validation($request, null);

        // dd($request->all());

        $tgl_lahir = '';
        $tgl_wafat = '';

        if ($request->input('tgl_lahir.0')) {
            $tgl_lahir = implode(' ', $request->input('tgl_lahir', [])) . '年';
        } else {
            $tgl_lahir = null;
        }

        $tgl_wafat = implode(' ', $request->input('tgl_wafat', []))  . '年';

        $image = $request->image;

        if ($image) {
            $image = $request->image->store('file-image');
        }

        $grave = Grave::create([
            'nama' => $request->nama,
            'blok' => $request->blok,
            'image' => $image,
            'tgl_lahir' => $tgl_lahir,
            'tgl_wafat' => $tgl_wafat,
        ]);

        $relatives = array_combine($request->nama_kerabat, $request->status);

        foreach ($relatives as $nama_kerabat => $status) {
            $grave->relatives()->create([
                'nama_kerabat' => $nama_kerabat,
                'status' => $status,
            ]);
        }

        return redirect('/')->with('success', 'Data berhasil ditambahkan !');
    }

    public function tanggal()
    {
        $tanggal = [];

        // Fungsi untuk mengonversi angka ke karakter Mandarin
        function toChineseNumber($number)
        {
            $chineseNumbers = ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十"];
            if ($number <= 10) {
                return '初' . $chineseNumbers[$number - 1] . '日';
            } else {
                $tenDigit = floor($number / 10);
                $unitDigit = $number % 10;

                $tenStr = ($tenDigit > 1) ? $chineseNumbers[$tenDigit - 1] : '十';
                $unitStr = ($unitDigit > 0) ? $chineseNumbers[$unitDigit - 1] . '日' : '十日';

                return $tenStr . $unitStr;
            }
        }

        for ($i = 1; $i <= 30; $i++) {
            $tanggal[] = toChineseNumber($i);
        }

        return $tanggal;
    }

    public function bulan()
    {
        return ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"];
    }

    public function validation($request, $id)
    {
        // dd($request->all());
        $rules = [
            'nama' => 'required|regex:/[a-z]+/',
            'tgl_lahir.0' => 'required_with:tgl_lahir.2,tgl_lahir.1',
            'tgl_lahir.1' => 'required_with:tgl_lahir.0,tgl_lahir.2',
            'tgl_lahir.2' => 'required_with:tgl_lahir.0,tgl_lahir.1|nullable|numeric',
            'tgl_wafat.*' => 'required',
            'tgl_wafat.2' => 'nullable|numeric',
            'status.*' => 'required',
        ];

        $errorMessage = [
            'nama' => 'Nama minimal ada huruf alfabet',
            'blok.required' => 'Blok harus diisi',
            'blok.unique' => 'Blok ini sudah digunakan',
            'tgl_lahir.2.numeric' => 'Tahun harus berupa angka',
            'tgl_wafat.2.numeric' => 'Tahun harus berupa angka',
            'tgl_wafat.*' => 'Tanggal wafat harus diisi.',
            'tgl_lahir.*' => 'Jika salah satu diisi semua harus diisi',
            'status.*' => 'Kolom status harus diiisi'
        ];

        $grave = Grave::find($id);

        if ($grave) {
            if ($request->input('blok') !== $grave->blok) {
                $rules['blok'] = 'required|unique:graves,blok,NULL,id,deleted_at,NULL';
            }
        } else {
            $rules['blok'] = 'required|unique:graves,blok,NULL,id,deleted_at,NULL';
        }

        // Untuk mengfilter elemen array yang kosong
        $filteredKerabat = array_filter($request->nama_kerabat);

        // Hanya mengambil elemen status yang nama_kerabatnya tidak kosong
        $filteredStatus = array_intersect_key($request->status, $filteredKerabat);

        try {
            $filteredId = array_intersect_key($request->id_kerabat, $filteredKerabat);
        } catch (Error $error) {
            $filteredId = [];
        }

        $request['nama_kerabat'] = $filteredKerabat;
        $request['status'] = $filteredStatus;
        $request['id_kerabat'] = $filteredId;

        $request->validate($rules, $errorMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Grave $grave)
    {
        return view('grave', [
            'title' => $grave->nama,
            'grave' => $grave,
            'relatives' => $grave->relatives,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $grave = Grave::find($id);

        $tgl_lahir = strtr($grave->tgl_lahir, ['年' => '']);
        $tgl_wafat = strtr($grave->tgl_wafat, ['年' => '']);
        $tgl_lahir = explode(' ', $tgl_lahir);

        return view('update', [
            'title' => 'Edit Data',
            'grave' => $grave,
            'days' => static::tanggal(),
            'months' => static::bulan(),
            'tgl_lahir' => array_pad($tgl_lahir, 3, null),
            'tgl_wafat' => explode(' ', $tgl_wafat),
            'relatives' => $grave->relatives,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        static::validation($request, $id);

        $tgl_lahir = '';
        $tgl_wafat = '';
        $grave = Grave::find($id);

        if ($request->input('tgl_lahir.0')) {
            $tgl_lahir = implode(' ', $request->input('tgl_lahir', [])) . '年';
        } else {
            $tgl_lahir = null;
        }

        $tgl_wafat = implode(' ', $request->input('tgl_wafat', []))  . '年';

        $data = [
            'nama' => $request->nama,
            'blok' => $request->blok,
            'tgl_lahir' => $tgl_lahir,
            'tgl_wafat' => $tgl_wafat,
        ];

        $image = $request->file('image');

        $oldImage = $grave->image;

        if ($image) {
            if ($oldImage) {
                Storage::delete($oldImage);
            }

            $data['image'] = $request->file('image')->store('file-image');;
        }

        $grave->update($data);

        // $relatives = array_combine($request->nama_kerabat, $request->status);

        $grave_id = $grave->relatives()->pluck('id')->toArray();
        $requestAndRelativeDiff = array_diff(array_map('strval', $grave_id), $request->id_kerabat);

        foreach ($requestAndRelativeDiff as $relative_id) {
            $relative = Relative::find($relative_id);
            if ($relative) {
                $relative->delete();
            }
        }

        foreach ($request->id_kerabat as $index => $relative_id) {
            $relative = Relative::find($relative_id);

            if ($relative) {
                $relative->update([
                    'nama_kerabat' => $request->nama_kerabat[$index],
                    'status' => $request->status[$index],
                ]);
            } else {
                Relative::create([
                    'grave_id' => $id,
                    'nama_kerabat' => $request->nama_kerabat[$index],
                    'status' => $request->status[$index],
                ]);
            }
        }

        if (!count($request->id_kerabat)) {
            foreach ($request->nama_kerabat as $index => $kerabat) {
                Relative::create([
                    'grave_id' => $id,
                    'nama_kerabat' => $kerabat,
                    'status' => $request->status[$index],
                ]);
            }
        }

        // foreach ($request->nama_kerabat as $id => $kerabat) {
        //     $relative = Relative::where('grave_id', $id)[$id];
        //     if ($relative) {
        //         $relative->update([
        //             'nama_kerabat' => $kerabat,
        //             'status' => $relatives[$kerabat],
        //         ]);
        //     } else {
        //         Relative::create([
        //             'grave_id' => $id,
        //             'nama_kerabat' => $kerabat,
        //             'status' => $relatives[$kerabat],
        //         ]);
        //     }
        // }

        return redirect('/')->with('success', 'Data berhasil diperbaharui !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $grave = Grave::find($id);
        $grave->delete();

        return back()->with('success', "Data dengan dipindah ke penghapusan sementara !");
    }
}
