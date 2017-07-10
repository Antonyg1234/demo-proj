
var ctx = $("#myChart");
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: label,
            datasets: 
                    [{
                      label: labelname,
                      data: data,
                      backgroundColor: "rgba(255,153,0,1)"
                    }]
          }
        });