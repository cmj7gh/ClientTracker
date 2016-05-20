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
                },
                //events:{
                //  click: function (event, i) {
				//	// window.location = "/students/index/<?php echo($argument);?>/" + this.options.ownURL;
                //    alert(JSON.stringify(this.options.data))
                //  }
				//}
            }
        },
        series: [{
            type: 'pie',
            name: 'Student Status',
            data: [
				{name: 'In High School',  y: <?php echo($membersInHS[0][0]['count(*)']);?>, ownURL: 'inHS'},
				{name: 'Dropped Out Of High School', y: <?php echo($studentsDroppedOutOfHS[0][0]['count(*)']);?>, ownURL: 'droppedOut'},
                {name: 'GED', y: <?php echo($studentsWithGED[0][0]['count(*)']);?>, ownURL: 'GED'},
				{name: 'Graduated High School', y: <?php echo($studentsGraduatedHS[0][0]['count(*)']);?>, ownURL: 'graduatedHS'},
				{name: 'In College', y: <?php echo($studentsWithSomeCollege[0][0]['count(*)']);?>, ownURL: 'inCollege'},
				{name: 'Graduated College', y: <?php echo($studentsGraduatedCollege[0][0]['count(*)']);?>, ownURL: 'graduatedCollege'},
				{name: 'In Grad School', y: <?php echo($studentsInGradSchool[0][0]['count(*)']);?>, ownURL: 'inGradSchool'},
				{name: 'Graduated Grad School', y: <?php echo($studentsGraduatedGradSchool[0][0]['count(*)']);?>, ownURL: 'graduatedGradSchool'},
				{name: 'Unknown', y: <?php echo($UnknownEducation);?>, ownURL: 'unknown'}
            ],
            point: {
                events:{
                  click: function (event, i) {
                    window.location = "/students/index/<?php echo($argument);?>/" + this.options.ownURL;
                  }
                }
            }
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
	<a href="/pages/charts/all" class="btn btn-default" <?php IF($argument=='all'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>All Members and Interns
    </a>
  </div>
  <div class="btn-group" role="group" aria-label="...">
	<a href="/pages/charts/maryland" class="btn btn-default" <?php IF($argument=='maryland'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Maryland</a>
	<a href="/pages/charts/dc" class="btn btn-default disabled" <?php IF($argument=='dc'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Washington DC</a>
	<a href="/pages/charts/virginia" class="btn btn-default" <?php IF($argument=='virginia'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Virginia</a>
  </div>
  <div class="btn-group" role="group" aria-label="...">
	<a href="/pages/charts/montgomery" class="btn btn-default" <?php IF($argument=='montgomery'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Montgomery County</a>
	<a href="/pages/charts/princeGeorges" class="btn btn-default" <?php IF($argument=='princeGeorges'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Prince George's County</a>
	<a href="/pages/charts/baltimore" class="btn btn-default disabled" <?php IF($argument=='baltimore'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>City of Baltimore</a>
	<a href="/pages/charts/arlington" class="btn btn-default disabled" <?php IF($argument=='arlington'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Arlington County</a>
	<a href="/pages/charts/alexandria" class="btn btn-default" <?php IF($argument=='alexandria'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>City of Alexandria</a>
	<a href="/pages/charts/fairfax" class="btn btn-default" <?php IF($argument=='fairfax'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Fairfax County</a>
  </div>
</div>
<hr />
<div id="education_container" style="min-width: 310px; height: 400px"></div>
<hr />

Instructions: mouse over each wedge to see summary statistics, or click on the wedge to see the list of students included.

<!--
<div id="where_are_they_now_container" style="min-width: 310px; height: 400px"></div>
-->
