<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Telegram;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function sendTelegram($msg)
    {
        $chatIds =  ['340074117','580331755', '318257876', '309322044', '249243957', '253088341', '301586792', /*P. Aziz '656236788', /*Pak Dwijo '264390241', /*B. Devi '329815907', /*P. AGung */ '827284422'];
        try {
            foreach($chatIds as $chatId)
            {
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => $msg
                ]);
            }
            return json_encode(['status' => 'sukses']);
        } catch(\Exception $e)
        {
            return json_encode(['status' => 'error', 'errorMessage' => $e->getMessage()]);
        }

    }

    protected function hari(){
        $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $tanggal = date('w');

        return $haris[$tanggal];
    }
}
