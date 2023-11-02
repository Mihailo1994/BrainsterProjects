let editCategoryBtn = document.getElementById('edit-category-btn');
editCategoryBtn.addEventListener('click', function(e){
    e.preventDefault();
    document.getElementById('delete-category').classList.add('d-none');
    document.getElementById('edit-category').classList.replace('d-none', 'd-block');
    let selected = document.getElementById('select-category');
    let selectedValue = selected.value;
    let selectedText = selected.options[selected.selectedIndex].text

    let id = document.getElementById('category-id');
    id.value = selectedValue;
    let nameInput = document.getElementById('edit-category-name');
    nameInput.value = selectedText;
})


let insertAuthor = document.getElementById('insert-author-form');
let bio = document.getElementById('bio');
insertAuthor.addEventListener('submit', function(e){
    if (bio.value.length > 19) {
        return;
    } else {
        e.preventDefault();
        let p = document.createElement('p');
        p.classList.add('text-danger');
        p.innerText = 'Bio must be at least 20 characters!';
        p.setAttribute('id', 'bio-warning');
        bio.after(p);
    }
})


bio.addEventListener('focus', function(e){
    document.getElementById('bio-warning').classList.add('d-none');
})

let authorId
let selectedAuthor = document.getElementById('select-author');
selectedAuthor.addEventListener('change', function(e){
    authorId = (selectedAuthor.value)
})


editAuthorBtn = document.getElementById('edit-author-btn');
editAuthorBtn.addEventListener('click', function(e){
    e.preventDefault();
    document.getElementById('delete-author').classList.add('d-none');
    document.getElementById('edit-author').classList.replace('d-none', 'd-block');
    let selected = document.getElementById('select-author');
    let id = selected.value;
    
    fetch('PHP/get-author.php', {
			headers: {'Content-Type': 'application/json'},
			method: 'POST',
			body: JSON.stringify({id: id})
        })

    .then(function(response){
        return response.json()
    })

    .then(function(data){
        console.log(data);
        let name = data['name'];
        let surname = data['surname'];
        let bio = data['biography'];
        let id = data['id'];

        document.getElementById('edit-name').value = name;
        document.getElementById('edit-surname').value = surname;
        document.getElementById('edit-bio').value = bio;
        document.getElementById('edit-id').value = id;

    })

    .catch(function(err){
        console.log('Err', err)
    })

})


let showBtns = document.querySelectorAll('.show-comments-btn');
showBtns.forEach(element => {
    element.addEventListener('click', function(e){
        e.preventDefault();
        let btn = e.target;
        let nextElement = btn.nextElementSibling;
        if (nextElement.classList.contains('d-none')) {
            nextElement.classList.replace('d-none', 'd-block');
        } else if (nextElement.classList.contains('d-block')) {
            nextElement.classList.replace('d-block', 'd-none');
        }
    })
})

let commentSection = document.querySelectorAll('.comments');

let n = 1;
commentSection.forEach(element => {
    let filters = element.querySelectorAll('[name="comments-filter-'+ n +'"]')
    let comments = element.querySelectorAll('.comment');
    filters.forEach(element =>{
        element.addEventListener('click', function(e){
            comments.forEach(function(value){
                value.classList.add('d-none');
            })

            if(e.target.classList.contains('approved-comments')){
                comments.forEach(function(value){
                    if(value.classList.contains('approved')){
                        value.classList.replace('d-none', 'd-block');
                    }
                })
            } else if(e.target.classList.contains('pending-comments')){
                comments.forEach(function(value){
                    if(value.classList.contains('pending')){
                        value.classList.replace('d-none', 'd-block');
                    }
                })
            } else if(e.target.classList.contains('declined-comments')){
                comments.forEach(function(value){
                    if(value.classList.contains('declined')){
                        value.classList.replace('d-none', 'd-block')
                    }
                })
            } else if(e.target.classList.contains('all-comments')){
                comments.forEach(function(value){
                    value.classList.replace('d-none', 'd-block');
                })
            }
        })
    })
    n++;
})


let deletebtn = document.querySelectorAll('.delete-book');
deletebtn.forEach(element => {
    element.addEventListener('click', function(e){
        e.preventDefault();
        let id = e.target.nextElementSibling.value;
        console.log(id)

        swal({
            title: "Are you sure?",
            text: "All of the comments and notes will be deleted too!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {

                fetch('PHP/delete-book.php', {
                    headers: {'Content-Type': 'application/json'},
                    method: 'POST',
                    body: JSON.stringify({id: id})
                })
        
                .then(function(response){
                    return response.json();
                })
            
                .then(function(data){
                    swal("The book has been deleted", {
                        icon: "success",
                    })     
                    location.reload();      
                })
            
                .catch(function(err){
                    console.log('Err', err);
                })
            }
        })
    })
})


