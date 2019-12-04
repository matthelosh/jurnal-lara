<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram;

class DeactivateJadwal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deactivate:jadwal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate Jadwal daily in the evening';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Log::info("Cron tutup jadwal berjalan dengan baik");
        $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $day = date('w');
        $today = $haris[$day];
        $date = date('Y-m-d');

        // Lihat Mapel Hari ini
        // $jadwals = 'App\Jadwal'::where(['hari' => $today, 'status' => 'aktif'])->get();
        try {
            $data = '';
            $ijins = '';

            $results = \App\LogAbsen::where(['tanggal' => $date, 'ket' => 'jamkos'])->get();
            foreach($results as $result)
            {
                $data .= $result->gurus->fullname.' '.$result->rombels->nama_rombel.' '.$result->jamke."\n";
            }

                $gijins = \App\LogAbsen::where(['tanggal' => $date, 'ket' => 'ijin'])->get();

            foreach($gijins as $gijin)
            {
                $ijins .= $gijin->gurus->fullname.' '.$gijin->rombels->nama_rombel.' '.$gijin->jamke."\n";
            }

            $cek = \App\LogAbsen::where(['tanggal' => $date, 'isActive' => '0'])->get();
            if($cek->count() > 0 ) {
                return response()->json(['status' => 'sukses', 'msg' => 'Jadwal Sudah ditutup']);
            } else {

                \App\LogAbsen::where('tanggal', $date)->update([
                    'isActive' => '0'
                ]);
                
                $msg = "<b>Maaf!, Uji coba ;) </b> \nJadwal Absensi hari ".$today.", ".date('d-m-Y'). " telah ditutup. \nGuru yang tidak melakukan absensi: \n".$data."\n \nGuru yang ijin: \n".$ijins;
                $this->sendTelegram($msg);

                $this->info('Deactivate:Jadwal Command run successfully');
            }
        } catch (\Exception $e)
        {
            if($e->getCode() == 400) {
                $this->info('Jadwal hari ini sudah ditutup. Tapi ada beberapa nomor telegram yang tidak aktif.');
            } else {
                $this->info($e->getCode().' : '.$e->getMessage());
            }
        }
    }


    public function sendTelegram($msg)
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
}
