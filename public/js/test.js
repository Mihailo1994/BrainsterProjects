// let generateBtn = document.getElementById('generate-btn');
// generateBtn.addEventListener('click', function(e){
//     e.preventDefault();
//     console.log(e.target);
//     let terminsFrom = document.getElementById('termins_from');
//     let terminsNumber = document.getElementById('termins_number');
//     let nOfNights = document.getElementById('number_of_nights');
//     if (terminsFrom.value == '') {
//         terminsFrom.classList.add('border', 'border-danger');
//         terminsFrom.addEventListener('focus', function(e){
//             e.target.classList.remove('border', 'border-danger');
//         })
//     } else if (terminsNumber.value == '') {
//         terminsNumber.classList.add('border', 'border-danger');
//         terminsNumber.addEventListener('focus', function(e){
//             e.target.classList.remove('border', 'border-danger');
//         })
//     } else if (nOfNights.value == '') {
//         nOfNights.classList.add('border', 'border-danger');
//         nOfNights.addEventListener('focus', function(e){
//             e.target.classList.remove('border', 'border-danger');
//         })
//     } else {
//         let startDate = new Date(terminsFrom.value);
//         console.log(startDate.addDays(6));
//         console.log(startDate)

//     }

// })







// let addBtn = document.getElementById('add-termin');
// addBtn.addEventListener('click',function(e){
//     e.preventDefault();
//     let rows = document.getElementsByClassName('termins');
//     let i = rows.length;
//     let j = i+1;
//     let div = document.createElement('div');
//     div.setAttribute('id', 'row-'+j+'');
//     div.classList.add('row', 'termins', 'mb-3');
//     div.innerHTML = `<div class="col">
//                         <label>Термин од</label>
//                         <input type="date" class="form-control" name="termin_from_${j}" required>
//                     </div>
//                     <div class="col">
//                         <label>Термин до</label>
//                         <input type="date" class="form-control" name="termin_until_${j}" required>
//                     </div>
//                     <div class="col">
//                         <label>Цена од ноќ</label>
//                         <input type="number" name="price_per_night_${j}" class="form-control" required>
//                     </div>
//                     <div class="col">
//                         <label>Забелешка</label>
//                         <input type="text" name="note_${j}" class="form-control">
//                     </div>`;
//     let terminSection = document.getElementById('termin-section');
//     terminSection.appendChild(div);
//     if(i === 1){
//         let button = document.createElement('button');
//         button.innerText = 'Одстрани ред';
//         button.classList.add('btn', 'btn-warning');
//         button.setAttribute('id', 'delete-termin');
//         terminSection.parentNode.appendChild(button);
//         button.addEventListener('click', function(e){
//             e.preventDefault();
//             let rows = document.getElementsByClassName('termins');
//             let i = rows.length;
//             let lastRow = rows[i-1];
//             lastRow.remove();
//             if(i === 2){
//                 e.target.remove();
//             }
//         })
//     }
// })

// let saveBtn = document.getElementById('save-btn');
// saveBtn.addEventListener('click', function(e){
//     e.preventDefault();
//     let rows = document.getElementsByClassName('termins');
//     let n = rows.length;
//     let accommodation = document.getElementById('accommodation');
//     if (accommodation.value == 0){
//         console.log('tuka e')
//     } else {

//     }

// })








// let editBtn = document.getElementById('edit-btn');
// let select = document.getElementById('location');
// select.addEventListener('change', function(e){
//     let id = e.target.value;
//     editBtn.addEventListener('click', function(e){
//         e.preventDefault();
//         let text = select.options[select.selectedIndex].text;
//         let strings = text.split(",");
//         let country = strings[0].trim();
//         let city = strings[1].trim();
//         console.log();
//         let editForm = `<div>
//                         <form action="{{route('location.update')}}" method="POST">
//                         @csrf<input type="text" hidden value="${id}" name="id">
//                         <div class="row">
//                         <div class="col-6">
//                         <label for="country">Држава</label>
//                         <input type="text" name="country" value="${country}">
//                         </div>
//                         <div class="col-6">
//                         <label for="city">Град</label>
//                         <input type="text" name="city" value=${city}>
//                         </div>
//                         </div>
//                         <button class="btn btn-primary">Зачувај</button>
//                         </form>
//                         </div>`;
//         let editSection = document.getElementById('edit-section')
//         editSection.innerHTML = editForm;
//     })
// })




// let selectCountry = document.getElementById('country');


// selectCountry.addEventListener('change', function(e){
//     let id = e.target.value;
//     fetch('http://127.0.0.1:8000/api/get/cities/'+id,{
//         headers: {'Content-Type': 'application/json'},
//         method: 'GET',
//     })
//     .then(function(response){
//         return response.json()
//     })
//     .then(function(data){
//         console.log(data)
//         let cities = data;
//         let select = document.getElementById('city');
//         cities.forEach(element => {
//             let option = document.createElement('option');
//             option.value = element.id
//             console.log(element)
//         });


//     })
//     .catch(function(err){
//         console.log('err', err)
//     })

// })





// fetch('http://127.0.0.1:8000/get', {
//     headers: {'Content-Type': 'application/json',
//               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
//     method: 'POST',
//     body: JSON.stringify({id: '1'})
// })

// .then(function(response){
// return response.json()
// })

// .then(function(data){
// console.log(data);
// })

// .catch(function(err){
// console.log('Err', err)
// })
