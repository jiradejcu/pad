<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class StatisticController extends Controller
{

    public function index()
    {
        $patients = $this->patientOverviewStatistic();
        $padMedRecords = $this->patientPadMedStatistic();
        return view('statistic.index', compact('patients', 'padMedRecords'));
    }

    public function patientOverviewStatistic()
    {
        $sql = "SELECT type, COUNT(HN) AS cnt, SUM(is_male)/COUNT(HN) AS percent_male, AVG(age) AS avg_age, AVG(apache_ii) AS avg_apache_ii";
        $sql .= ", SUM(septic_shock)/COUNT(HN) AS percent_septic_shock, SUM(cardiogenic_shock)/COUNT(HN) AS percent_cardiogenic_shock";
        $sql .= ", SUM(adrenal_shock)/COUNT(HN) AS percent_adrenal_shock, SUM(hypovolemic_shock)/COUNT(HN) AS percent_hypovolemic_shock";
        $sql .= ", SUM(asthma_exacerbation)/COUNT(HN) AS percent_asthma_exacerbation, SUM(copd_exacerbation)/COUNT(HN) AS percent_copd_exacerbation";
        $sql .= ", SUM(aki)/COUNT(HN) AS percent_aki, SUM(death)/COUNT(HN) AS percent_death, SUM(ards)/COUNT(HN) AS percent_ards";
        $sql .= ", AVG(icu_stay) AS avg_icu_stay, AVG(hospital_stay) AS avg_hospital_stay";
        $sql .= " FROM (SELECT p.HN, IF(p.sex='m',1,0) AS is_male, p.apache_ii, pa.age, pa.type";
        $sql .= ", pa.septic_shock, pa.cardiogenic_shock, pa.adrenal_shock, pa.hypovolemic_shock";
        $sql .= ", pa.asthma_exacerbation, pa.copd_exacerbation";
        $sql .= ", pa.aki, pa.death, pa.reason LIKE '%ARDS%' AS ards";
        $sql .= ", DATEDIFF(pa.icu_admission_date_to, pa.icu_admission_date_from) AS icu_stay";
        $sql .= ", DATEDIFF(pa.hospital_admission_date_to, pa.hospital_admission_date_from) AS hospital_stay";
        $sql .= " FROM patient p JOIN patient_admission pa USING(HN) WHERE p.apache_ii IS NOT NULL) A";
        $sql .= " WHERE icu_stay > 0 GROUP BY type";
        return DB::select($sql);
    }

    public function patientPadMedStatistic()
    {
        $sql = "SELECT med_name, SUM(CASE type WHEN 'prospective' THEN avg_med_dose_day ELSE 0 END) AS prospective";
        $sql .= ", SUM(CASE type WHEN 'retrospective' THEN avg_med_dose_day ELSE 0 END) AS retrospective FROM (";

        $sql .= "SELECT type, med_name, format(AVG(med_dose_day), 2) AS avg_med_dose_day FROM (";
        $sql .= "SELECT HN, type, med_name, SUM(final_med_dose) AS sum_med_dose, icu_stay, SUM(final_med_dose)/icu_stay AS med_dose_day FROM (";
        $sql .= "SELECT *, COALESCE(med_dose_drip, med_dose) AS final_med_dose FROM (";
        $sql .= "SELECT *, med_duration * med_dose_hr AS med_dose_drip FROM (";

        $sql .= "SELECT p.HN, p.apache_ii, pa.type, pa.death, pa.reason LIKE '%ARDS%' AS ards";
        $sql .= ", ppmr.med_record_id, ppmr.med_name, ppmr.med_dose, ppmr.med_dose_hr";
        $sql .= ", TIME_TO_SEC(TIMEDIFF(ppmr.med_time_to, ppmr.med_time_from))/3600 AS med_duration";
        $sql .= ", DATEDIFF(pa.icu_admission_date_to, pa.icu_admission_date_from) AS icu_stay";
        $sql .= " FROM patient p JOIN patient_admission pa USING(HN) JOIN patient_pad_record ppr USING(admission_id)";
        $sql .= " JOIN patient_pad_med_records ppmr ON ppr.record_id = ppmr.pad_record_id WHERE p.apache_ii IS NOT NULL) A) B) C";

        $sql .= " WHERE icu_stay > 0 GROUP BY HN, med_name) D";
        $sql .= " GROUP BY type, med_name";

        $sql .= ") E GROUP BY med_name";

        return DB::select($sql);
    }

}
