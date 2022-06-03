const btnQuitAlerts = document.querySelectorAll(".quit-alert");

btnQuitAlerts.forEach(btnQuitAlert => {
    btnQuitAlert.parentElement.classList.add("animate-bounce");
    btnQuitAlert.addEventListener('click', (e) =>{
        const div = e.target.parentElement;
        div.classList.add("hidden");
    })
    
});

btnQuitAlerts.forEach(btnQuitAlert => {
    setTimeout(() => {
        btnQuitAlert.parentElement.classList.remove("animate-bounce");
    }, 3000);
});
