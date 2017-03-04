var chartConfig;
var barBtn, lineBtn;
$( document ).ready(function() {
    getAmountByMonth();

    barBtn = $('#barBtn');
    lineBtn = $('#lineBtn');

    barBtn.on('click', function() {
    	lineBtn.removeClass('disabled');
    	barBtn.addClass('disabled');
    	drawBarChart();
    });

    lineBtn.on('click', function() {
    	barBtn.removeClass('disabled');
    	lineBtn.addClass('disabled');
    	drawLineChart();
    })

    drawTable();
});

function getAmountByMonth() {
	$.ajax({
		url: 'http://api.assignment.dev/payments/get-amount-by-month',
		crossDomain: true,
		dataType: 'json',
		success: function(response) {
			if (response.success) {
				createChartConfig(response.data);
				// drawBarChart();
				barBtn.click();
			}
		}
	});
}
function createChartConfig(data) {
	chartConfig = {
	  data: {
	    labels: ['January', 'February', 'March', 'April', 'May', 'June', 
	    	'July', 'August', 'September', 'October', 'November', 'December'],
	    datasets: [{
	      label: 'Amount',
	      data: data,
	      backgroundColor: "rgba(153,255,51,0.4)"
	    }]
	  }
	};
}

function drawBarChart() {
	chartConfig.type = 'bar';
	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, chartConfig);
}

function drawLineChart() {
	chartConfig.type = 'line';
	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, chartConfig);
}

function drawTable() {
    $('#myTable').DataTable( {
    	"searching": false,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "http://api.assignment.dev/payments/paginate",
            "type": "POST"
        },
        "columns": [
		    { 'orderable': true },
		    { 'orderable': false },
		    { 'orderable': false },
		    { 'orderable': false },
		]
    });
}