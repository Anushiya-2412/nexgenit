//-----start edit client-------------------------------------



function goEditEmp(editId)
{ 
    alert("edit");
      $.ajax({
        url: 'action/actClients.php',
        method: 'POST',
        data: {
          editId: editId
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {

          $('#editid').val(response.client_id);
          $('#editname').val(response.client_name);
          $('#editCompany').val(response.client_company);
          $('#editlocation').val(response.client_location);
          $('#editemail').val(response.client_email);
          $('#editmobile').val(response.client_phone);
          $('#editgst').val(response.client_gst);
          
          

          $('#clientTable').load(location.href + ' #clientTable > *', function() {
                               
                               $('#clientTable').DataTable().destroy();
                               
                                $('#clientTable').DataTable({
                                    "paging": true, // Enable pagination
                                    "ordering": true, // Enable sorting
                                    "searching": true // Enable searching
                                });
                            });
         

        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    
}
//-----end edit Client-------------------------------

//-----------start delete client--------------------
function goDeleteClient(id)
{
    //alert(id);
    if(confirm("Are you sure you want to delete employee?"))
    {
      $.ajax({
        url: 'action/actClients.php',
        method: 'POST',
        data: {
          deleteId: id
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          $('#clientTable').load(location.href + ' #clientTable > *', function() {
                               
                               $('#clientTable').DataTable().destroy();
                               
                                $('#clientTable').DataTable({
                                    "paging": true, // Enable pagination
                                    "ordering": true, // Enable sorting
                                    "searching": true // Enable searching
                                });
                            });
         

        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
    }
}
//------------end delete client -------------------


//-----------start view client---------------------

function goViewClient(id)
{
    //location.href = "clientDetail.php?clientId="+id;
    $.ajax({
        url: 'clientDetail.php',
        method: 'POST',
        data: {
            id: id
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
          $('#clientTable').hide();
          $('#clientDetail').html(response);
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}


//-----------end view client ----------------------

//pdf download --------------- -----------------
$(document).ready(function() {
    $('#myForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        var formData = new FormData(this);
        
        
        
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'process.php', // URL of the PHP script
            data: formData, // Form data to be sent
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function(response) {
                $('#collegeStoreModal').modal('hide'); // Close the modal
                $('#myForm')[0].reset();
                header("Location: invoice.php");

                
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });
});

//------------end pdf -------------------------------


//--end pdf download------------



function viewStudent(studentId) {
    $.ajax({
        url: 'employeeDetail.php',
        method: 'POST',
        data: {
            id: studentId
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
            // Handle the successful response here
            if (response && typeof response === 'object') {
                // Check if response is a valid object
             //   $('.nav.nav-tabs.page-header-tab').hide();  // Hide a navigation tab
              //  $('#Student-profile').addClass('active');
              //  $('#Student-all').removeClass('active');
                
                // Update UI elements with data from the response object
                $('#firstname1').text(response.first_name || '');
                $('#lastname1').text(response.last_name || '');
                $('#dateOfBirth1').text(response.date_of_birth || '');
                $('#gender1').text(response.gender || '');
                $('#email1').text(response.email || '');
                $('#address1').text(response.address || '');
                $('#registrationDate1').text(response.registration_date || '');
                $('#class1').text(response.standard || '');
                $('#mobileNo1').text(response.student_phone || '');
                $('#parentsName1').text(response.parent_name || '');
                $('#parentsMobileNo1').text(response.parent_phone || '');
                $('#parent_occupation1').text(response.parent_occupation || '');
                $('#parent_income1').text(response.parent_income || '');
                $('#username1').text(response.username || '');
                $('#password1').text(response.password || '');
                $('#bloodgroup1').text(response.stud_blood || '');  
                $('#caste1').text(response.stud_caste || '');            
                $('#religion1').text(response.stud_religion || '');      
                $('#aadar1').text(response.stud_aadhar || '');     
                $('#idenmark1').text(response.stud_identify_mark || '');  
                $('#transport1').text(response.stud_transport || '');     
                $('#mothertongue1').text(response.stud_mother_tongue || '');  
                $('#native1').text(response.stud_native || '');
                $('#academicYear1').text(response.academic_year);
                
            
                var image = response.profile_picture || ''; 
            
                // Set the src attribute of the profileImage
                $("#profileImage").attr("src", "assets/images/student/" + image);
            }
            
            else {
                console.error('Invalid response format');
            }
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}
