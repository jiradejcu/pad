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

    public function outliner()
    {
        $patientOutliner = $this->patientOutliner();
        return view('statistic.patient', compact('patientOutliner'));
    }

    private function patientOutliner()
    {
        $sql = "SELECT admission_id, HN, firstname, lastname, age, icu_stay, hospital_stay, ett_duration, apache_ii";
        $sql .= ", icu_admission_date_from, icu_admission_date_to, hospital_admission_date_from, hospital_admission_date_to";
        $sql .= ", ett_date_from, ett_date_to FROM (";

        $sql .= "SELECT *, DATEDIFF(pa.icu_admission_date_to, pa.icu_admission_date_from) AS icu_stay";
        $sql .= ", DATEDIFF(pa.hospital_admission_date_to, pa.hospital_admission_date_from) AS hospital_stay";
        $sql .= ", DATEDIFF(pa.ett_date_to, pa.ett_date_from) AS ett_duration";
        $sql .= " FROM patient p JOIN patient_admission pa USING(HN) JOIN patient_pad_record ppr USING(admission_id)) A";

        $sql .= " WHERE icu_stay <= 0 OR hospital_stay < 5 OR ett_duration <= 3 OR icu_stay > 100";
        $sql .= " OR hospital_stay > 100 OR ett_duration > 100 OR age < 10 OR age > 100 OR apache_ii IS NULL";
        $sql .= " OR icu_admission_date_from < hospital_admission_date_from OR ett_date_from < hospital_admission_date_from";
        $sql .= " OR icu_admission_date_to > hospital_admission_date_to OR ett_date_to > hospital_admission_date_to";
        $sql .= " GROUP BY admission_id";
        $sql .= " ORDER BY admission_id DESC";

        return DB::select($sql);
    }

    private function patientOverviewStatistic()
    {
        $sql = "SELECT type, COUNT(HN) AS cnt, SUM(is_male)/COUNT(HN) AS percent_male, AVG(age) AS avg_age, AVG(apache_ii) AS avg_apache_ii";
        $sql .= ", SUM(septic_shock)/COUNT(HN) AS percent_septic_shock, SUM(cardiogenic_shock)/COUNT(HN) AS percent_cardiogenic_shock";
        $sql .= ", SUM(adrenal_shock)/COUNT(HN) AS percent_adrenal_shock, SUM(hypovolemic_shock)/COUNT(HN) AS percent_hypovolemic_shock";
        $sql .= ", SUM(asthma_exacerbation)/COUNT(HN) AS percent_asthma_exacerbation, SUM(copd_exacerbation)/COUNT(HN) AS percent_copd_exacerbation";
        $sql .= ", SUM(aki)/COUNT(HN) AS percent_aki, SUM(liver_shock)/COUNT(HN) AS percent_liver_shock, SUM(seizure_shock)/COUNT(HN) AS percent_seizure_shock";
        $sql .= ", SUM(ugib)/COUNT(HN) AS percent_ugib, SUM(coagulopathy)/COUNT(HN) AS percent_coagulopathy, SUM(anemia)/COUNT(HN) AS percent_anemia";
        $sql .= ", SUM(ards)/COUNT(HN) AS percent_ards, SUM(death)/COUNT(HN) AS percent_death";
        $sql .= ", AVG(icu_stay) AS avg_icu_stay, AVG(hospital_stay) AS avg_hospital_stay FROM (";

        $sql .= "SELECT p.HN, IF(p.sex='m',1,0) AS is_male, p.apache_ii, pa.age, pa.type";
        $sql .= ", pa.septic_shock, pa.cardiogenic_shock";
        $sql .= ", pa.adrenal_shock, pa.hypovolemic_shock";
        $sql .= ", pa.asthma_exacerbation, pa.copd_exacerbation";
        $sql .= ", pa.aki, pa.liver_shock, pa.seizure_shock";
        $sql .= ", pa.ugib, pa.coagulopathy, anemia";
        $sql .= ", pa.death, pa.reason LIKE '%ARDS%' AS ards";
        $sql .= ", DATEDIFF(pa.icu_admission_date_to, pa.icu_admission_date_from) AS icu_stay";
        $sql .= ", DATEDIFF(pa.hospital_admission_date_to, pa.hospital_admission_date_from) AS hospital_stay";
        $sql .= " FROM patient p JOIN patient_admission pa USING(HN) WHERE p.apache_ii IS NOT NULL";

        $sql .= ") A WHERE icu_stay > 0 GROUP BY type";
        return DB::select($sql);
    }

    private function patientPadMedStatistic()
    {
        $mainSql = "SELECT HN, type, med_name, SUM(final_med_dose) AS sum_med_dose, icu_stay, SUM(final_med_dose)/icu_stay AS med_dose_day FROM (";
        $mainSql .= "SELECT *, COALESCE(med_dose_drip, med_dose) AS final_med_dose FROM (";
        $mainSql .= "SELECT *, med_duration * med_dose_hr AS med_dose_drip FROM (";

        $mainSql .= "SELECT p.HN, pa.type, ppmr.med_record_id, ppmr.med_name, ppmr.med_dose, ppmr.med_dose_hr";
        $mainSql .= ", TIME_TO_SEC(TIMEDIFF(ppmr.med_time_to, ppmr.med_time_from))/3600 AS med_duration";
        $mainSql .= ", DATEDIFF(pa.icu_admission_date_to, pa.icu_admission_date_from) AS icu_stay";
        $mainSql .= " FROM patient p JOIN patient_admission pa USING(HN) JOIN patient_pad_record ppr USING(admission_id)";
        $mainSql .= " JOIN patient_pad_med_records ppmr ON ppr.record_id = ppmr.pad_record_id WHERE p.apache_ii IS NOT NULL";

        $mainSql .= ") A) B) C WHERE icu_stay > 0 GROUP BY HN, med_name";

        $sql = "SELECT med_name, SUM(CASE type WHEN 'prospective' THEN avg_med_dose_day ELSE 0 END) AS prospective";
        $sql .= ", SUM(CASE type WHEN 'retrospective' THEN avg_med_dose_day ELSE 0 END) AS retrospective";
        $sql .= ", SUM(CASE type WHEN 'prospective' THEN percent ELSE 0 END) AS prospective_percent";
        $sql .= ", SUM(CASE type WHEN 'retrospective' THEN percent ELSE 0 END) AS retrospective_percent FROM (";

        $sql .= "SELECT type, med_name, format(AVG(med_dose_day), 2) AS avg_med_dose_day, COUNT(HN) / (SELECT COUNT(*) FROM patient_admission pa WHERE pa.type = D.type) AS percent FROM (";
        $sql .= $mainSql . ") D GROUP BY type, med_name";

        $sql .= ") E GROUP BY med_name";

        return DB::select($sql);
    }

}
