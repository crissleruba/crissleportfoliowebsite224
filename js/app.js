var config = {
    cUrl: 'https://api.countrystatecity.in/v1/countries',
    ckey: 'NHhvOEcyWk50N2Vna3VFTE00bFp3MjFKR0ZEOUhkZlg4RTk1MlJlaA=='
}



var countrySelect = document.querySelector('.country'),
    stateSelect = document.querySelector('.state'),
    citySelect = document.querySelector('.city')
    


function loadCountries() {

    let apiEndPoint = config.cUrl

    fetch(apiEndPoint, {headers: {"X-CSCAPI-KEY": config.ckey}})
    .then(Response => Response.json())
    .then(data => {
        // console.log(data);

        data.forEach(country => {
            const option = document.createElement('option')
            option.value = country.iso2
            option.textContent = country.name 
            countrySelect.appendChild(option)
        })
    })
    .catch(error => console.error('Error loading countries:', error))
    stateSelect.disabled = true
    citySelect.disabled = true
    stateSelect.style.pointerEvents = 'none'
    citySelect.style.pointerEvents = 'none'
}


function loadStates() {
    stateSelect.disabled = false
    citySelect.disabled = true
    stateSelect.style.pointerEvents = 'auto'
    citySelect.style.pointerEvents = 'none'

    const selectedCountryCode = countrySelect.value
    // console.log(selectedCountryCode);
    stateSelect.innerHTML = '<option value="">Select State</option>' // for clearing the existing states
    citySelect.innerHTML = '<option value="">Select City</option>' // Clear existing city options

    fetch(`${config.cUrl}/${selectedCountryCode}/states`, {headers: {"X-CSCAPI-KEY": config.ckey}})
    .then(response => response.json())
    .then(data => {
        // console.log(data);

        data.forEach(state => {
            const option = document.createElement('option')
            option.value = state.iso2
            option.textContent = state.name 
            stateSelect.appendChild(option)
        })
    })
    .catch(error => console.error('Error loading countries:', error))
}

function loadCities() {
    citySelect.disabled = false
    citySelect.style.pointerEvents = 'auto'

    const selectedCountryCode = countrySelect.value
    const selectedStateCode = stateSelect.value
    // console.log(selectedCountryCode, selectedStateCode);

    citySelect.innerHTML = '<option value="">Select City</option>' // Clear existing city options
    fetch(`${config.cUrl}/${selectedCountryCode}/states/${selectedStateCode}/cities`, {headers: {"X-CSCAPI-KEY": config.ckey}})
    .then(response => response.json())
    .then(data => {
        // console.log(data);

        data.forEach(city => {
            const option = document.createElement('option')
            option.value = city.iso2
            option.textContent = city.name 
            citySelect.appendChild(option)
        })
    })
}

function loadBarangays() {
    const selectedCountryCode = countrySelect.value;
    const selectedCityName = citySelect.value;
    const barangaySelect = document.querySelector('.barangay');

    // Show Barangay field only when Philippines is selected
    if (selectedCountryCode === 'PH') {
        barangaySelect.style.display = 'block';
    } else {
        barangaySelect.style.display = 'none';
        return; // Exit if country is not Philippines
    }

    // Fetch the barangays from the JSON file
    fetch('barangaysss.json') // Adjust the path according to your file location
        .then(response => response.json())
        .then(data => {
            // Convert keys to sentence case
            const newData = {};
            Object.keys(data).forEach(cityName => {
                const sentenceCaseCityName = cityName.toLowerCase().replace(/\b\w/g, char => char.toUpperCase());
                newData[sentenceCaseCityName] = data[cityName];
            });

            const cityData = newData[selectedCityName];
            if (!cityData) {
                console.error('No barangay data found for the selected city');
                return;
            }

            // Clear existing options
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

            // Populate barangay dropdown with barangays for the selected city
            Object.values(cityData).forEach(municipality => {
                Object.values(municipality.barangay_list).forEach(barangay => {
                    const option = document.createElement('option');
                    option.value = barangay;
                    option.textContent = barangay;
                    barangaySelect.appendChild(option);
                });
            });
            
        })
        .catch(error => console.error('Error loading barangays:', error));
}



// Call loadBarangays initially to hide/show based on the default country
window.onload = function() {
    loadCountries();
}

// Add an event listener to countrySelect to dynamically update Barangay field visibility
countrySelect.addEventListener('change', loadBarangays);
