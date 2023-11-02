let input =  document.querySelectorAll('input');

input.forEach(function(value, key){
    value.addEventListener('click', function(){
    let warning = document.querySelector('.text-danger');
    warning.classList.add('d-none');
    })
})