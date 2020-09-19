var  inscription = document.getElementById("form_inscription");
var but = document.querySelector('#button');
var  identification = document.getElementById("form_identification");


//----------------------- STYLE ------------------------//

inscription.style.marginTop = "15%";
but.style.width = "100%";

// ------------------------ AJAX ----------------------//

inscription.addEventListener('submit', function(e){
    e.preventDefault();

    var xhr = new XMLHttpRequest() ;

        var data = new FormData(this) ;

        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.response)
                var res = this.response 
                if (res.success) {
                    console.log("Utilisateur inscrit !") 
                    alert(res.error)
                } else {
                    alert(res.error) 
                }
            } 
            else if (this.readyState == 4){
                alert("une erreur est survenue") 
            }
        };

        xhr.open("POST", "../Controllers/inscription.php", true)
        xhr.responseType = "json" 
 //     xhr.setRequestHeader('Content-type', 'json')
        xhr.send(data)

    return false 
});
