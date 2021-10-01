

    let w1 = "hello";
    let w2 = "world";

    let sentence = w1 + " " + w2; // nadovezivanje stringova
    // console.log(sentence);

    let a = 25;
    let b = 50;

    let sum = a + b;

    // console.log(sum, typeof(sum));


    let name = "Marko";
    let age = 25;

    let message = "Hello, I am "+name+" and I am "+age+" years old...";
    let message2 = `Hello, I am ${name} and I am ${age} years old... `;

    // console.log(message.split(" ").join(" "));
    // console.log(message2[0]);

    const arr = [45, 50, 102, "Marko", false];

    if( arr[4] === 'false'){
        // console.log("DA");
    }else{
        // console.log("NE");
    }

    let pg = {
        name : "Podgorica",
        population : 150000,
        country : "Crna Gora"
    };

    let bd = {
        name : "Budva",
        population : 15000,
        country : "Crna Gora"
    };

    let kl = {
        name : "Kolasin",
        population : 5000,
        country : "Crna Gora"
    };

    let citiesArr = [pg, bd, kl];

    let cg = {
        name: "Crna Gora",
        population: 630000,
        cities: citiesArr
    };

    // JSON
    // JSON.stringify(cg);

    let fetchedFromDB = '{"name":"Crna Gora","population":630000,"cities":[{"name":"Podgorica","population":150000,"country":"Crna Gora"},{"name":"Budva","population":15000,"country":"Crna Gora"},{"name":"Kolasin","population":5000,"country":"Crna Gora"}]}';
    let country = JSON.parse(fetchedFromDB);

    // console.log(country.name);

    for(let i = 0; i < citiesArr.length; i++){
        let cityName = citiesArr[i].name;
        // console.log( cityName );
    }

    for(let city of citiesArr){
        let cityName = city.name;
        // console.log( cityName );
    }

    citiesArr.forEach( function(city, index){
        // console.log(index, city.name);
    });

    function sumNumbers(a, b){
        return a + b;
    }

    let namesArr = [];
    for(let i = 0; i < citiesArr.length; i++){
        let cityName = citiesArr[i].name;
        namesArr.push(cityName);
    }

    // console.log(namesArr);

    let namesFilteredArr = [];
    for(let i = 0; i < citiesArr.length; i++){
        let cityPopulation = citiesArr[i].population;
        if(cityPopulation >= 50000){
            let cityName = citiesArr[i].name;
            namesFilteredArr.push(cityName);
        }
    }

    // console.log(namesFilteredArr);

    let formatCityFn = function(city, index){
        return ` idx ${index}: ${city.name}, ${city.population} (${city.country}) `;
    };
    let bigCityFn = function(city){
        return city.population >= 50000;
    };
    let mediumCityFn = function(city){
        return city.population <= 50000;
    };

    let citiesMapped = citiesArr.map( formatCityFn );
    // console.log(citiesMapped);


    let citiesFilteredMapped = citiesArr.filter( mediumCityFn ).map( formatCityFn );

    console.log(citiesFilteredMapped);