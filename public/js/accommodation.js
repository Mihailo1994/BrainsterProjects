let btnEdit = document.querySelectorAll('.edit-btn');
btnEdit.forEach( element => {
    element.addEventListener('click', function(e){
        e.preventDefault();
        let td= e.target.parentElement;
        let tr = td.parentElement;
        console.log(tr);
        tr.classList.add('d-none');
        tr.nextElementSibling.classList.remove('d-none');
        let cancelBtn = tr.nextElementSibling.querySelector('.cancel-edit');
        cancelBtn.addEventListener('click', function(e){
            e.preventDefault();
            tr.classList.remove('d-none');
            tr.nextElementSibling.classList.add('d-none');
        })

    })
})


let addBtn = document.querySelectorAll('.add-note');
addBtn.forEach(element => {
    element.addEventListener('click', function(e){
        e.preventDefault();
        let btn = e.target;
        e.target.classList.add('d-none');
        td = e.target.parentElement;
        tr = td.parentElement;
        let noteTd = tr.querySelector('.note');
        let id = noteTd.id;
        let arr = id.split('-');
        let terminId = arr[1];
        let oldNote = noteTd.innerText;
        noteTd.innerHTML = '<input class="form-control my-2" value="'+oldNote+'"><button class="btn btn-primary save-btn btn-sm">Зачувај</button><button class="btn btn-warning btn-sm cancel-btn">Откажи</button>';
        let saveBtn = noteTd.querySelector('.save-btn');
        let cancelBtn = noteTd.querySelector('.cancel-btn');
        cancelBtn.addEventListener('click', function(e){
            e.preventDefault();
            noteTd.innerHTML = oldNote;
            btn.classList.remove('d-none');
        })

        saveBtn.addEventListener('click', function(e){
            e.preventDefault();
            let newNote = noteTd.querySelector('input').value;

            fetch('http://127.0.0.1:8000/api/edit/note',{
                headers: {'Content-Type': 'application/json'},
                method: "POST",
                body: JSON.stringify({newNote, terminId})
            })
            .then(function(response){
                return response.json()
            })
            .then(function(data){
                console.log(data);
                noteTd.innerHTML = newNote;
                btn.classList.remove('d-none');

            })
            .catch(function(err){
                console.log('err', err)
            })
        })
    })
});



let deleteBtns = document.querySelectorAll('.delete-img-btns');
deleteBtns.forEach(element => {
    element.addEventListener('click', function(e){
        e.preventDefault();
        let idVal = e.target.id
        let arr = idVal.split("-");
        let id = arr[0];
        let div = e.target.parentElement;

        fetch('http://127.0.0.1:8000/api/image/delete',{
            headers: {'Content-Type': 'application/json'},
            method: "POST",
            body: JSON.stringify({id})
        })
        .then(function(response){
            return response.json()
        })
        .then(function(data){
            console.log(data)
            div.remove();
        })
        .catch(function(err){
            console.log('err', err)
        })


    })
})


let filter = document.getElementById('filter');
filter.addEventListener('change', function(e){
    let value = e.target.value;
    let all = document.querySelectorAll('.country');

    if(value == "all"){
        all.forEach(element => {
            element.classList.remove('d-none');
        })
    } else {
        all.forEach(element => {
            element.classList.add('d-none');
        })

        let countries = document.querySelectorAll('.'+value+'');
        countries.forEach(element => {
            element.classList.remove('d-none');
        })
    }

})
