
function validation(json){
    if(json.check === "true"){
        document.querySelector("input").classList.add('is-valid');
        setTimeout( 'location="index.php";', 1000 );
    }
    else {
        for (let prop in json.erorrs){
            let print_err=document.createElement('div');
            print_err.classList.add('invalid-feedback');
            print_err.innerHTML = json.erorrs[prop];
            print_err.display='block'
            let el = document.getElementById(prop);
            el.classList.add('is-invalid');
            el.after(print_err);
        }
    }
}
async function login(target){
    let form = target;
    let login_data={
        "login": form.login.value,
        "password": form.password.value,
    };
    const url = "../controllers/controllers.php";
    let response = await fetch(url, {
        method: 'POST',
        headers: {'Content-Type': 'application/json;charset=utf-8'},
        body: JSON.stringify({login: login_data})
    });
    if (response.ok) {
        let json = await response.json();
        validation(json)
    } else {alert("Ошибка HTTP: " + response.status);}
}

async function registration(target){
    let form = target;
    let registration_data={
        "login": form.login.value,
        "password": form.password.value,
        "confirmpassword": form.confirmpassword.value,
        "email":form.email.value,
        "name":form.name.value,
    };
    const url = "../controllers/controllers.php";
    let response = await fetch(url, {
        method: 'POST',
        headers: {'Content-Type': 'application/json;charset=utf-8'},
        body: JSON.stringify({registration: registration_data})
    });
    if (response.ok) {
        let json = await response.json();
        validation(json);
    } else {alert("Ошибка HTTP: " + response.status);}
}

function exit(){
    if(document.title==="Выход"){
        setTimeout( 'location="index.php";', 1000 );
    }
}

async function dispatcher(e) {
    e.preventDefault()
    if (e.target.id === 'loginform') {
        await login(e.target);
    }
    else if(e.target.id === 'registrationform'){
        await registration(e.target);
    }
}
document.addEventListener("submit", dispatcher);
exit();
// document.addEventListener("click", exit)