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

<div id="chart_container" style="min-width: 310px; height: 400px"></div>
