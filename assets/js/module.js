const url = "http://127.0.0.1:8000/";


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

function get_data(route) {
    let data = get_set_data(url,route);
    data.then((value) => {
        console.log(value);
    })
}
const libModule = document.getElementsByName("libelle-module");
if (!null == libModule) {
    libModule[0].addEventListener("keyup", (e) =>{
        if (e.keyCode == 13) {
            send_data([libModule[0].value],"module/new");
            libModule[0].value = ""
            window.location = url + "module";
        }
    })
}
