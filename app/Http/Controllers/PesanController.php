<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram;
use Illuminate\Support\Facades\DB;

class PesanController extends Controller
{
    //

    public function cek(Request $request)
    {
        $updates = Telegram::getUpdates();
        foreach($updates as $update)
        {
           $text = $update['message']['text'];
           $chat_id = $update['message']['chat']['id'];
        //    $name = $update['message']['from']['firstname'].' '.$update['message']['from']['lastname'];
           $username = $update['message']['chat']['username'];
           $cek_w = explode($text, ' ');
        //    if($cek_w[0] == 'halo') {
        //        Telegram::sendMessage([
        //            'chat_id' => $chat_id,
        //            'text' => 'Halo juga '.$username
        //        ]);
        //        return response()->json(['status' => 'sukses', 'data' => $updates, 'msg' => 'Hanya menyapa']);
        //    } else if ($cek_w[0] == 'daftar') {
        //     //    Simpan chat_id ke database sesuai role-nya
        //         Telegram::sendMessage([
        //             'chat_id' => $chat_id,
        //             'text' => 'Yang terhormat '.$username.'. Data Anda sudah kami terima. Mohon tunggu konfirmasi dari kami. Jika waktu tunggu melebihi 24 jam, silahkan menghubungi admin / operator. ;) '
        //         ]);
        //    } else if ($cek_w[0] == 'ijin' ) {
        //     //    format ijin: ijin nip mapel rombel jamke ex: ijin 198407032019031007 A1 xtkj1 4-7
        //         $nip = $cek_w[1];
        //         $mapel = $cek_w[2];
        //         $rombel = $cek_w[3];
        //         $jamke = $cek_w[4];

        //         $jadwalku = \App\LogAbsen::where([
        //             'isActive' => 1,
        //             'guru_id' => $nip,
        //             'mapel_id' => $mapel,
        //             'rombel_id' => $rombel,
        //             'jamke' => $jamke
        //         ])->update('ket', 'mohon_ijin');

        //         Telegram::sendMessage([
        //             'chat_id' => $chat_id,
        //             'text' => 'Yang terhormat '.$username.'. Permohonan ijin sudah kami terima, mohon tunggu konfirmasi dari pemangku kepentingan.'
        //         ]);

        //    }
            return response()->json(['status' => 'sukses', 'msg' => 'data Updates', 'data' => $cek_w]);
        }
        // return response()->json(['status' => 'sukses', 'data' => $updates]);
    }

    public function kirimPesan(Request $request)
    {
        $chatIds = $request->input('chatIds');
        $text = $request->input('text');
        foreach($chatIds as $chatId) 
        {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => $text
            ]);
        }

        return response()->json(['status' => 'sukses', 'msg' => 'Pesan telah dikirmikan. ;)']);
    }

    public function sendSMS(Request $request)
    {
        // dd($request->all());
        try {
            DB::connection('mysql2')->insert('insert into outbox (DestinationNumber, CreatorID, TextDecoded) values(?,?, ?)',[$request->input('nomor'), 'Jurnal', $request->input('pesan')]); 

            return response()->json(['status' => 'sukses','msg' => 'Pesan Terkirim']);
        }catch(\Exception $e)
        {
            return response()->json(['status' => 'gagal', 'msg' => $e->getCode().':' .$e->getMessage()]);
        }
    }

    public function bulkOrtu(Request $request)
    {
        $rombel = 'App\Rombel'::where('guru_id', $request->user()->nip)->first();
        $siswas = 'App\Siswa'::where('rombel_id', $rombel->kode_rombel)->get();
        try {
            $nohp = [];
            foreach($siswas as $siswa)
            {
                if($siswa->hp != null) {
                    DB::connection('mysql2')->insert('INSERT INTO outbox (DestinationNumber, CreatorID, TextDecoded) VALUES (?,?,?)', [$siswa->hp, 'Jurnal', $request->input('pesan')]);
                } else {
                    array_push($nohp, $siswa);
                }
            }
            $msg = (count($nohp) > 0 ) ? 'Terkirim Semua' : count($nohp).' siswa, beluma ada nomor orang tua.';
            return response()->json(['status' => 'sukses', 'msg' => $msg]);
        } catch (\Exception $e) {
            return response()->json(['status', 'msg' => $e->getCode().': '.$e->getMessage()]);
        }
    }
    public function cekSMS(Request $request)
    {
        $pesans = DB::connection('mysql2')->select('SELECT * FROM inbox');
        // dd($pesans);
        foreach($pesans as $pesan)
        {
            DB::connection('mysql2')->insert('INSERT INTO outbox (DestinationNumber, CreatorID,TextDecoded) VALUES(?,?,?)', [ $pesan->SenderNumber, 'Jurnal', 'Pesan Anda telah diterima. Menunggu Proses Selanjutnya']);
        }
        return response()->json(['status' => 'sukses', 'data' => $pesans]);
    }
}
