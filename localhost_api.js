
const localAPIUrl = "http://127.0.0.1/sedmica5-php/api/users.php";
const usersLocal = [];

async function fetchUsersLocalAPI(){

    let response = await fetch(localAPIUrl);
    let responseJson = await response.json();

    console.log(responseJson);

}
