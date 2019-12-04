<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram;

class ActivateJadwal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activate:jadwal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate jadwal daily in the morning.';

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
        //
        \Log::info("Cron berjalan dengan baik.");

        $haris = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $day = date('w');
        $today = $haris[$day];
        $date = date('Y-m-d');

        // Lihat Mapel Hari ini
        $jadwals = 'App\Jadwal'::where(['hari' => $today, 'status' => 'aktif'])->get(); 
        if($jadwals->count() < 1) {
            return response()->json(['status'=>'kosong', 'msg' => 'Hari ini jadwal kosong.']);
        } else {
            try {
                foreach($jadwals as $jadwal) {
                    $kode_absen = $today.'_'.$date.'_'.$jadwal->guru_id.'_'.$jadwal->mapel_id.'_'.$jadwal->rombel_id.'_'.$jadwal->jamke;
                    \App\LogAbsen::create([
                        'kode_absen' => $kode_absen,
                        'hari' => $today,
                        'tanggal' => $date,
                        'guru_id' => $jadwal->guru_id,
                        'mapel_id' => $jadwal->mapel_id,
                        'rombel_id' => $jadwal->rombel_id,
                        'jamke' => $jadwal->jamke,
                        'jml_siswa' => 0,
                        'hadir' => 0,
                        'ijin' => 0,
                        'sakit' => 0,
                        'alpa' => 0,
                        'telat' => 0,
                        'jurnal' => 0,
                        'ket' => 'jamkos',
                        'isActive' => 1
                    ]);
                }

                $msg = 'Jadwal Absensi hari '.$today.' telah diaktifkan. Maaf. Uji Coba.';
                $kirim_telegram = $this->sendTelegram($msg);
                $this->info('Activate:Jadwal Command Run Successfully');
            } catch(\Exception $e)
            {
                if($e->getCode() == '23000') {
                    $this->info('Jadwal hari ini sudah ditutup. Mohon hubungi admin untuk mengaktifkan kembali.');
                } else {
                    $this->info($e->getCode().' : '.$e->getMessage());
                }
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
