var DoctorID = null;

function closePanel() {
    document.getElementById("DoctorsPatients").style.visibility = "hidden";
    document.getElementById("DoctorsPatients").className = "";

}

function showPatiants(id) {
    DoctorID = id;
    var myValues;
    $.post("getPatients.php",
        {
            Did: id,
        },
        function(data, status){
            document.getElementById("DoctorsPatients").style.visibility = "visible";
            document.getElementById("DoctorsPatients").className = "w3-animate-zoom";
            document.getElementById("DoctorsPatients").innerHTML = "    <span onclick=\"closePanel()\" style=\"float: right;font-size: 20px;cursor: pointer\">&#10006</span>\n" +
                "    <a><i class=\"fa fa-fw fa-user-md\"></i> Doctor's patients:</a>" +

                "        "+data+"</table><input onclick='addPatient()' type='button' id='btnAdd' value='Add patient'>";
           // document.getElementById("chartShow").style.visibility = "visible";
           //  document.getElementById("chart2").className += " w3-animate-zoom";
           //myValues = $.parseJSON(data);
            //console.log(myValues.datum[1]);
            //console.log(myValues.glukoza[1]);

        });

}

function removePatient(id) {
    console.log(id+""+DoctorID);
    var myValues;
    $.post("removePatients.php",
        {
            patientId: id,
        },
        function(data, status){
            console.log(status);
            showPatiants(DoctorID);


        });
}

function addPatient() {
   var patientID = document.getElementById("choosedPatient").value;
    $.post("addPatient.php",
        {
            patiantId: patientID,
            dId: DoctorID,
        },
        function(data, status){

            console.log(data);
            showPatiants(DoctorID);

        });

}