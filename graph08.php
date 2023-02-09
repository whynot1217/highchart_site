<div id="snpPnlGraph" style="width: 700px; height: 200px; margin: 0 auto;"></div>

<script>
$(function () {
	//첫번째 데이터 값
	let DataList01 = [];
<?
	foreach($cData01 as $k => $v){
?>
	str = "<?=$k?>";
	strArr = str.split('-');
	xData = new Date(strArr[0], strArr[1]-1, strArr[2]);

	DataList01.push({x: xData, y: <?=$v?>});
<?
	}
?>

	//두번째 데이터 값
	let DataList02 = [];
<?
	foreach($cData02 as $k => $v){
?>
	str = "<?=$k?>";
	strArr = str.split('-');
	xData = new Date(strArr[0], strArr[1]-1, strArr[2]);

	DataList02.push({x: xData, y: <?=$v?>});
<?
	}
?>


	Highcharts.chart('snpPnlGraph', {
		chart: {
			type: 'line'
		},
		title: {
			text: ''
		},
		xAxis: {
			type: 'datetime',
			crosshair: true,
			labels: {
				formatter: function() {
					return Highcharts.dateFormat('%b %Y', this.value);
				}
			}
		},
		yAxis: {
			crosshair: true,
			title: {
				text: ''
			}
		},
		tooltip: {
			xDateFormat: '%Y',
			shared: true,
			formatter: function () {
				var s = '<b>' + Highcharts.dateFormat('%Y.%m.%d', this.x) + '</b>';
				$.each(this.points, function (idx, point) {
					s += "<br/><span style='color: #000;'>" + this.series.name +" : "+ point.y  +"</span>";
				});
				return s;
			}
		},
		legend: {
			enabled: false
		},
		credits: {
			enabled: false
		},
		exporting: {
			enabled: false
		},
		plotOptions: {
			area: {
				marker: {
					radius: 2
				},
				lineWidth: 1,
			},
			series: {
				turboThreshold:10000,
				label: {
					enabled: false
				}
			}
		},
		series: [{
			type: 'spline',
			name: '<?=$snpPnlSymbol01?>',
			id: 'series-1',
			data: DataList01, //첫번째 데이터값
			color: '#f86a87',
			fillColor: {
				linearGradient: {
					x1: 0,
					y1: 0,
					x2: 0,
					y2: 1
				},
				stops: [
					[0, 'rgb(248,106,135,0.7)'],
					[1, 'rgb(255,255,255,0.5)']
				]
			}
		},{
			type: 'spline',
			name: 'S&P 500',
			id: 'series-2',
			data: DataList02,  //두번째 데이터값
			fillColor: {
				linearGradient: {
					x1: 0,
					y1: 0,
					x2: 0,
					y2: 1
				},
				stops: [
					[0, 'rgb(57,161,232,0.7)'],
					[1, 'rgb(255,255,255,0.5)']
				]
			}
		}]
	});
});
</script>
