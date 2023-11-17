let country = document.getElementById('country');
country.addEventListener('change', function(e){
    let value = e.target.value;

    fetch('http://127.0.0.1:8000/api/get/locations',{
            headers: {'Content-Type': 'application/json'},
            method: "POST",
            body: JSON.stringify({id: value})
        })
        .then(function(response){
            return response.json()
        })
        .then(function(data){

            let selects = document.querySelectorAll('.location');
            selects.forEach(select => {
                select.innerHTML = '';
                data.forEach(location => {
                    let option = document.createElement('option');
                    option.setAttribute('value', location['id']);
                    option.innerText = location['region'];
                    select.appendChild(option);
                })
            })
        })
        .catch(function(err){
            console.log('err', err)
        })
})
