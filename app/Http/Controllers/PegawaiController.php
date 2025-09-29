<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class PegawaiController extends Controller
{
    public function index()
    {
        $name = "Aditya De Foeng";


        $birthDate = new \DateTime('2005-02-01');
        $today = new \DateTime();


        $hobbies = ["Gym", "Berenang", "Tidur", "Main", "Jalan-jalan"];


        $tglHarusWisuda = new \DateTime('2028-07-01');
        $currentSemester = 4;
        $futureGoal = "BE RICHHHHHHHHHHHHHHHH!!!!!!!!!!!!!!";


        $ageInterval = $today->diff($birthDate);
        $myAge = $ageInterval->y;


        $daysLeft = $today->diff($tglHarusWisuda);
        $timeToStudyLeft = $daysLeft->days;


        $semesterInfo = $currentSemester < 3
            ? "Masih Awal, Kejar TAK"
            : "Jangan main-main, kurang-kurangi main game!";


        return view('pegawai', [
            'name' => $name,
            'my_age' => $myAge,
            'hobbies' => $hobbies,
            'tgl_harus_wisuda' => $tglHarusWisuda->format('Y-m-d'),
            'time_to_study_left' => $timeToStudyLeft,
            'current_semester' => $currentSemester,
            'semester_info' => $semesterInfo,
            'future_goal' => $futureGoal,
        ]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}




