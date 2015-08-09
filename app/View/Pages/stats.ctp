<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<h2>
<h1 style="text-align:center">Welcome, <?php echo ($currentUser['first_name'] . ' ' . $currentUser['last_name']); ?></h1>
<hr style="border: 0;border-bottom: 1px dashed #ccc;background: #999;">
<h2>Search For A Student</h2>
<form action="/students/search" class="form-horizontal" id="StudentSearchForm" method="get" accept-charset="utf-8"><div style="display:none;">
	</div>
	<div class="control-group" style="float:left;">
	<label for="StudentSearchType" class="control-label">Search Type</label>
	<div class="controls">
		<select name="searchType" class="" style="width: 500px;" id="StudentSearchType">
			<option value="searchName">Name</option>
			<option value="School.name">School</option>
			<option value="email">Email</option>
			<option value="country">Country</option>
		</select>
	</div>
		</div>
		<div class="control-group" style="float:left;">
		<label for="StudentSearchString" class="control-label">Search String</label>
		<div class="controls">
			<input name="searchString" class="" style="width: 500px;" type="text" id="StudentSearchString"/></div></div>		
		<div class="control-group" style="float:left;">
			<div class="controls" style="margin: 0px; margin-left:10px">
				<button type="submit" class="btn btn-success">
				Submit			
			</div>
		</div>
</form>
</br>
<hr style="border: 0;border-bottom: 1px dashed #ccc;background: #999;">
<h2>Birthdays:</h2>
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
		echo('<a href=\'../students/view/' . $tstub['students']['id'] . '\'>' . $tstub[0]['name']. '</a></br>');
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
</br>
<hr style="border: 0;border-bottom: 1px dashed #ccc;background: #999;">
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
echo( " For " . $mySchools[$_GET['Center']-1]['centers']['title'] );
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