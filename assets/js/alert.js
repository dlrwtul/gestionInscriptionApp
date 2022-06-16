const btnQuitAlerts = document.querySelectorAll(".quit-alert");
let element = '';
btnQuitAlerts.forEach(btnQuitAlert => {
    btnQuitAlert.parentElement.classList.add("animate-bounce");
    btnQuitAlert.addEventListener('click', (e) =>{
        if (e.target.parentElement.nodeName == 'DIV') {
            element = e.target.parentElement;
        }else {
            element = e.target.parentElement.parentElement;
        }
        element.classList.add("hidden");
        e.stopPropagation();
    })
    
});

btnQuitAlerts.forEach(btnQuitAlert => {
    setTimeout(() => {
        btnQuitAlert.parentElement.classList.remove("animate-bounce");
    }, 1000);
});
