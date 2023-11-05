function validInfo(){
    var tp = document.getElementById("tp").value;
    var tn = document.getElementById("tn").value;
    var fp = document.getElementById("fp").value;
    var fn = document.getElementById("fn").value;
    
    var tp_num = parseInt(tp);  
    var tn_num = parseInt(tn);
    var fp_num = parseInt(fp);
    var fn_num = parseInt(fn);
    
    
    if (isNaN(tp_num) || isNaN(tn_num) || isNaN(fp_num) || isNaN(fn_num)) {
        alert("Invalid");
        return false;
    } 
    else {
        alert("Sucess");
        return true;
    }
}
