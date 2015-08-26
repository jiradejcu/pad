<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class StatisticController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $patients = $this->overviewStatistic();
        return view('statistic.index', compact('patients'));
    }

    public function overviewStatistic()
    {
        $sql = "SELECT type, COUNT(HN) AS cnt, SUM(is_male)/COUNT(HN) AS percent_male, AVG(age) AS avg_age, AVG(apache_ii) AS avg_apache_ii";
        $sql .= ", SUM(septic_shock)/COUNT(HN) AS percent_septic_shock, SUM(cardiogenic_shock)/COUNT(HN) AS percent_cardiogenic_shock";
        $sql .= ", SUM(aki)/COUNT(HN) AS percent_aki, SUM(death)/COUNT(HN) AS percent_death, SUM(ards)/COUNT(HN) AS percent_ards";
        $sql .= ", AVG(icu_stay) AS avg_icu_stay, AVG(hospital_stay) AS avg_hospital_stay";
        $sql .= " FROM (SELECT p.HN, IF(p.sex='m',1,0) AS is_male, p.apache_ii, pa.age, pa.type, pa.septic_shock, pa.cardiogenic_shock, pa.aki, pa.death, pa.reason LIKE '%ARDS%' AS ards";
        $sql .= ", DATEDIFF(pa.icu_admission_date_to, pa.icu_admission_date_from) AS icu_stay";
        $sql .= ", DATEDIFF(pa.hospital_admission_date_to, pa.hospital_admission_date_from) AS hospital_stay";
        $sql .= " FROM patient p JOIN patient_admission pa USING(HN) WHERE p.apache_ii IS NOT NULL) A";
        $sql .= " WHERE icu_stay > 0 GROUP BY type";
        $patients = DB::select($sql);
        return $patients;
    }

}
