getQuote();

setInterval(getQuote, 15000);

function getQuote() {
    fetch('http://api.quotable.io/random')
    .then(function(response){
        return response.json()
    })
    
    .then(function(data){
        let quote = data.content;
        let splitQuote = quote.split("");
        document.getElementById('footer-text').innerHTML = '"';
        splitQuote.forEach(element => {
            document.getElementById('footer-text').innerHTML += '<span class="d-none letter">' + element + '</span>';
        });
        document.getElementById('footer-text').innerHTML += '"';

        let index = 0;

        let animate = setInterval(function(){
            if (index < splitQuote.length) {
                document.querySelectorAll('.letter')[index].classList.replace('d-none', 'd-inline');
                index++;
            } else {
                clearInterval(animate);
            }
        }, 35);
    })
    
    .catch(function(err){
        console.log('err', err)
    })

}
