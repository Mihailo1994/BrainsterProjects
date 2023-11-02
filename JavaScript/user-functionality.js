let msg = document.getElementById('msg');

if (msg != null) {
    setTimeout(function(){
        msg.classList.add('d-none')
    }, 3000);
}
        
let notes = document.getElementById('notes');

if (notes != null) {
    getNotes();

    let insertBtn = document.getElementById('insert-note-btn');

    insertBtn.addEventListener('click', insertNote)

}

function getNotes() {
    let userId = document.querySelector('[name="userId"]').value;
    let bookId = document.querySelector('[name="bookId"]').value;

    fetch('PHP/get-notes.php', {
        headers: {'Content-Type': 'application/json'},
        method: 'POST',
        body: JSON.stringify({bookId: bookId, userId: userId})
    })

    .then(function(response){
        return response.json()
    })

    .then(function(data){
        renderData(data)

    })

    .catch(function(err){
        console.log('Err', err)
    })
}

function deleteNote(noteId) {
    let userId = document.querySelector('[name="userId"]').value;
    let bookId = document.querySelector('[name="bookId"]').value;

    fetch('PHP/delete-note.php', {
        headers: {'Content-Type': 'application/json'},
        method: 'POST',
        body: JSON.stringify({bookId: bookId, userId: userId, noteId: noteId })
    })

    .then(function(response){
        return response.json()
    })

    .then(function(data){
        renderData(data);

    })

    .catch(function(err){
        console.log('Err', err)
    })
}

function insertNote() {
        let note = document.querySelector('[name="note"]').value;
        let userId = document.querySelector('[name="userId"]').value;
        let bookId = document.querySelector('[name="bookId"]').value;

        if (note.length < 1) {
            let textArea = document.querySelector('[name="edit-note"]');
            textArea.classList.add('border', 'border-danger', 'border-3');
            textArea.addEventListener('focus', function(e){
                e.target.classList.remove('border', 'border-danger', 'border-3');
            })
        } else {
            fetch('PHP/insert-note.php', {
            headers: {'Content-Type': 'application/json'},
            method: 'POST',
            body: JSON.stringify({bookId: bookId, userId: userId, note: note})
            })

            .then(function(response){
                return response.json()
            })

            .then(function(data){
                document.querySelector('[name="note"]').value = '';
                renderData(data)

            })

            .catch(function(err){
                console.log('Err', err)
            })
        }
}

function renderData(data) {
        let div = document.getElementById('notes');
        div.innerHTML = '';
        data.forEach(function(value) {
            let divNote = document.createElement('div');
            divNote.classList.add('bg-danger-subtle', 'p-2', 'my-3', 'rounded', 'd-flex', 'justify-content-between');
            let p = document.createElement('p');
            p.innerText = value['note'];
            let divBtns = document.createElement('div');
            let input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('value', value['id']);
            input.setAttribute('name', 'noteId');
            let btnEdit = document.createElement('button');
            btnEdit.classList.add('btn', 'btn-warning', 'm-1');
            btnEdit.innerText = 'Edit';
            let btnDelete = document.createElement('button');
            btnDelete.classList.add('btn', 'btn-danger', 'm-1');
            btnDelete.innerText = 'Delete'
            div.appendChild(divNote);
            divNote.appendChild(p);
            divNote.appendChild(divBtns);
            divBtns.appendChild(input);
            divBtns.appendChild(btnEdit);
            divBtns.appendChild(btnDelete);

            btnDelete.addEventListener('click', function(e){
                e.preventDefault();
                let parent = e.target.parentElement;
                let noteId = parent.querySelector('input').value;
                deleteNote(noteId);
            })

            btnEdit.addEventListener('click', function(e){
                e.preventDefault();
                let parent = e.target.parentElement;
                let noteId = parent.querySelector('input').value;
                let parent2 = parent.parentElement;
                let oldNote = parent2.querySelector('p').innerText;
                console.log(noteId);
                parent2.innerHTML = `<textarea name="edit-note" cols="30" rows="2" class="form-control" required>${oldNote}</textarea>
                <button class="btn btn-warning mt-2 ms-3" id="edit-note-btn" type="submit">Edit</button>`;
                let editNoteBtn = document.getElementById('edit-note-btn');
                console.log(editNoteBtn);
                editNoteBtn.addEventListener('click', function(e){
                    let userId = document.querySelector('[name="userId"]').value;
                    let bookId = document.querySelector('[name="bookId"]').value;
                    let note = document.querySelector('[name="edit-note"]').value;

                    fetch('PHP/edit-note.php', {
                        headers: {'Content-Type': 'application/json'},
                        method: 'POST',
                        body: JSON.stringify({bookId: bookId, userId: userId, noteId: noteId, note: note})
                    })

                    .then(function(response){
                        return response.json()
                    })

                    .then(function(data){
                        renderData(data);

                    })

                    .catch(function(err){
                        console.log('Err', err)
                    })
                })
                
            })
        });
}



