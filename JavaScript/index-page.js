
let btnFilters = document.querySelectorAll('.btn-check');

btnFilters.forEach(element => {
    element.addEventListener('change', check)
})

function check() {
    let num = 0;

    btnFilters.forEach(element => {
        if (element.checked) {
            num++;
        }
    })

    if (num > 0) {
        let books = document.querySelectorAll('.book');
        books.forEach(function(book) {
            book.classList.add('d-none');
        })
        btnFilters.forEach(element => {
            if (element.checked) {
                document.querySelectorAll('.' + element.value).forEach(element =>{
                    element.classList.replace('d-none', 'd-flex');
                })
            }
        })
    } else {
        let books = document.querySelectorAll('.book');
        books.forEach(function(book) {
            if (book.classList.contains('d-none')) {
                book.classList.replace('d-none', 'd-flex');
            }
        })
    }
}

