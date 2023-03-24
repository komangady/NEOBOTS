//=============================================== START TEMPERATURE ========================================
var ctx1 = document.getElementById("temperature");
var temperature = new Chart(ctx1, {
    type: 'line',
    data: {
        labels: ["00:00", "00:00", "00:00", "00:00", "00:00", "00:00"],
        datasets: [{
            label: "Temperature",
            fill: true,
            lineTension: 0.1,
            backgroundColor: "rgba(251,150,120,0.4)",
            borderColor: "rgba(251,150,120,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(251,150,120,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(251,150,120,1)",
            pointHoverBorderColor: "rgba(250,250,250,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: [0, 0, 0, 0, 0, 0]
        }],
    },
    options: {
        
    }
});
//=============================================== END TEMPERATURE ========================================


//=============================================== START HUMIDITY ========================================
var ctx1 = document.getElementById("humidity");
var humidity = new Chart(ctx1, {
    type: 'line',
    data: {
        labels: ["00:00", "00:00", "00:00", "00:00", "00:00", "00:00"],
        datasets: [{
            label: "Humidity",
            fill: true,
            lineTension: 0.1,
            backgroundColor: "rgba(3,169,243,0.4)",
            borderColor: "rgba(3,169,243,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(3,169,243,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(3,169,243,1)",
            pointHoverBorderColor: "rgba(250,250,250,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: [0, 0, 0, 0, 0, 0]
        }],
    },
    options: {
        
    }
});
//=============================================== END HUMIDITY ========================================


//=============================================== START HUMIDITY ========================================
var ctx1 = document.getElementById("heartbeat");
var heartbeat = new Chart(ctx1, {
    type: 'line',
    data: {
        labels: ["00:00", "00:00", "00:00", "00:00", "00:00", "00:00"],
        datasets: [{
            label: "Heartbeat",
            fill: true,
            lineTension: 0.1,
            backgroundColor: "rgba(171,140,228,0.4)",
            borderColor: "rgba(171,140,228,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(171,140,228,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(171,140,228,1)",
            pointHoverBorderColor: "rgba(250,250,250,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: [0, 0, 0, 0, 0, 0]
        }],
    },
    options: {
        
    }
});
//=============================================== END HUMIDITY ========================================


var cnt = 0;
var fn = function graph() {	  
	var date = getServerTime();
		
	//=============================================== START WEIGHT ============================================
	document.getElementById("value_weight").innerHTML = value_weight;
	document.getElementById("time_weight").innerHTML = time_weight;
	//=============================================== END WEIGHT ==============================================
	
	//=============================================== START LDR ============================================
	document.getElementById("value_ldr").innerHTML = value_ldr;
	document.getElementById("time_ldr").innerHTML = time_ldr;
	//=============================================== END LDR ==============================================
	
	//=============================================== START TEMPERATURE ========================================
	temperature.data.labels.splice(0, 1);
	temperature.data.datasets[0].data.splice(0, 1);

	// Means that the 2nd point becomes the first
	temperature.data.datasets[0].metaData.splice(0, 1);
	//temperature.data.labels.push(formatDate(new Date(time_temperature))); //time
	temperature.data.labels.push(time_temperature); //time
	temperature.data.datasets[0].data.push(value_temperature); //data		
	temperature.update();
	document.getElementById("value_temperature").innerHTML = value_temperature;
	document.getElementById("time_temperature").innerHTML = time_temperature;
	//=============================================== END TEMPERATURE ========================================
	
	
	//=============================================== START HUMIDITY ========================================
	humidity.data.labels.splice(0, 1);
	humidity.data.datasets[0].data.splice(0, 1);

	// Means that the 2nd point becomes the first
	humidity.data.datasets[0].metaData.splice(0, 1);
	humidity.data.labels.push(time_temperature); //time
	humidity.data.datasets[0].data.push(value_humidity); //data		
	humidity.update();
	document.getElementById("value_humidity").innerHTML = value_humidity;
	document.getElementById("time_humidity").innerHTML = time_humidity;
	//=============================================== END HUMIDITY ========================================
	
	
	//=============================================== START HEARTBEAT ========================================
	heartbeat.data.labels.splice(0, 1);
	heartbeat.data.datasets[0].data.splice(0, 1);

	// Means that the 2nd point becomes the first
	heartbeat.data.datasets[0].metaData.splice(0, 1);
	heartbeat.data.labels.push(time_temperature); //time
	heartbeat.data.datasets[0].data.push(value_heartbeat); //data		
	heartbeat.update();
	document.getElementById("value_heartbeat").innerHTML = value_heartbeat;
	document.getElementById("time_heartbeat").innerHTML = time_heartbeat;
	//=============================================== END HEARTBEAT ========================================
	
	
	
	//format waktu didapatkan berdasarkan waktu server
	//console.log(formatDate(new Date(getServerTime())));  // show current date-time in console
	//cnt++;
	document.getElementById("time_server").innerHTML = "<strong><center>Time Server </center></strong> "+ date;
};
setInterval(fn, 2500);

function getServerTime() {
  return $.ajax({async: false}).getResponseHeader( 'date' );
}

function formatDate(date) {
  var monthNames = [
    "January", "February", "March",
    "April", "May", "June", "July",
    "August", "September", "October",
    "November", "December"
  ];

  var day = date.getDate();
  var monthIndex = date.getMonth();
  var year = date.getFullYear();
  var jam = date.getHours();
  var menit = date.getMinutes();
  var detik = date.getSeconds();

  //return day + ' ' + monthNames[monthIndex] + ' ' + year;
  return day + '/' + (monthIndex+1) + '/' + year + ' '+jam+':'+menit+':'+detik;
}






 
