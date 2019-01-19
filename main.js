var myValues;

$.post("getData.php",
    {

    },
    function(data, status){
        console.log(data);
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




