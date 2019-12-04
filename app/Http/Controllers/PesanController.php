<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram;

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
}
