<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<style>
.btn-default:focus,
.btn-default:active,
.btn-default.active
{
  background-color: #ffffff;
}

.btn-default:hover
{
  background-color: #ebebeb;
}
</style>
<script>
$(function () {
    $('#where_are_they_now_container').highcharts({
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
                    selected: true
                },
                ['Unemployed',    <?php echo($studentsUnemployed[0][0]['count(*)']);?>],
				['Unknown', <?php echo($other);?>]
            ]
        }]
    });
	$('#education_container').highcharts({
        chart: {
			renderTo: 'chart_container',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Highest Level Of Education Attained<?php echo($textForChartHeader);?>'
        },
        tooltip: {
    	    pointFormat: '<b>{point.y} ({point.percentage:.1f}%)</b>'
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
				['In High School',   <?php echo($membersInHS[0][0]['count(*)']);?>],
				['Dropped Out Of High School', <?php echo($studentsDroppedOutOfHS[0][0]['count(*)']);?>],
                ['GED', <?php echo($studentsWithGED[0][0]['count(*)']);?>],
				['Graduated High School',   <?php echo($studentsGraduatedHS[0][0]['count(*)']);?>],
				['In College',       <?php echo($studentsWithSomeCollege[0][0]['count(*)']);?>],
				['Graduated College',       <?php echo($studentsGraduatedCollege[0][0]['count(*)']);?>],
				['In Grad School',       <?php echo($studentsInGradSchool[0][0]['count(*)']);?>],
				['Graduated Grad School',       <?php echo($studentsGraduatedGradSchool[0][0]['count(*)']);?>],
				['Unknown', <?php echo($UnknownEducation);?>]
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

<?php //get the current URL so that we can use it to build the links below (relative links don't work because of the case where we're just on the page /charts/ )
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$urlWithoutArguments = substr($url, 0, strpos($url, '/charts'));
?>

<div class="btn-toolbar pagination-centered" role="toolbar">
  <div class="btn-group" role="group">
	<a href="<?php echo($urlWithoutArguments);?>/charts/all" class="btn btn-default" <?php IF($argument=='all'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>All Members and Interns</a>
  </div>
  <div class="btn-group" role="group" aria-label="...">
	<a href="<?php echo($urlWithoutArguments);?>/charts/maryland" class="btn btn-default" <?php IF($argument=='maryland'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Maryland</a>
	<a href="<?php echo($urlWithoutArguments);?>/charts/dc" class="btn btn-default disabled" <?php IF($argument=='dc'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Washington DC</a>
	<a href="<?php echo($urlWithoutArguments);?>/charts/virginia" class="btn btn-default" <?php IF($argument=='virginia'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Virginia</a>
  </div>
  <div class="btn-group" role="group" aria-label="...">
	<a href="<?php echo($urlWithoutArguments);?>/charts/montgomery" class="btn btn-default" <?php IF($argument=='montgomery'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Montgomery County</a>
	<a href="<?php echo($urlWithoutArguments);?>/charts/princeGeorges" class="btn btn-default" <?php IF($argument=='princeGeorges'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Prince George's County</a>
	<a href="<?php echo($urlWithoutArguments);?>/charts/baltimore" class="btn btn-default disabled" <?php IF($argument=='baltimore'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>City of Baltimore</a>
	<a href="<?php echo($urlWithoutArguments);?>/charts/arlington" class="btn btn-default disabled" <?php IF($argument=='arlington'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Arlington County</a>
	<a href="<?php echo($urlWithoutArguments);?>/charts/alexandria" class="btn btn-default" <?php IF($argument=='alexandria'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>City of Alexandria</a>
	<a href="<?php echo($urlWithoutArguments);?>/charts/fairfax" class="btn btn-default" <?php IF($argument=='fairfax'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Fairfax County</a>
  </div>
</div>
<hr />
<div id="education_container" style="min-width: 310px; height: 400px"></div>
<hr />
<!--
<div id="where_are_they_now_container" style="min-width: 310px; height: 400px"></div>
-->

