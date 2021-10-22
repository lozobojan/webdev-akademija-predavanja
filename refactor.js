
var users = [];
const apiUrl = "https://reqres.in/api/users";

async function fetchUsers(page = 1, delay = 0){
    
    let pageUrl = '?page='+page;
    let delayUrl = '&delay='+delay;

    let response = await fetch( apiUrl + pageUrl + delayUrl );
    let responseJson = await response.json();

    users = responseJson.data;
    displayUsers();
}

async function fetchUser(user_id){

    let response = await fetch(apiUrl + '/' + user_id);
    let responseJson = await response.json();

    let user = responseJson.data;

    displaySingleUser(user);
}

function displayUsers(){
    let usersHTML = [];
    users.forEach((user) => {
        usersHTML.push(`<tr> 
                            <td>${user.id}</td>
                            <td>${user.first_name}</td> 
                            <td>${user.last_name}</td> 
                            <td>${user.email}</td> 
                            <td><button class="btn btn-primary" onclick="fetchUser(${user.id})">prikaži detalje</button></td> 
                        </tr>`);
    });
    document.getElementById('user_table_body').innerHTML = usersHTML.join('');
}

function displaySingleUser(user){
    let userHTML = `
                    <img src="${user.avatar}">
                    <p>Ime: ${user.first_name}</p>
                    <p>Prezime: ${user.last_name}</p>
                    <p>E-mail: ${user.email}</p>

                    `;
    document.getElementById('single_user_details').innerHTML = userHTML;
}

fetchUsers();