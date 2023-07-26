<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;
use LDAP\Result;

class TiketController extends Controller
{


    public function index()
    {
        return view('content.tikets.tikets', [
            'title' => "Tikets"
        ]);
    }


    public function getTikets()
    {
        $show = request('show');
        $search = request('search');
        if (request('search')) {
            $data = Tiket::where('nama', 'like', '%' . $search . '%')->paginate($show);
        } else {
            $data = Tiket::paginate($show);
        }
        return response()->json($data);
    }


    public function getTotal()
    {
        $dataTotal = Tiket::all()->count();
        $dataChekIn = Tiket::where('status', true)->count();
        $belumChekIn = $dataTotal - $dataChekIn;
        return response()->json(['totalTiket' => $dataTotal, 'totalChekIn' => $dataChekIn, 'belumChekIn' => $belumChekIn]);
    }


    public function getTiket()
    {
        $idTiket = request('id');
        $data = Tiket::where('idTiket', $idTiket)->get();
        $status = $data->pluck('status');
        $count = $data->count();
        if ($count == 1) {
            if ($status[0] == '0') {
                return response()->json([$data, 'massage' => 'ID Tiket terkonfirmasi!', 'alert' => 'success']);
            } else {
                return response()->json(['massage' => 'ID Tiket sudah chek-in!', 'alert' => 'warning']);
            }
        } else {
            return response()->json(['massage' => 'ID Tiket tidak valid!', 'alert' => 'warning']);
        }
    }


    public function editTiket()
    {
        $idTiket = request('id');
        $data = Tiket::where('idTiket', $idTiket)->get();
        return response()->json($data);
    }


    public function updateTiket()
    {
        $data = [];
        Tiket::where('idTiket', request('idTiket'))->update([
            'nama' => request('nama'),
            'email' => request('email'),
            'nomer_hp' => request('nomer_hp'),
            'alamat' => request('alamat')
        ]);
    }


    public function postTiket()
    {
        $tgl = date('ymd');
        $getId = Tiket::get('idTiket')->last();
        if ($getId) {
            $id = $getId['idTiket'];
        } else {
            $id = '';
        }
        $subTgl = substr($id, 0, 6);
        if ($subTgl != $tgl) {
            $subId = 0;
        } else {
            $subId = substr($id, 6, 3);
        }
        $idNext = $subId + 1;
        $count = strlen($idNext);
        if ($count == 1) {
            $nol = '00';
        } elseif ($count == 2) {
            $nol = '0';
        } elseif ($count == 3) {
            $nol = '';
        }
        Tiket::create([
            'idTiket' => $tgl . $nol . $idNext,
            'nama' => request('nama'),
            'email' => request('email'),
            'nomer_hp' => request('nomer_hp'),
            'alamat' => request('alamat'),
            'status' => false
        ]);
    }


    public function putTiket()
    {
        Tiket::where('id', request('id'))->update(['status' => true]);
    }


    public function deleteTiket()
    {
        Tiket::destroy(request('id'));
    }
}
