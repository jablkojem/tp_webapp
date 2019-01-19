function showChart(uLogin) {
    var myValues;
    $.post("getData.php",
        {
            uLogin: uLogin,
        },
        function(data, status){
            console.log(data);
            document.getElementById("chart2").className = "chart2";
            document.getElementById("chart2").style.visibility = "visible";
            document.getElementById("chartShow").style.visibility = "visible";
            document.getElementById("chart2").className += " w3-animate-zoom";
            myValues = $.parseJSON(data);
            //console.log(myValues.datum[1]);
            //console.log(myValues.glukoza[1]);


            var data = [
                {
                    mode: 'markers',
                    x: myValues.datum,
                    y: myValues.glukoza,
                    type: 'scatter',

                    marker: {
                        color: 'rgb(142, 124, 195)',
                        size: 5
                    },
                }
            ];

            var layout = {
                title: 'Visualization of Insulin and Carb action curves',
                xaxis: {
                    title: 'dátum',
                    showgrid: false,
                    //range: [myValues.datum[50], myValues.datum[80]],
                    zeroline: false
                },
                yaxis: {
                    title: 'glikémia',
                    range: [0, 20],
                    showline: false
                }
            };


            Plotly.newPlot('myDiv', data,layout);

        });

}

function closeChart() {
    document.getElementById("chart2").style.visibility = "hidden";
    document.getElementById("chart2").className = "";
    document.getElementById("chartShow").style.visibility = "hidden";
    document.getElementById("myDiv").remove();
    var div = document.createElement('div');
    var d =   document.getElementById("chart2");
    div.id = "myDiv";
    div.className ="chart";
    d.appendChild(div);
}