<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script>
$(function () {
    $('#chart_container').highcharts({
        chart: {
			renderTo: 'chart_container',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Where They Are Now'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Student Status',
            data: [
                ['In High School',   <?php echo($studentsInHS[0][0]['count(*)']);?>],
                ['In College',       <?php echo($studentsInCollege[0][0]['count(*)']);?>],
                {
                    name: 'Working',
                    y: <?php echo($studentsWorking[0][0]['count(*)']);?>,
                    sliced: true,
                    selected: true
                },
                ['Unemployed',    <?php echo($studentsUnemployed[0][0]['count(*)']);?>],
				['Unknown', <?php echo($other);?>]
            ]
        }]
    });
	$('#gender_chart_container').highcharts({
        chart: {
			renderTo: 'chart_container',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Gender'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f} %)'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Student Status',
            data: [
                ['Male',   <?php echo($males[0][0]['count(*)']);?>],
                {
                    name: 'Female',
                    y: <?php echo($females[0][0]['count(*)']);?>,
                    sliced: true,
                    selected: true
                },
				['Unknown', <?php echo($unknownGender);?>]
            ]
        }]
    });
});
</script>

<h2>
<div class = 'hero-unit'>
</br></br>
<h2>Statistics:</h2>
</br>
<form action="/pages/stats" class="form-horizontal" id="StudentStatsForm" method="get" accept-charset="utf-8"><div style="display:none;">
	</div>
	<div class="control-group" style="float:left;">
	<label for="StartSemester" class="control-label">Start Semester</label>
	<div class="controls">
		<select name="StartSemester" class="" style="width: 500px;" id="StartSemester">
			--All Semesters
			
			<?php foreach($semesters as $sem){
				if($startSemester == $sem['semesters']['id']){
					echo("<option value=\"" . $sem['semesters']['id']. "\" selected>" . $sem['semesters']['semester'] . " " . $sem['semesters']['year'] . "</option>");
				}else{
					echo("<option value=\"" . $sem['semesters']['id']. "\">" . $sem['semesters']['semester'] . " " . $sem['semesters']['year'] . "</option>");
				}
			}?>			
		</select>
	</div>
	</div>
	<div class="control-group" style="float:left;">
	<label for="EndSemester" class="control-label">End Semester</label>
	<div class="controls">
		<select name="EndSemester" class="" style="width: 500px;" id="EndSemester">
			--All Semesters
			<?php foreach($semesters as $sem){
				if($EndSemester == $sem['semesters']['id']){
					echo("<option value=\"" . $sem['semesters']['id']. "\" selected>" . $sem['semesters']['semester'] . " " . $sem['semesters']['year'] . "</option>");
				}else{
					echo("<option value=\"" . $sem['semesters']['id']. "\">" . $sem['semesters']['semester'] . " " . $sem['semesters']['year'] . "</option>");
				}
			}?>
		</select>
	</div>
	</div>
	<div class="control-group" style="float:left;">
		<div class="controls" style="margin: 0px; margin-left:10px">
			<button type="submit" class="btn btn-success">
			Submit			
		</div>
	</div>
</form>
<!--
<ul>
<li>Total LP Members: <?php echo($totalMembers[0][0]['count(*)']); ?></li>
<li>Total Students LP Has Worked With: <?php echo($totalStudentsWorkedWith[0][0]['count(*)']); ?></li>
<li>Total Number of Countries Represented: <?php echo($totalCountries[0][0]['count(distinct country)']); ?></li>
<li>Total Interns: <?php echo($totalInternsAllTime[0][0]['count(*)']);?></li>
<li>Total Internship Locations: <?php echo($totalInternshipLocations[0][0]['count(distinct internship_location)']); ?></li>
<li>Total Number of New Members Last Semester: <?php echo($totalStartedLastSemester[0][0]['count(*)']); ?></li>
<li>Total Students Participants Last Semester: <?php echo($totalParticipantsLastSemester[0][0]['count(distinct student_id)']);?></li>
<li>Total Interns Last Semester: <?php echo($totalInternsLastSemester[0][0]['count(*)']);?></li>
</ul>
</br>
<div style="width: 100%; margin: 0 auto">
<div id="gender_chart_container" style="width: 600px; height: 400px; margin: 10px; position: relative; float: left"></div>
<div id="chart_container" style="width: 600px; height: 400px; margin: 10px; position: relative; float: left"></div>
</div>
-->
</br>
</br>
<!--Included Semesters:

