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

<?php
    $this->assign('title', 'User Has No Role');
?>

<h2>
<div class="hero-unit">
<h1>Welcome, <?php echo ($currentUser['first_name'] . ' ' . $currentUser['last_name']); ?></h1>

<h2><?php echo $this->Html->link(('Click here to use the new stats page!'), array('controller' => 'pages', 'action' => 'stats')); ?></h2>

<table class="table">
<tr>
<th>Today's Birthdays</th>
<th>Tomorrow's Birthdays</th>
<th><?php switch($nextDay[0][0]['day']){
			case 1: echo "Sunday's Birthdays"; break;
			case 2: echo "Monday's Birthdays"; break;
			case 3: echo "Tuesday's Birthdays"; break;
			case 4: echo "Wednesday's Birthdays"; break;
			case 5: echo "Thursday's Birthdays"; break;
			case 6: echo "Friday's Birthdays"; break;
			case 7: echo "Saturday's Birthdays"; break;
		} ?></th>
</tr>
<tr>
<td>
<?php 
if(count($todayStaffBirthdays) + count($todayStudentBirthdays) == 0){
	echo("None");
}else{
	foreach($todayStaffBirthdays as $tsb){
		echo($tsb[0]['name'] . ' (STAFF) </br>');
	};
	foreach($todayStudentBirthdays as $tstub){
		echo($tstub[0]['name']. '</br>');
	};
}
?>
</td><td>
<?php 
if(count($tomorrowStaffBirthdays) + count($tomorrowStudentBirthdays) == 0){
	echo("None");
}else{
	foreach($tomorrowStaffBirthdays as $tosb){
		echo($tosb[0]['name'] . ' (STAFF) </br>');
	};
	foreach($tomorrowStudentBirthdays as $tostub){
		echo($tostub[0]['name'] . '</br>');
	};
}
?>
</td><td>
<?php 
if(count($nextDayStaffBirthdays) + count($nextDayStudentBirthdays) == 0){
	echo("None");
}else{
	foreach($nextDayStaffBirthdays as $nsb){
		echo($nsb[0]['name'] . ' (STAFF) </br>');
	};
	foreach($nextDayStudentBirthdays as $nstub){
		echo($nstub[0]['name']. '</br>');
	};
}
?>
</td></tr>
</table>
</br></br>
LP Statistics:</br>
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
</br>
</br>
<table class="table">
<tr>
<?php foreach($mySchools as $school){
	echo("<td>");
	echo($school['schools']['name'] . "</br>");
	echo("<ul>");
	echo("<li>LP Members: " . $school['schools']['members'][0][0]['count(*)'] . "</li>");
	echo("<li>Students LP Has Worked With: " . $school['schools']['studentsWorkedWith'][0][0]['count(*)'] . "</li>");
	echo("<li>Countries Represented: " . $school['schools']['countries'][0][0]['count(distinct country)'] . "</li>");
	echo("<li>Internship Locations: " . $school['schools']['internship_locations'][0][0]['count(distinct internship_location)'] . "</li>");
	echo("<li>New Members Last Semester: " . $school['schools']['started_last_semester'][0][0]['count(*)'] ."</li>");
	echo("<li>Participants Last Semester: " . $school['schools']['participated_last_semester'][0][0]['count(distinct student_id)'] . "</li>");
	echo("</ul></br></br>");
	echo("</td>");
}?>
</tr>
</table>
</br>
</div>
</h2>