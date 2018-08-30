$(document).ready(function(){
    var icSpans = document.getElementsByClassName("ic");
    for (i = 0; i <icSpans.length; i++){
        var st= icSpans[i].textContent;
        if(st.indexOf('+') != -1){
            icSpans[i].className += " text-success";
        }
        else if(st.indexOf('-') != -1){
            icSpans[i].className += " text-danger";
        }
        else {
            icSpans[i].className += " text-secondary";
        }
    }
    
});
