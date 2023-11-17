let editBtn = document.getElementById('update-country-btn');
editBtn.addEventListener('click', function(e){
    e.preventDefault();
    let select = document.getElementById('select-update-country');
    let id = select.value;
    let text = select.options[select.selectedIndex].text;

    document.getElementById('select-update').classList.add('d-none');
    document.getElementById('update-country').classList.replace('d-none', 'd-block');
    let inputId = document.getElementById('country-id');
    inputId.setAttribute('value', id);
    let inputName = document.getElementById('country-name-input');
    inputName.value = text;

    let cancelBtn = document.getElementById('cancel-country-btn');
    cancelBtn.addEventListener('click', function(e){
        e.preventDefault();
        document.getElementById('select-update').classList.replace('d-none', 'd-block');
        document.getElementById('update-country').classList.replace('d-block', 'd-none');
    })
})

let search = document.getElementById('search-input');
search.addEventListener('keyup', function(e){
    let searchText = e.target.value.toUpperCase();
    let countries = document.getElementsByClassName('country');
    let regions = document.getElementsByClassName('region');
    let n = countries.length;
    for(let i = 0; i < n; i++){
        if(countries[i].textContent.toUpperCase().indexOf(searchText) > -1 || regions[i].textContent.toUpperCase().indexOf(searchText) > -1){
            countries[i].parentElement.style.display = "";
            regions[i].parentElement.style.display = "";
        } else {
            countries[i].parentElement.style.display = "none";
            regions[i].parentElement.style.display = "none";
        }
    }
})


