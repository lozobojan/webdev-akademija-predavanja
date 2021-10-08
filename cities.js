
var cities = [
    {
        name: "Barselona",
        countryName: "Spanija",
        population: 5000000,
        image: "barcelona.jpg"
    },
    {
        name: "Moskva",
        countryName: "Rusija",
        population: 10000000,
        image: "moscow.jpg"
    },
    {
        name: "Madrid",
        countryName: "Spanija",
        population: 7000000,
        image: "madrid.jpg"
    }
];

function displayCitiesAsTable(citiesToShow = null){

    if(citiesToShow == null) citiesToShow = cities;

    let tableContents = "";
    citiesToShow.forEach( (city) => {
        
        tableContents += `<tr>
                            <td>${city.name}</td>
                            <td>${city.countryName}</td>
                            <td>${city.population}</td>
                            <td></td>
                        </tr>`;

    });

    document.getElementById("cities_table_body").innerHTML = tableContents;

}

function displayCitiesAsCards(){

    let htmlContents = "";
    cities.forEach((city) => {

        htmlContents += `
                        <div class="col-4">
                            <div class="card">
                                <img src="./images/${city.image}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">${city.name}</h5>
                                    <p class="card-text">Broj stanovnika: ${city.population}</p>
                                    <p class="card-text">Država: ${city.countryName}</p>
                                </div>
                            </div>
                        </div>
        `;

    });

    document.getElementById("cities_wrapper").innerHTML = htmlContents;

}

function getUserInputs(){

    let name = document.getElementById("name_input").value;
    let countryName = document.getElementById("countryName_input").value;
    let population = document.getElementById("population_input").value;

    // if(!validate(username, password)) return false;

    return {
        name: name,
        countryName: countryName,
        population: population,
        image: ""
    }
}

function clearInputs(){
    /* let inputs = document.getElementsByClassName("new-city-input");
    for(let input of inputs){
        input.value = '';
    } */

    // ako koristimo formu
    document.getElementById('new_city_form').reset();
}

function addNewCity(){
    let newCity = getUserInputs();
    cities.push(newCity);
    displayCitiesAsTable();
    clearInputs();
}

function filterCities(){
    let term = document.getElementById('term_input').value.toLowerCase();
    let searchRes = [];

    /* cities.forEach( (city) => {
        if(city.name.toLowerCase().includes(term) || city.countryName.includes(term)) searchRes.push(city);
    }); */

    searchRes = cities.filter( (city) => city.name.toLowerCase().includes(term) || city.countryName.includes(term) );

    displayCitiesAsTable(searchRes);
}

// document.getElementById('add_city_button').addEventListener('click', () => addNewCity() );

// ako koristimo formu
document.getElementById('new_city_form').addEventListener('submit', (e) => {
    e.preventDefault();
    addNewCity();
});


document.getElementById('search_form').addEventListener('submit', (e) => {
    e.preventDefault();
    filterCities();
});

displayCitiesAsTable();