<?php foreach($includedSemestersRaw as $IS){
	echo("</br>");
	echo($IS['semesters']['semester'] . ' ' . $IS['semesters']['year']);
	}?>
-->
<table class="table table-striped">
<tr><th>School</th><th>Members</br>[All Time]</th><th>Students Worked With</br>[All Time]</th><th>Participants</br>[These Semsters]</th><th>New Members</br>[These Semesters]</th>
	<th>Interns</br>[These Semsters]</th><th>Internship Sites</br>[These Semesters]</th><th>Countries Represented</br>[These Semesters]</th></tr>
<?php foreach($mySchools as $school){
	echo("<tr>");
	echo("<td>");
	echo($school['centers']['title'] . "</br>");
	echo("</td><td>");
	echo("<a href='stats?StartSemester=" . $startSemester . "&EndSemester=" . $EndSemester . "&Center=" . $school['centers']['id'] . "&Stat=AllMembers'>" . $school['centers']['members'][0][0]['count(*)'] . "</a>");
	echo("</td><td>");
	echo("<a href='stats?StartSemester=" . $startSemester . "&EndSemester=" . $EndSemester . "&Center=" . $school['centers']['id'] . "&Stat=AllStudents'>" .$school['centers']['studentsWorkedWith'][0][0]['count(*)'] . "</a>");
	echo("</td><td>");
	echo("<a href='stats?StartSemester=" . $startSemester . "&EndSemester=" . $EndSemester . "&Center=" . $school['centers']['id'] . "&Stat=TheseStudents'>" .$school['centers']['participated_last_semester'][0][0]['count(*)'] . "</a>");
	echo("</td><td>");
	echo("<a href='stats?StartSemester=" . $startSemester . "&EndSemester=" . $EndSemester . "&Center=" . $school['centers']['id'] . "&Stat=TheseMembers'>" .$school['centers']['newMembers'][0][0]['count(*)'] . "</a>");
	echo("</td><td>");
	echo("<a href='stats?StartSemester=" . $startSemester . "&EndSemester=" . $EndSemester . "&Center=" . $school['centers']['id'] . "&Stat=TheseInterns'>" .$school['centers']['interns_last_semester'][0][0]['count(*)'] . "</a>");
	echo("</td><td>");
	echo("<a href='stats?StartSemester=" . $startSemester . "&EndSemester=" . $EndSemester . "&Center=" . $school['centers']['id'] . "&Stat=TheseSites'>" .$school['centers']['internship_locations'][0][0]['count(distinct internship_location)'] . "</a>");
	echo("</td><td>");
	echo("<a href='stats?StartSemester=" . $startSemester . "&EndSemester=" . $EndSemester . "&Center=" . $school['centers']['id'] . "&Stat=TheseCountries'>" .$school['centers']['countries'][0][0]['count(distinct country)'] . "</a>");
	echo("</td>");
	echo("</tr>");

}?>
</table>
</br>
<?php if(isset($values)){
echo("Distinct ");
		switch($_GET['Stat']){
			case 'AllMembers':
				echo 'Members [All Time]';
				break;
			case 'AllStudents':
				echo 'Participants [All Time]';
				break;
			case 'TheseStudents':
				echo 'Participants';
				break;
			case 'TheseMembers':
				echo 'Members';
				break;
			case 'TheseInterns':
				echo 'Interns';
				break;
			case 'TheseSites':
				echo 'Internship Locations';
				break;
			case 'TheseCountries':
				echo 'Countries Of Origin';
				break;
		}
echo( " For " . $mySchools[$_GET['Center']]['centers']['title'] );
echo( " Between " );

			foreach($semesters as $sem){
				if(isset($_GET['StartSemester']) && $_GET['StartSemester'] == $sem['semesters']['id']){
					echo($sem['semesters']['semester'] . " " . $sem['semesters']['year']);
			}
			}
echo(" and ");			
			foreach($semesters as $sem){
				if(isset($_GET['EndSemester']) && $_GET['EndSemester'] == $sem['semesters']['id']){
					echo($sem['semesters']['semester'] . " " . $sem['semesters']['year']);
			}
			}
echo("</br>");
$valueCount = 1;
	echo("<table class='table'><tr>");
	foreach($values as $v){
		echo("<td>" . $v . "</td>");
		if($valueCount % 4 == 0){
			echo("</tr><tr>");
		}
		$valueCount++;
	}
	echo("</tr></table>");
}
?>
</div>
</h2>