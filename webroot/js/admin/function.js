//checkpass and length
 function checkpass(){
		
	 var chk=true;
		var pass=$('#password').val();
              console.log(pass);
                        var len=$('#password').val().length;
                       // alert(len);
		var cpass=$('#confirmpassd').val();
                 
		
		if(pass!=cpass){
			alert('password and confirm password should be same');
			chk=false;
			return chk;
		}else if(len<6){
			
			alert('Password greater than six character');
                        chk=false;
                        return chk;
		}
 }
 
function addskill(ele){
var fruits = [];
var other = [];

$("input:checkbox[class=chk]").each(function () {
          if($(this).is(":checked")){
             fruits.push($(this).val());
             other.push($(this).attr("data-skill-type"));   
            }else{
              
          }
    
        });
     
         
      $('#skill').val(fruits);
      $('#skillshow').val(other);
}

function myFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";

        }
    }
}
 
