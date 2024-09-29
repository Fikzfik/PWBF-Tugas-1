<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\jenisUser;
use App\Models\User;
use App\Models\Menu;
use App\Models\Message;
use App\Models\MessageTo;
use App\Models\MessageDokumen;
use App\Models\MessageKategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class EarthquakeController extends Controller
{
    public function index(Request $request)
    {
        $id_jenis_user = auth()->user()->id_jenis_user;
        $menususer = auth()->user()->jenisUser->menus()->whereNull('parent_id')->get();
        $submenus = auth()->user()->jenisUser->menus()->whereNotNull('parent_id')->get();
        $users = User::where('id_jenis_user', '!=', 1)->get();
        $jenis_user = JenisUser::all();
        $response = Http::get('https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_day.geojson');
        $earthquakes = $response->json()['features'];
        $earthquakes = array_map(function ($quake) {
            return [
                'Wilayah' => $quake['properties']['place'],
                'Magnitude' => $quake['properties']['mag'],
                'Tanggal' => date('Y-m-d', $quake['properties']['time'] / 1000),
                'Jam' => date('H:i:s', $quake['properties']['time'] / 1000),
                'Lintang' => $quake['geometry']['coordinates'][1],
                'Bujur' => $quake['geometry']['coordinates'][0],
            ];
        }, $earthquakes);
        if ($request->has('city') && $request->city != '') {
            $earthquakes = $this->filterEarthquakesByCity($earthquakes, $request->city);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'earthquakes' => $earthquakes,
                'users' => $users,
                'menususer' => $menususer,
                'submenus' => $submenus,
                'jenis_user' => $jenis_user,
            ]);
        }

        return view('earthquake.index', [
            'earthquakes' => $earthquakes, // Mengirim data gempa ke view
            'users' => $users,
            'menususer' => $menususer,
            'submenus' => $submenus,
            'jenis_user' => $jenis_user,
        ]);
    }

    // Fungsi untuk memfilter data gempa berdasarkan kota
    private function filterEarthquakesByCity($earthquakes, $city)
    {
        return array_filter($earthquakes, function ($earthquake) use ($city) {
            return str_contains(strtolower($earthquake['Wilayah']), strtolower($city));
        });
    }
}
