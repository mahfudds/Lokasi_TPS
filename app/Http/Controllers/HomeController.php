<?php

namespace App\Http\Controllers;
use App\User;
use App\dpt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Exports\DptExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use ConsoleTVs\Charts\Classes\Chartjs\Plugins;
use App\Imports\DptImport;
use Illuminate\Support\Facades\View;


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

      function buatuserppk()
    {
        $distinctKodeKelurahan = dpt::distinct('Kecamatan')->pluck('Kecamatan');

        foreach ($distinctKodeKelurahan as $Kode_Kelurahan) {
            $email = $Kode_Kelurahan . '@kpungawi.go.id';
            $password = '24febrruari2024yes3kali';

            // Check if the user already exists
            if (!User::where('email', $email)->exists()) {
                // Create a new user
                $user = new User();
                $user->name = 'User ' . $Kode_Kelurahan;
                $user->email = $email;
                $user->Kecamatan = $Kode_Kelurahan;
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

    public function import(Request $request)
    {
        $file = $request->file('file');

        try {
            Excel::import(new DptImport(), $file);

            // You can add any additional logic or redirect the user to a success page
            return redirect()->back()->with('success', 'Data imported successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions that occurred during the import process
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while importing data.');
        }
    }

    public function showImportQueries()
    {
        $queries = DB::getQueryLog();
        return View::make('import.queries', compact('queries'));
    }
}
