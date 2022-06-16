import emailautocomplete from 'js-email-autocomplete'
/* const inputMatricule = document.getElementById("matricule-re");
const div = document.querySelector(".add-inscription.re")
const form = document.getElementsByName("inscription")

console.log(form[0]);

if (form != undefined) {
    if (form[0].parentElement.id == "re-form" ) {
        for (let index = 0; index < form[0].length-3; index++) {
            form[0][index].readOnly = true;
        }
    }
} */

/* $(document).ready(function() 
	{
		  $("#inscription_etudiant_login").emailautocomplete({
			domains: ["codefixup.com"] //add your own domains
		  });
	});

 */
    const elem = document.getElementById('inscription_etudiant_login')
    emailautocomplete(elem, {
    domains: ["example.com"], //add your own specific domains to top of default list
    suggClass: 'eac-suggestion' //add your own class
    });



/* const url = "http://127.0.0.1:8000/";


async function get_set_data(url,route,array = {}) {

    realUrl = url + route;

    let form = new FormData()
    form.append("datas",JSON.stringify(array));

    let myHeaders =  new Headers();

    var request = new Request(realUrl,{
        method: "POST",
        body: form,
        headers: myHeaders
    });

    try {
        let response = await fetch(request);
        return  response;
    } catch (err) {
        console.log("error");
    }
}

async function send_data(array,route) {
    let data = get_set_data(url,route,array);
    data.then((value) => {
        console.log(value);
    })
}

inputMatricule.addEventListener('keyup',(e)=>{
    if (e.keyCode == 13) {
        console.log(inputMatricule.value)
        send_data([inputMatricule.value],"inscription/new-re");
        inputMatricule.value = ""
        window.location = url + "inscription/new-re";
    }
})   */