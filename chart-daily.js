// google.charts.load('current', {'packages':['corechart']});
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

var raddasTotal = new google.visualization.DataTable();
var raddasPerDay = new google.visualization.DataTable();
  raddasTotal.addColumn('string', '');
  raddasTotal.addColumn('number', 'FARRELL_E_TALITA');
  raddasTotal.addColumn('number', 'mmartche_br');
  raddasTotal.addColumn('number', 'nderato');
  raddasTotal.addColumn('number', 'thiagossegatto');
  raddasTotal.addColumn('number', 'UrsoYogi');
  raddasTotal.addColumn('number', 'Valdeirsilva12');
  raddasPerDay.addColumn('string', '');
  raddasPerDay.addColumn('number', 'FARRELL_E_TALITA');
  raddasPerDay.addColumn('number', 'mmartche_br');
  raddasPerDay.addColumn('number', 'nderato');
  raddasPerDay.addColumn('number', 'thiagossegatto');
  raddasPerDay.addColumn('number', 'UrsoYogi');
  raddasPerDay.addColumn('number', 'Valdeirsilva12');


raddasTotal.addRows(dadosRaddaTotal);

raddasPerDay.addRows(dadosRaddaPerDay);
  var options = {
    chart: {
      title: '',
      subtitle: ''
    },
    hAxis: {
      title: ''
    },
    vAxis: {
      title: 'raddas'
    },
    colors: ['#a52714', 'yellow', 'blue', '#000000', 'green', '#ccc' ,'black']
  };
  var chart = new google.charts.Line(document.getElementById('raddasTotal'));
  chart.draw(raddasTotal, options);
  var chartRaddaPerDay = new google.charts.Line(document.getElementById('raddasPerDay'));
  chartRaddaPerDay.draw(raddasPerDay, options);
}