function newsletterAlert(email){
    if(email.length > 0){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                alert("Your email has been added to our mailing list.")
            }
        }
        xmlhttp.open("GET", "newsletter_insert.php?q="+email, true);
        xmlhttp.send();
    }
}