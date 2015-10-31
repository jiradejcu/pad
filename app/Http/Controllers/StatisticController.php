<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class StatisticController extends Controller
{

    public function index($group = 'type')
    {
        $patients = $this->patientOverviewStatistic($group);
        $padMedRecords = $this->patientPadMedStatistic($group);
        $pivotList = $this->patientPivotList($group);
        return view('statistic.index', compact('patients', 'padMedRecords', 'pivotList', 'group'));
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

        $sql .= "SELECT *, TIMESTAMPDIFF(HOUR, pa.icu_admission_date_from, pa.icu_admission_date_to)/24 AS icu_stay";
        $sql .= ", TIMESTAMPDIFF(HOUR, pa.hospital_admission_date_from, pa.hospital_admission_date_to)/24 AS hospital_stay";
        $sql .= ", TIMESTAMPDIFF(HOUR, pa.ett_date_from, pa.ett_date_to)/24 AS ett_duration";
        $sql .= " FROM patient p JOIN patient_admission pa USING(HN) JOIN patient_pad_record ppr USING(admission_id)) A";

        $sql .= " WHERE icu_stay <= 0 OR hospital_stay < 5 OR ett_duration <= 3 OR icu_stay > 100";
        $sql .= " OR hospital_stay > 100 OR ett_duration > 100 OR age < 10 OR age > 100 OR apache_ii IS NULL";
        $sql .= " OR icu_admission_date_from < hospital_admission_date_from OR ett_date_from < hospital_admission_date_from";
        $sql .= " OR icu_admission_date_to > hospital_admission_date_to OR ett_date_to > hospital_admission_date_to";
        $sql .= " GROUP BY admission_id";
        $sql .= " ORDER BY admission_id DESC";

        return DB::select($sql);
    }

    private function patientOverviewStatistic($group)
    {
        $sql = "SELECT $group, COUNT(HN) AS cnt, SUM(is_male)/COUNT(HN) AS percent_male, AVG(age) AS avg_age, AVG(apache_ii) AS avg_apache_ii";
        $sql .= ", STD(apache_ii) AS std_apache_ii";
        $sql .= ", SUM(septic_shock)/COUNT(HN) AS percent_septic_shock, SUM(cardiogenic_shock)/COUNT(HN) AS percent_cardiogenic_shock";
        $sql .= ", SUM(adrenal_shock)/COUNT(HN) AS percent_adrenal_shock, SUM(hypovolemic_shock)/COUNT(HN) AS percent_hypovolemic_shock";
        $sql .= ", SUM(asthma_exacerbation)/COUNT(HN) AS percent_asthma_exacerbation, SUM(copd_exacerbation)/COUNT(HN) AS percent_copd_exacerbation";
        $sql .= ", SUM(aki)/COUNT(HN) AS percent_aki, SUM(liver_shock)/COUNT(HN) AS percent_liver_shock, SUM(seizure_shock)/COUNT(HN) AS percent_seizure_shock";
        $sql .= ", SUM(ugib)/COUNT(HN) AS percent_ugib, SUM(coagulopathy)/COUNT(HN) AS percent_coagulopathy, SUM(anemia)/COUNT(HN) AS percent_anemia";
        $sql .= ", SUM(ards)/COUNT(HN) AS percent_ards, SUM(death)/COUNT(HN) AS percent_death";
        $sql .= ", AVG(icu_stay) AS avg_icu_stay, AVG(hospital_stay) AS avg_hospital_stay FROM (";

        $sql .= "SELECT p.HN, IF(p.sex='m',1,0) AS is_male, p.apache_ii, pa.age, pa.type, YEAR(pa.icu_admission_date_from) AS year";
        $sql .= ", pa.septic_shock, pa.cardiogenic_shock";
        $sql .= ", pa.adrenal_shock, pa.hypovolemic_shock";
        $sql .= ", pa.asthma_exacerbation, pa.copd_exacerbation";
        $sql .= ", pa.aki, pa.liver_shock, pa.seizure_shock";
        $sql .= ", pa.ugib, pa.coagulopathy, anemia";
        $sql .= ", pa.reason LIKE '%ARDS%' AS ards, pa.death";
        $sql .= ", TIMESTAMPDIFF(HOUR, pa.icu_admission_date_from, pa.icu_admission_date_to)/24 AS icu_stay";
        $sql .= ", TIMESTAMPDIFF(HOUR, pa.hospital_admission_date_from, pa.hospital_admission_date_to)/24 AS hospital_stay";
        $sql .= " FROM patient p JOIN patient_admission pa USING(HN)";
        $sql .= " WHERE p.apache_ii IS NOT NULL GROUP BY p.HN";

        $sql .= ") A WHERE icu_stay > 0 GROUP BY $group ORDER BY $group";
        return DB::select($sql);
    }

    private function patientPadMedStatistic($group)
    {
        $mainSql = "SELECT HN, type, year, med_name, SUM(final_med_dose) AS sum_med_dose, icu_stay, SUM(final_med_dose)/icu_stay AS med_dose_day FROM (";
        $mainSql .= "SELECT *, COALESCE(med_dose_drip, med_dose) AS final_med_dose FROM (";
        $mainSql .= "SELECT *, med_duration * med_dose_hr AS med_dose_drip FROM (";

        $mainSql .= "SELECT p.HN, pa.type, YEAR(pa.icu_admission_date_from) AS year, ppr.date_assessed, ppmr.med_name, ppmr.med_dose, ppmr.med_dose_hr";
        $mainSql .= ", TIME_TO_SEC(TIMEDIFF(ppmr.med_time_to, ppmr.med_time_from))/3600 AS med_duration";
        $mainSql .= ", TIMESTAMPDIFF(HOUR, pa.icu_admission_date_from, pa.icu_admission_date_to)/24 AS icu_stay";
        $mainSql .= " FROM patient p JOIN patient_admission pa USING(HN) JOIN patient_pad_record ppr USING(admission_id)";
        $mainSql .= " JOIN patient_pad_med_records ppmr ON ppr.record_id = ppmr.pad_record_id WHERE p.apache_ii IS NOT NULL";

        $mainSql .= ") A) B) C WHERE icu_stay > 0 GROUP BY HN, med_name";

        $sql = "SELECT med_name";

        $list = $this->patientPivotList($group);
        foreach ($list as $row) {
            $sql .= ", SUM(CASE $group WHEN '" . $row->$group . "' THEN avg_med_dose_day ELSE 0 END) AS `" . $row->$group . "`";
            $sql .= ", SUM(CASE $group WHEN '" . $row->$group . "' THEN percent ELSE 0 END) AS `" . $row->$group . "_percent`";
        }
        $sql .= " FROM (";

        $sql .= "SELECT $group, med_name, format(AVG(med_dose_day), 2) AS avg_med_dose_day";
        $sql .= ", COUNT(HN) / (SELECT COUNT(*) FROM (SELECT *, YEAR(icu_admission_date_from) AS year FROM patient_admission) A WHERE A.$group = D.$group) AS percent";
        $sql .= " FROM (" . $mainSql . ") D GROUP BY $group, med_name";

        $sql .= ") E GROUP BY med_name";

        return DB::select($sql);
    }

    private function patientPivotList($group)
    {
        $sql = "SELECT DISTINCT($group) FROM (SELECT *, YEAR(icu_admission_date_from) AS year FROM patient_admission) A ORDER BY $group";
        return DB::select($sql);
    }

}
