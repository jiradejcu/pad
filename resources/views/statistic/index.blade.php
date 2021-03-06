@extends('app')

@section('content')
    <table id="summary_statistic"  width="100%" border="1px black">
    	<tbody>
            <tr>
                <td>{{ $group }}</td>
                <td>count</td>
                <td>%male</td>
                <td>avg age</td>
                <td>avg apache ii</td>
                <td>std apache ii</td>
                <td>%septic shock</td>
                <td>%adrenal shock</td>
                <td>%hypovolemic shock</td>
                <td>%cardiogenic shock</td>
                <td>%asthma exacerbation</td>
                <td>%copd exacerbation</td>
                <td>%aki</td>
                <td>%liver shock</td>
                <td>%seizure shock</td>
                <td>%ugib</td>
                <td>%coagulopathy</td>
                <td>%anemia</td>
                <td>%ards</td>
                <td>%death</td>
                <td>avg icu stay</td>
                <td>avg hospital stay</td>
            </tr>
            @forelse ($patients as $patient)
                <tr>
                    <td>{{ $patient->$group }}</td>
                    <td>{{ $patient->cnt }}</td>
                    <td>{{ number_format($patient->percent_male, 2) }}</td>
                    <td>{{ number_format($patient->avg_age, 2) }}</td>
                    <td>{{ number_format($patient->avg_apache_ii, 2) }}</td>
                    <td>{{ number_format($patient->std_apache_ii, 2) }}</td>
                    <td>{{ number_format($patient->percent_septic_shock, 2) }}</td>
                    <td>{{ number_format($patient->percent_adrenal_shock, 2) }}</td>
                    <td>{{ number_format($patient->percent_hypovolemic_shock, 2) }}</td>
                    <td>{{ number_format($patient->percent_cardiogenic_shock, 2) }}</td>
                    <td>{{ number_format($patient->percent_asthma_exacerbation, 2) }}</td>
                    <td>{{ number_format($patient->percent_copd_exacerbation, 2) }}</td>
                    <td>{{ number_format($patient->percent_aki, 2) }}</td>
                    <td>{{ number_format($patient->percent_liver_shock, 2) }}</td>
                    <td>{{ number_format($patient->percent_seizure_shock, 2) }}</td>
                    <td>{{ number_format($patient->percent_ugib, 2) }}</td>
                    <td>{{ number_format($patient->percent_coagulopathy, 2) }}</td>
                    <td>{{ number_format($patient->percent_anemia, 2) }}</td>
                    <td>{{ number_format($patient->percent_ards, 2) }}</td>
                    <td>{{ number_format($patient->percent_death, 2) }}</td>
                    <td>{{ number_format($patient->avg_icu_stay, 2) }}</td>
                    <td>{{ number_format($patient->avg_hospital_stay, 2) }}</td>
                </tr>
            @empty
                <tr><td>No patient</td></tr>
            @endforelse
        </tbody>
    </table>
    <br>
    <table width="100%" border="1px black">
        <tbody>
            <tr>
                <td>med name</td>
                @foreach ($pivotList as $pivot)
                    <td>{{ $pivot->$group }}</td>
                    <td>%{{ $pivot->$group }}</td>
                @endforeach
            </tr>
            @forelse ($padMedRecords as $padMedRecord)
                <tr>
                    <td>{{ $padMedRecord->med_name }}</td>
                    @foreach ($pivotList as $pivot)
                        <?php
                            $pivot_name = $pivot->$group;
                            $pivot_percent_name = $pivot->$group . '_percent';
                         ?>
                        <td>{{ $padMedRecord->$pivot_name }}</td>
                        <td>{{ number_format($padMedRecord->$pivot_percent_name, 2) }}</td>
                    @endforeach
                </tr>
            @empty
                <tr><td>No patient</td></tr>
            @endforelse
        </tbody>
    </table>
@stop

@section('footer')

<script type="text/javascript">
<!--
$(function() {
	transposeTable();
});

function transposeTable(){
    var t = $('#summary_statistic tbody').eq(0);
    var r = t.children('tr');
    var cols= r.length;
    var rows= r.eq(0).children('td').length;
    var cell, next, tem, i = 0;
    var tb= $('<tbody></tbody>');

    while(i<rows){
        cell= 0;
        tem= $('<tr></tr>');
        while(cell<cols){
            next= r.eq(cell++).children('td').eq(0);
            tem.append(next);
        }
        tb.append(tem);
        ++i;
    }
    $('#summary_statistic').append(tb);
    $('#summary_statistic').show();
}
//-->
</script>

@stop