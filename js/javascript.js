

/*First Name validation when enter first name a text will be displayed regarding the first name's valid lenght and type of character*/
function showtext(){/**displays a hint for valid user first name */
    document.getElementById("fname_span").textContent = "Your first name cannot be less than 3 character or contain any number";
}
function hidetext(){/** hides first name hint */
    document.getElementById("fname_span").textContent ="";
}
function lshow(){/**displays a hint for valid user last name */
    document.getElementById("lname_span").textContent = "Your last name cannot be less than 3 characters or contain any number";
}
function lhide(){/** hides last name hint */
    document.getElementById("lname_span").textContent ="";
}
function eshow(){/**displays a hint for valid user Email */
    document.getElementById("email_span").textContent = "correct email: example_digit/digits@gmail.com";
}
function ehide(){/** hides Email hint*/
    document.getElementById("email_span").textContent ="";
}
function idShow(){
    document.getElementById("id_span").textContent = "starts with letter 's' followed by 5 digits";
}
function idHide(){
    document.getElementById("id_span").textContent ="";
}
/*Form validation, checks if user has entered valid type of data in the form*/
function validate_form(){
    var first_name = document.forms["forms"]["fname"].value; /** gets user's firstname */
    var last_name = document.forms["forms"]["lname"].value; /**gets user's last name */
    var user_email = document.forms["forms"]["email"].value;
    var user_id = document.forms["forms"]["student_id"].value;
   
    const names_pattern = "^[a-zA-Z]{3,30}( [a-zA-Z]{3,30})*$";/** setting pattern indicates the inpute should be in this criteria*/
    const email_pattern = "^[a-zA-Z0-9._%+-]+@gmail\.com$"; /**declaring pattern for email */
    const id_pattern = new RegExp("^s\\d{5}$");/**the student ID entered by user must start with letter "s" followed by 5 digits */
    const checkboxes = document.querySelectorAll(".options");


    var user_enquiry = document.forms["forms"]["form_subject"].value;
    const user_enquiry_pattern = /^[a-zA-Z0-9\s.,!?'"()\r\n\-]{3,1000}$/;

 
    
    var isChecked = false;
    
        if (first_name ==""){ /**checks the user has not left the inputs(first name and last name) empty */
            alert("Firstname can not be empty!");
            return false;
        }
        if(!first_name.match(names_pattern)){ /**checks if the user's firstname input matches the pattern */
            alert("Enter a valid firstname");
             return false;
         }
         if (last_name ==""){ /**checks the user has not left the inputs(first name and last name) empty */
        alert("You must Enter your Lastname!");
        return false;
         }
         if(!last_name.match(names_pattern)){/**checks if the user's lastname input matches the pattern */
            alert("Enter a valid Lastname");
         }

         if(user_email ==""){/**checks the user has not left the Email empty */
            alert("Enter your Email address");
            return false;
         }
         if(!user_email.match(email_pattern)){/**checks if the user's Email input matches the pattern */
            alert("invalid Email! \n your email must not start with Upper_case, sign/symbol, dot");
            return false;
         }
         if(user_id==""){
            alert("Enter Your ID");
            return false;
         }
         if(!user_id.match(id_pattern)){
            alert("invalid ID");
         }

         checkboxes.forEach((checkbox) => {
            if (checkbox.checked) isChecked = true;
            
         });
       
         
        if (user_enquiry == ""){
            alert("Ask Us Section Cannot be empty");
        }
        if(!user_enquiry.match(user_enquiry_pattern)){
            alert("Please enter a valid text!(No scripts or html tags) ");
            return false;
        }
        else(
            alert("Submitted Successfully!")
        )
}

 
function togglefunction1(){
    var toggle = document.getElementById("toggle_content1");
    if (toggle.style.display === 'none'){
        toggle.style.display = "inline";
    }
    else{
        toggle.style.display ='none';
    }
}
function togglefunction2(){
    var toggle = document.getElementById("toggle_content2");
    if (toggle.style.display === 'none'){
        toggle.style.display = "inline";
    }
    else{
        toggle.style.display ='none';
    }
}
function togglefunction3(){
    var toggle = document.getElementById("toggle_content3");
    if (toggle.style.display === 'none'){
        toggle.style.display = "inline";
    }
    else{
        toggle.style.display ='none';
    }
}
function togglefunction4(){
    var toggle = document.getElementById("toggle_content4");
    if (toggle.style.display === 'none'){
        toggle.style.display = "inline";
    }
    else{
        toggle.style.display ='none';
    }
}
function togglefunction5(){
    var toggle = document.getElementById("toggle_content5");
    if (toggle.style.display === 'none'){
        toggle.style.display = "inline";
    }
    else{
        toggle.style.display ='none';
    }
}
function togglefunction6(){
    var toggle = document.getElementById("toggle_content6");
    if (toggle.style.display === 'none'){
        toggle.style.display = "inline";
    }
    else{
        toggle.style.display ='none';
    }
}
function togglefunction7(){
    var toggle = document.getElementById("toggle_content7");
    if (toggle.style.display === 'none'){
        toggle.style.display = "inline";
    }
    else{
        toggle.style.display ='none';
    }
}
function togglefunction8(){
    var toggle = document.getElementById("toggle_content8");
    if (toggle.style.display === 'none'){
        toggle.style.display = "inline";
    }
    else{
        toggle.style.display ='none';
    }
}
function togglefunction9(){
    var toggle = document.getElementById("toggle_content9");
    if (toggle.style.display === 'none'){
        toggle.style.display = "inline";
    }
    else{
        toggle.style.display ='none';
    }
    
}

