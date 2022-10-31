$('#selectformtype').change(function(){
    let check = $('#selectformtype').find(":selected").val();
    if(check === '1'){
        $('#form1').hide();
        if($('#form1').css('display') === 'none'){
            $('#form1').show();
            $('#form2').hide();
        }
    } else if (check === '2'){
        if($('#form2').css('display') === 'none'){
            $('#form1').hide();
            $('#form2').show();
        }
    }
})


$(document).ready(function(){
    $("#form1_submit").click(function(){
        let valid = "true";
        const data = [];
        data[0] = $('input[name="schoolname"]');
        data[1] = $('input[name="address"]');
        data[2] = $('input[name="city"]');

        for (let indexdata = 0; indexdata < data.length; indexdata++) {
            if (data[indexdata].val().trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data[indexdata].attr('placeholder') +' must be filled out!'
                })
                valid = "false";
            }  
        }

        let sch = document.getElementById('inputGroupSelect01').options; 
        console.log(sch.length);
        for (let x = 0; x < sch.length; x++) {
            if (data[0].val().toLowerCase() === sch[x].value.toLowerCase()){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'School name already used!'
                })
                valid = "false";
            }
            
        }

        if(valid === "true"){
            registschool();
        }
    });

    $("#form2").submit(function(){
        console.log("masuk");
        let valid = "true";
        let data = [];
        data[0] = $('input[name="col-uname"]');
        data[1] = $('input[name="col-pass"]');
        data[2] = $('input[name="col-fullname"]');
        data[3] = $('input[name="col-email"]');
        data[4] = $('input[name="col-phone"]');
        data[5] = $('input[name="col-pos"]');
        data[6] = $('#inputGroupSelect01');


        for (let indexdata = 0; indexdata < data.length; indexdata++) {
            if (data[indexdata].val().trim() == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data[indexdata].attr('placeholder') +' must be filled out!'
                })
                valid = "false";
            }
            if(data[6] === "0"){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Select School first!'
                })
                valid = "false";
            }
        }

        

        if(valid === "true"){
            registadminschool();
        }
    });
});   


function registschool(){
        
    let schoolname = $('input[name="schoolname"]').val().trim();
    let address = $('input[name="address"]').val().trim();
    let city = $('input[name="city"]').val().trim();
    $.ajax({
        url:'../conadmin/registerschool.php',
        type:'post',
        data:{schoolname:schoolname,address:address,city:city},
        success:function(response){
            
            let msg = "";
            // UPDATE TABLE AFTER REGIST
            let t = $('#schooltbl').DataTable();

                t.row.add([schoolname, address, city]).draw(false);
         

            $('#inputGroupSelect01').append($('<option>', {
                value: schoolname,
                text: schoolname
            }));
            $('#form1').trigger("reset");
            if(response == 1){
                Swal.fire({
                    icon: 'success',
                    title: 'Success adding new school, Do you want to register school administrator too?',
                    showDenyButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `No`,
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form1').hide();
                        $('#form2').show();
                    }
                    })
            } else {
                msg = "Something went wrong! please contact IT administrator";
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: msg
                })
            }
        }
    });
}





function registadminschool(){
        
    let data = [];
    data[0] = $('input[name="col-uname"]').val().trim();
    data[1] = $('input[name="col-pass"]').val().trim();
    data[2] = $('input[name="col-fullname"]').val().trim();
    data[3] = $('input[name="col-email"]').val().trim();
    data[4] = $('input[name="col-phone"]').val().trim();
    data[5] = $('input[name="col-pos"]').val().trim();
    data[6] = $('#inputGroupSelect01').val();
    $.ajax({
        url:'../conadmin/registadminschool.php',
        type:'post',
        data:{username:data[0], password:data[1], fullname:data[2], 
            email:data[3], phone:data[4], pos:data[5], school:data[6]},
        success:function(response){
            
            let msg = "";
            // UPDATE TABLE AFTER REGIST
            $('#form1').trigger("reset");
            if(response == 1){
                Swal.fire(
                    'Success!',
                    'Success adding new administrator to ' + data[6] + ' School',
                    'success'
                )
            } else {
                msg = "Something went wrong! please contact IT administrator";
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: msg
                })
            }
        }
    });
}