function searchProduct(){

    const input = document.getElementById('filter').value.toUpperCase();

   
   
    const cardContainer = document.getElementById('card-lists');
    console.log(cardContainer);

    const cards = cardContainer.getElementsByClassName('lanches')
    console.log(lanches);
    
    for(let i = 0; i < cards.length; i++){
        let title = cards[i].querySelector(".product__title"); 
        console.log(title);

        if(title.innerText.toUpperCase().indexOf(input) > -1) {
            cards[i].style.display = "";
        }else {
            cards[i].style.display = "none";  
        
        }
    }
} 