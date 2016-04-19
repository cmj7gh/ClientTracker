<!-- Javascript libraries loaded into the page -->
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script src="/js/underscore-min.js"></script>
<script src="/js/backbone-min.js"></script>

<!-- Javascript MVC for this application loaded -->
<script src="/js/utility.js"></script>
<script src="/js/models/SearchSemestersModel.js"></script>
<script src="/js/collections/SearchSemestersCollection.js"></script>
<script src="/js/models/BirthdayTableModel.js"></script>
<script src="/js/views/BirthdayTableView.js"></script>
<script src="/js/views/SearchSemesterView.js"></script>
<script src="/js/activity/stats/birthday.js"></script>
<script src="/js/activity/stats/semesters.js "></script>

<!-- CSS files loaded in to store certain stylings -->
<link rel="stylesheet" type="text/css" href="/css/custom/stats.css"></link>

<h1 id="user-greeting"></h1>

<!-- Search form to search for a student -->
<div class="border-bottom">
	<h2>Search For A Student</h2>
	<form action="/students/search" class="form-horizontal row" id="StudentSearchForm" method="get" accept-charset="utf-8">
		<div class="control-group pull-left">
			<label for="StudentSearchType" class="control-label">Search Type</label>
			<div class="controls">
				<select name="searchType" class="student-search" id="StudentSearchType">
					<option value="searchName">Name</option>
					<option value="School.name">School</option>
					<option value="email">Email</option>
					<option value="country">Country</option>
				</select>
			</div>
		</div>
		<div class="control-group pull-left">
			<label for="StudentSearchString" class="control-label">Search String</label>
			<div class="controls">
				<input name="searchString" class="student-search" type="text" id="StudentSearchString"/></input>
			</div>
		</div>
		<div class="control-group pull-left">
			<div class="controls" id="search-submit-container">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</div>
	</form>
</div>

<!-- Birthdays Container -->
<div class="border-bottom">
	<h2>Birthdays</h2>
	<table class="table">
		<tr>
			<th>Today's Birthdays</th>
			<th>Tomorrow's Birthdays</th>
			<th id="two-days-out"></th>
		</tr>
		<tr>
			<td id="todays-birthdays" class="birthday-list"></td>
			<td id="tomorrows-birthdays" class="birthday-list"></td>
			<td id="two-days-out-birthdays" class="birthday-list"></td>
		</tr>
	</table>
</div>
<div>
	<h2>Statistics</h2>
	<form action="/pages/stats" class="form-horizontal" id="StudentStatsForm" method="get" accept-charset="utf-8">
		<div class="control-group">
			<label for="StartSemester" class="control-label">Start Semester</label>
			<div class="controls">
				<select name="StartSemester" id="StartSemester"></select>
			</div>
		</div>
		<div class="control-group">
			<label for="EndSemester" class="control-label">End Semester</label>
			<div class="controls">
				<select name="EndSemester" id="EndSemester"></select>
				<button type="submit" id="submit-button" class="btn btn-success">Submit</button>
			</div>
		</div>
	</form>
</div>
<script>
	var includedSemesters = <?php echo json_encode($includedSemesters); ?>
</script>

</br>
</br>
<!--Included Semesters:
<?php foreach($includedSemestersRaw as $IS){
	echo("</br>");
	echo($IS['semesters']['semester'] . ' ' . $IS['semesters']['year']);
	}?>
-->
<table class="table table-striped">
<tr>
	<th>School</th>
	<!--
		<th>Members</br>[All Time]</th>
		<th>Students Worked With</br>[All Time]</th>
	-->
	<th>Participants</br>[These Semsters]</th>
	<th>New Members</br>[These Semesters]</th>
	<th>Interns</br>[These Semsters]</th>
	<th>Internship Sites</br>[These Semesters]</th>
	<th>Countries Represented</br>[These Semesters]</th></tr>
<?php foreach($mySchools as $school){
	echo("<tr>");
	echo("<td>");
	echo($school['centers']['title'] . "</br>");
	//echo("</td><td>");
	//echo("<a href='stats?StartSemester=" . $startSemester . "&EndSemester=" . $EndSemester . "&Center=" . $school['centers']['id'] . "&Stat=AllMembers'>" . $school['centers']['members'][0][0]['count(*)'] . "</a>");
	//echo("</td><td>");
	//echo("<a href='stats?StartSemester=" . $startSemester . "&EndSemester=" . $EndSemester . "&Center=" . $school['centers']['id'] . "&Stat=AllStudents'>" .$school['centers']['studentsWorkedWith'][0][0]['count(*)'] . "</a>");
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
