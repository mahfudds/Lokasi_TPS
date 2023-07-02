<?php

namespace App\Http\Controllers;
use App\User;
use App\dpt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Exports\DptExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Process\Process;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    function buatuser()
    {
        $distinctKodeKelurahan = dpt::distinct('Kode_Kelurahan')->pluck('Kode_Kelurahan');

        foreach ($distinctKodeKelurahan as $Kode_Kelurahan) {
            $email = $Kode_Kelurahan . '@kpungawi.go.id';
            $password = '24febrruari2024';

            // Check if the user already exists
            if (!User::where('email', $email)->exists()) {
                // Create a new user
                $user = new User();
                $user->name = 'User ' . $Kode_Kelurahan;
                $user->email = $email;
                $user->Kode_Kelurahan = $Kode_Kelurahan;
                $user->password = Hash::make($password);
                $user->save();

                // Perform any additional actions for the generated user
                // ...
            }
        }
    }

    function export(){
        return Excel::download(new DptExport, 'tps.xlsx');
    }
    public function update()
    {
        // Git Clone Command
        $gitCloneCommand = "git clone https://github.com/mahfudds/Lokasi_TPS.git";
        exec($gitCloneCommand, $output1, $returnCode1);

        // Rsync Command
        $rsyncCommand = "rsync -av --ignore-existing Lokasi_TPS/* .";
        exec($rsyncCommand, $output2, $returnCode2);

        // Check the return codes for success or failure
        if ($returnCode1 === 0 && $returnCode2 === 0) {
            return view('home');
        } else {
            // Command execution failed
            // Handle the error
        }
    }
}
