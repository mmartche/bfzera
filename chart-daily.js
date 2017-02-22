// google.charts.load('current', {'packages':['corechart']});
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

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
        colors: ['#a52714', 'yellow', 'blue', '#000000', 'green', '#ccc' ,'black', 'pink']
    };

    var raddasTotal = new google.visualization.DataTable();
      raddasTotal.addColumn('string', '');
      raddasTotal.addColumn('number', 'FARRELL_E_TALITA');
      raddasTotal.addColumn('number', 'mmartche_br');
      raddasTotal.addColumn('number', 'nderato');
      raddasTotal.addColumn('number', 'thiagossegatto');
      raddasTotal.addColumn('number', 'RenanKillRJ');
    raddasTotal.addRows(dadosRaddaTotal);
    var chart = new google.charts.Line(document.getElementById('raddasTotal'));
    chart.draw(raddasTotal, options);

    var raddasPerDay = new google.visualization.DataTable();
      raddasPerDay.addColumn('string', '');
      raddasPerDay.addColumn('number', 'FARRELL_E_TALITA');
      raddasPerDay.addColumn('number', 'mmartche_br');
      raddasPerDay.addColumn('number', 'nderato');
      raddasPerDay.addColumn('number', 'thiagossegatto');
      raddasPerDay.addColumn('number', 'RenanKillRJ');
    raddasPerDay.addRows(dadosRaddaPerDay);
    var chartRaddaPerDay = new google.charts.Line(document.getElementById('raddasPerDay'));
    chartRaddaPerDay.draw(raddasPerDay, options);

    var raddasDeaths = new google.visualization.DataTable();
      raddasDeaths.addColumn('string', '');
      raddasDeaths.addColumn('number', 'FARRELL_E_TALITA');
      raddasDeaths.addColumn('number', 'mmartche_br');
      raddasDeaths.addColumn('number', 'nderato');
      raddasDeaths.addColumn('number', 'thiagossegatto');
      raddasDeaths.addColumn('number', 'RenanKillRJ');
    raddasDeaths.addRows(dadosRaddaDeaths);
    var chartRaddaDeaths = new google.charts.Line(document.getElementById('raddasDeaths'));
    chartRaddaDeaths.draw(raddasDeaths, options);

    var raddasKillAssists = new google.visualization.DataTable();
      raddasKillAssists.addColumn('string', '');
      raddasKillAssists.addColumn('number', 'FARRELL_E_TALITA');
      raddasKillAssists.addColumn('number', 'mmartche_br');
      raddasKillAssists.addColumn('number', 'nderato');
      raddasKillAssists.addColumn('number', 'thiagossegatto');
      raddasKillAssists.addColumn('number', 'RenanKillRJ');
    raddasKillAssists.addRows(dadosRaddaKillAssists);
    var chartRaddaKillAssists = new google.charts.Line(document.getElementById('raddasKillAssists'));
    chartRaddaKillAssists.draw(raddasKillAssists, options);

    var raddasKdr = new google.visualization.DataTable();
      raddasKdr.addColumn('string', '');
      raddasKdr.addColumn('number', 'FARRELL_E_TALITA');
      raddasKdr.addColumn('number', 'mmartche_br');
      raddasKdr.addColumn('number', 'nderato');
      raddasKdr.addColumn('number', 'thiagossegatto');
      raddasKdr.addColumn('number', 'RenanKillRJ');
    raddasKdr.addRows(dadosRaddaKdr);
    var chartRaddaKdr = new google.charts.Line(document.getElementById('raddasKdr'));
    chartRaddaKdr.draw(raddasKdr, options);


  
}



































