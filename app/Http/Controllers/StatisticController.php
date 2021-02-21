<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Medicine;

use Illuminate\Http\Request;
use DB;

class StatisticController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

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
        $sql = "SELECT admission_id, HN, firstname, lastname, age, type, icu_stay, hospital_stay, ett_duration, apache_ii, death";
        $sql .= ", icu_admission_date_from, icu_admission_date_to, hospital_admission_date_from, hospital_admission_date_to";
        $sql .= ", ett_date_from, ett_date_to FROM (";

        $sql .= "SELECT *, TIMESTAMPDIFF(HOUR, pa.icu_admission_date_from, pa.icu_admission_date_to)/24 AS icu_stay";
        $sql .= ", TIMESTAMPDIFF(HOUR, pa.hospital_admission_date_from, pa.hospital_admission_date_to)/24 AS hospital_stay";
        $sql .= ", TIMESTAMPDIFF(HOUR, pa.ett_date_from, pa.ett_date_to)/24 AS ett_duration";
        $sql .= " FROM patient p JOIN patient_admission pa USING(HN) JOIN patient_pad_record ppr USING(admission_id)) A";

        $sql .= " WHERE icu_stay <= 0 OR (icu_stay < 2 AND death = 1) OR (ett_duration < 2 AND death = 1 AND ett_date_to = hospital_admission_date_to) OR icu_stay > 100";
        $sql .= " OR hospital_stay > 120 OR ett_duration > 100 OR age < 18 OR age > 100 OR apache_ii IS NULL";
        $sql .= " OR icu_admission_date_from < hospital_admission_date_from";
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
        $sql .= " FROM patient p JOIN patient_admission pa USING(HN) JOIN patient_pad_record ppr USING(admission_id)";
        $sql .= " JOIN patient_pad_med_records ppmr ON ppr.record_id = ppmr.pad_record_id";
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
        $sql = "SELECT DISTINCT($group) FROM (SELECT *, YEAR(icu_admission_date_from) AS year FROM patient_admission) A WHERE $group != '' ORDER BY $group";
        return DB::select($sql);
    }

    public function sql()
    {
        $this->patientListSQL();
        $this->patientPadListSQL();
    }

    private $drugs = [
        'PACR-I-',
        'ESMR-I-',
        'NIMB1I-',
        'TRAC-I1'
    ];

    private function patientListSQL()
    {
        $drugs = [
            'AMKC1I-',
            'AMKC2I-',
            'GENT2I-',
            'NETM1I-',
            'CFZL-I-',
            'MEIA-T-',
            'MAXM-I-',
            'SUPR1I-',
            'CFTX2I-',
            'CFXN-I-',
            'CEFF2I-',
            ['CEFC-I-', 'CEFV-I-', 'ROCV3I-'],
            'CFRM-I-',
            ['KEFX2T-', 'CELX1C-'],
            'AMOX1C-',
            'AUGM-I-',
            'AMPC3I-',
            'UNSY1I-',
            'CLOX2I-',
            'DICX-C-',
            'PGSG-I-',
            'PENV2T-',
            'TAZC-I-',
            'DORB-I-',
            'INVZ-I-',
            'TIEN-I-',
            'MERN2I-',
            'ZITM-I-',
            'AZIB-C-',
            'KLAC-I-',
            'CLRM2T-',
            'CIFX1T-',
            'CIFX2T-',
            'CIFX2I-',
            'CRAV1T-',
            'CRAV2I-',
            'LEVV-T-',
            'AVEL-I-',
            'NORX1T-',
            'OFLX1T-',
            'DOXY-C-',
            'BACT-I-',
            'CTMX-T-',
            'DALC-I2',
            'DALC1C-',
            'COLM-I-',
            'CUBI-I-',
            'FOMC2I-',
            'ZYVX-T-',
            'ZYVX-I-',
            'FUCD-T-',
            'TYGC-I-',
            'VANM-I-',
            'FLAG2T-',
            'METZ-I-',
            'RIFP-T-',
            'RIFP1C-',
            'CYCS-C-',
            'ETBI-T-',
            'ETHI-T-',
            'INH.-T-',
            'PZA.-T-',
            'RIFN2C-',
            'RIFT-T-',
            'AMPB-I-',
            'AMBS-I-',
            'ERAX-I-',
            'CACD1I-',
            'CACD2I-',
            'FLCN-I-',
            'FLCN2C-',
            'FLCN3C-',
            'SPOR-C-',
            'MYCA-I-',
            'VFEN-I-',
            'VFEN2T-',
            'VFEN1T-',
            'ADRL-I1',
            'LEVP-I-',
            'NORE-I-',
            'DOPA3I-',
            'DOPA-I-',
            'DOBT-I-',
            'DXMT-I1',
            'FLRN-T-',
            'SOCT-I-',
            'SOMD1I-',
            'SOMD2I-',
            'SOMD3I-',
            'SOMD-I-',
            'DPMD-I-',
            'PRED-T-',
            'TRIA1I-',
            'ROHN1T-',
            'DORM-I1',
            'MIDA-I-',
            'NITZ-T-',
            'PNOB3T-',
            'PNOB2T-',
            'GARD-I-',
            'PNOB-I-',
            'ZOLP-T-',
            'FENT-I-',
            'MORP-I1',
            'PETD-I9',
            'PRPL-I-',
            'FRES-I-',
            'FRES1I-',
            'ANEP-I-',
            'PETT-I-',
        ];

        $sql = "SELECT *, (SELECT FORMAT((TIMESTAMPDIFF(HOUR, MIN(ppr.date_assessed), MAX(ppr.date_assessed)) / 24) + 1, 0) FROM patient_pad_record ppr";
        $sql .= " JOIN patient_pad_med_records ppmr ON ppr.record_id = ppmr.pad_record_id";
        $sql .= " WHERE ppr.admission_id = A.AN AND ppmr.med_name IN ('" . implode("','", $this->drugs) . "')) AS med_day FROM (";

        $sql .= "SELECT p.HN, pa.admission_id AS AN, pa.type, pa.hospital_admission_from AS ward, pa.age, p.apache_ii, p.sex";
        $sql .= ", FORMAT((TIMESTAMPDIFF(HOUR, pa.hospital_admission_date_from, pa.hospital_admission_date_to) / 24) + 1, 0) AS hospital_stay";
        $sql .= ", TIMESTAMPDIFF(HOUR, pa.icu_admission_date_from, pa.icu_admission_date_to) + 1 AS icu_hour";
        $sql .= ", pa.death, p.ards, p.arf, p.hap, p.vap, p.pneumonia, p.sepsis, p.asthma, p.copd, p.decubitus";
        $sql .= ", p.cancer_solid, p.cancer_hemato, p.metabolic, p.hiv, p.sle, pa.anemia, pa.coagulopathy";
        $sql .= ", p.psychi, p.neuro, p.neuromuscular, p.circulatory, p.liver, pa.aki, p.ckd, p.injury, p.morbidity";

        foreach ($drugs as $drug) {
            $sql .= ", IF(SUM(IF(";

            $drug_conditions = [];
            if (!is_array($drug)) {
                $drug = [$drug];
            }

            foreach ($drug as $d) {
                $drug_conditions[] = "med_name = '" . $d . "'";
            }

            $sql .= implode(' OR ', $drug_conditions);
            $sql .= ",med_dose,0)) > 0,1,0) AS `" . implode('_', $drug) . "`";
        }

        $sql .= " FROM patient p JOIN patient_admission pa USING(HN) JOIN patient_pad_record ppr USING(admission_id)";
        $sql .= " JOIN patient_pad_med_records ppmr ON ppr.record_id = ppmr.pad_record_id";
        $sql .= " WHERE `type` != 'unknown'";
        $sql .= " GROUP BY pa.admission_id) A";

        echo '<br>' . $sql . '<br>';
    }

    private function patientPadListSQL()
    {
        $labs = [
            'alt',
            'ast',
            'scr',
            'ph',
            'pco2',
            'po2',
            'hco3',
            'po2_fi',
            'ca',
            'mg'
        ];

        $sql = "SELECT p.HN, pa.admission_id AS AN, pa.type, ppr.date_assessed";

        foreach ($labs as $lab) {
            $sql .= ", ppr." . $lab;
        }

        foreach ($this->drugs as $drug) {
            $sql .= ", SUM(IF(med_name = '" . $drug . "'";
            $sql .= ",med_dose,0)) AS `" . $drug . "`";
        }

        $sql .= " FROM patient p JOIN patient_admission pa USING(HN) JOIN patient_pad_record ppr USING(admission_id)";
        $sql .= " JOIN patient_pad_med_records ppmr ON ppr.record_id = ppmr.pad_record_id";
        $sql .= " WHERE `type` != 'unknown'";
        $sql .= " GROUP BY pa.admission_id, ppr.date_assessed";

        echo '<br>' . $sql . '<br>';
    }

    private function assessDateSQL($field, $logic)
    {
        $sql = "SELECT SUM($field) FROM (SELECT admission_id, date_assessed, $logic AS $field FROM patient_pad_record GROUP BY admission_id , DATE(date_assessed)) A";
        $sql .= " WHERE pa.admission_id = A.admission_id GROUP BY admission_id";
        return $sql;
    }

    private function padRecordSQL($field, $logic)
    {
        $sql = "SELECT SUM($field) FROM (SELECT admission_id, record_id, $logic AS $field FROM patient_pad_record) A";
        $sql .= " WHERE pa.admission_id = A.admission_id GROUP BY admission_id";
        return $sql;
    }

    private function padSQL()
    {
        $sql = "SELECT HN, firstname, lastname, icu_stay, delirium_day, coma_day, rass_intarget_1, rass_intarget_2, rass_cnt";
        $sql .= ", ROUND(rass_intarget_1 / rass_cnt * 100, 2) AS percent_rass_intarget_1";
        $sql .= ", ROUND(rass_intarget_2 / rass_cnt * 100, 2) AS percent_rass_intarget_2";
        $sql .= ", mechanical_day";
        $sql .= " FROM (SELECT p.*, TIMESTAMPDIFF(HOUR, pa.icu_admission_date_from, pa.icu_admission_date_to) / 24 AS icu_stay";
        $sql .= ", (" . $this->assessDateSQL('delirium', 'IF(MAX(delirium) = 1, 1, 0)') . ") AS delirium_day";
        $sql .= ", (" . $this->assessDateSQL('rass', 'MAX(IF(rass>=-5 AND rass<=-3, 1, 0))') . ") AS coma_day";
        $sql .= ", (" . $this->padRecordSQL('rass', 'IF(rass>=-1 AND rass<=0, 1, 0)') . ") AS rass_intarget_1";
        $sql .= ", (" . $this->padRecordSQL('rass', 'IF(rass>=-2 AND rass<=0, 1, 0)') . ") AS rass_intarget_2";
        $sql .= ", (" . $this->padRecordSQL('rass', 'IF(rass IS NOT NULL, 1, 0)') . ") AS rass_cnt";
        $sql .= ", (" . $this->assessDateSQL('mechanical_ventilator', 'IF(MAX(mechanical_ventilator) = 1, 1, 0)') . ") AS mechanical_day";
        $sql .= " FROM patient p JOIN patient_admission pa USING(HN) JOIN patient_pad_record ppr USING(admission_id) GROUP BY pa.admission_id) B ORDER BY HN";
        return DB::select($sql);
    }

    public function pad()
    {
        $data = $this->padSQL();
        return view('statistic.pad', compact('data'));
    }

    private function padMedSQL($medName)
    {
        function getMainSql($medName, $HN = null){
            $mainSql = "SELECT *, ROUND(SUM(temp_med_dose), 2) AS final_med_dose FROM (";
            $mainSql .= "SELECT *, COALESCE(med_dose_drip, med_dose) AS temp_med_dose FROM (";
            $mainSql .= "SELECT *, DATE(date_assessed) AS date_assessed_dp, med_duration * med_dose_hr AS med_dose_drip FROM (";
            $mainSql .= "SELECT *, IF(temp_med_duration < 0, temp_med_duration + 24, temp_med_duration) AS med_duration FROM (";
            $mainSql .= "SELECT p.HN, pa.admission_id";
            $mainSql .= ", ppr.date_assessed, ppmr.med_time_from, ppmr.med_time_to, ppmr.med_name, ppmr.med_dose, ppmr.med_dose_hr";
            $mainSql .= ", IF(ppmr.med_time_from IS NULL AND ppmr.med_time_to IS NULL, 24, TIME_TO_SEC(TIMEDIFF(COALESCE(ppmr.med_time_to, '23:59:59'), COALESCE(ppmr.med_time_from, '00:00:00'))) / 3600) AS temp_med_duration";
            $mainSql .= " FROM patient p JOIN patient_admission pa USING(HN) JOIN patient_pad_record ppr USING(admission_id)";
            $mainSql .= " JOIN patient_pad_med_records ppmr ON ppr.record_id = ppmr.pad_record_id";
            $mainSql .= " WHERE med_name = '$medName'";
            if(!empty($HN)) $mainSql .= " AND HN = '" . $HN . "'";
            $mainSql .= ") A) B) C) D";
            $mainSql .= " GROUP BY admission_id, DATE(date_assessed)";
            return $mainSql;
        }
        $sql = "SELECT HN, med_name, SUM(final_med_dose) AS sum_med_dose, COUNT(date_assessed_dp) AS med_day";
        $sql .= ", ROUND(SUM(final_med_dose)/COUNT(date_assessed_dp), 2) AS med_dose_day FROM (";
        $mainSql = getMainSql($medName);
        $sql .= $mainSql . ") E GROUP BY HN ORDER BY HN";

        $data = DB::select($sql);
        $maxDay = 0;

        function getDayField($i){
            return 'day_' . ($i + 1);
        }

        foreach($data as $row){
            $sql = "SELECT final_med_dose FROM (" . getMainSql($medName, $row->HN) . ") A";
            $sql .= " ORDER BY date_assessed_dp";
            $medData = DB::select($sql);
            for($i = 0; $i < count($medData); $i++){
                $day = getDayField($i);
                $row->$day = $medData[$i]->final_med_dose;
                $maxDay = $maxDay > $i ? $maxDay : $i;
            }
        }

        foreach($data as $row){
            for($i = 0; $i <= $maxDay; $i++){
                $day = getDayField($i);
                if(is_null($row->$day)){
                    $row->$day = "";
                }
            }
        }
        return $data;
    }

    public function padMed($med_name = null)
    {
        $medicines = Medicine::lists('name', 'name');
        $data = empty($med_name) ? [] : $this->padMedSQL($med_name);
        return view('statistic.pad', compact('data', 'medicines', 'med_name'));
    }

}
