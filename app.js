
// AJAX
var users = [];
const apiUrl = "https://reqres.in/api/users";

function fetchData(page = 1, delay = 0){
    let pageUrl = '?page='+page;
    let delayUrl = '&delay='+delay;

    fetch(apiUrl + pageUrl + delayUrl ).then( function(response){
        return response.json();
    }).then( (result) => {
        users = result.data;
        displayUsersData();
    }).catch( (error) => {
        console.error(error);
    });
}

function displayUsersData(){
    let usersHTML = [];
    users.forEach((user) => {
        usersHTML.push(`<tr> 
                            <td>${user.id}</td>
                            <td>${user.first_name}</td> 
                            <td>${user.last_name}</td> 
                            <td>${user.email}</td> 
                            <td><button class="btn btn-primary" onclick="showSingleUser(${user.id})">prikaži detalje</button></td> 
                        </tr>`);
    });
    document.getElementById('user_table_body').innerHTML = usersHTML.join('');
}

fetchData(); // metod koji cita podatake i prikazuje tabelu

function showSingleUser(user_id){
    let user = {};
    fetch(apiUrl + '/' + user_id ).then( function(response){
        return response.json();
    }).then( (result) => {
        user = result.data;
        displaySingleUserDiv(user);
    });
}

function displaySingleUserDiv(user){
    let userHTML = `
                    <img src="${user.avatar}">
                    <p>Ime: ${user.first_name}</p>
                    <p>Prezime: ${user.last_name}</p>
                    <p>E-mail: ${user.email}</p>

                    `;
    document.getElementById('single_user_details').innerHTML = userHTML;
}

// Promise producing code
var promise1 = new Promise(function(resolve, reject){

    if(true){
        setTimeout(function(){
            console.log("cekao sam 3 sekunde...");
            resolve();  // greska je bila ovdje, treba pozvati resolve metod nakon izvrsavanja operacija kako vi Promise znao kad da ,,javi da je zavrsio" 
        }, 3000);
    }else{
        reject();
    }
    // resolve(); - ovo nije mjesto za resolve jer ce se zbog ainhronosti prvo ovo desiti
});

// Promise consuming code
promise1.then((result) => {
    console.log("desio se promise...");
});