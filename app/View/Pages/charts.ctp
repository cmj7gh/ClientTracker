<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
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
	var chart;
	var defaultOptions = {
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
					formatter: function() {
                    	return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.y,0) + ' (' + Highcharts.numberFormat(this.percentage,1) +'%)';
                	}
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
	};

	Highcharts.setOptions({
		lang: {
			thousandsSep: ','
		}
	});
	
	function drawDefaultChart() {
		chart = Highcharts.chart('education_container',defaultOptions);
	}
	
	drawDefaultChart();

	$('#toggleInHS').click(function () {
	
		var keys = Object.keys(chart.series[0].data);
	
		console.log(keys.length);
        if(keys.length === 9){ //there should be 9 wedges if we haven't yet removed IN HS
			chart.series[0].removePoint(0);
		}else{
			//chart.destroy();
			//chart1 = Highcharts.chart('education_container',defaultOptions);
			//reloading the whole page is kind of annoying, but I can't find another way to get it to work.
			//the code above should work, but it's redrawing the page with the HS wedge removed.
			location.reload();
		}
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
	<a href="/pages/charts/dc" class="btn btn-default" <?php IF($argument=='dc'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Washington DC</a>
	<a href="/pages/charts/virginia" class="btn btn-default" <?php IF($argument=='virginia'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Virginia</a>
  </div>
  <div class="btn-group" role="group" aria-label="...">
	<a href="/pages/charts/montgomery" class="btn btn-default" <?php IF($argument=='montgomery'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Montgomery County</a>
	<a href="/pages/charts/princeGeorges" class="btn btn-default" <?php IF($argument=='princeGeorges'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Prince George's County</a>
	<a href="/pages/charts/baltimore" class="btn btn-default" <?php IF($argument=='baltimore'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>City of Baltimore</a>
	<a href="/pages/charts/arlington" class="btn btn-default" <?php IF($argument=='arlington'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Arlington County</a>
	<a href="/pages/charts/alexandria" class="btn btn-default" <?php IF($argument=='alexandria'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>City of Alexandria</a>
	<a href="/pages/charts/fairfax" class="btn btn-default" <?php IF($argument=='fairfax'){echo('style="background-image: linear-gradient(#999,#999 5%,#999);"');} ?>>Fairfax County</a>
  </div>
  <div class="btn-group" role="group" aria-label="...">
	<button id="toggleInHS" class="btn btn-default" style="margin: auto;">Add/Remove 'In High School'</button>
  </div>
</div>
<hr />
<div id="education_container" style="min-width: 310px; height: 400px"></div>
<div class="well well-small" style="width: 50%; margin: auto; text-align: center; font-weight: bold;">
	<p> In addition, we have served <?php echo($nonMembersInterns[0][0]['count(*)']);?> other students through job skills workshops or one-off services </p>
</div>
<hr />
<!--
<div id="where_are_they_now_container" style="min-width: 310px; height: 400px"></div>
-->
