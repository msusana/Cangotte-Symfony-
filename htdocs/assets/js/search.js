
document.addEventListener('DOMContentLoaded',()=>{
    fetch('http://cagnotpote.loc/campagne/search', {
        method: 'GET',
        headers: {
         
        },
        redirect: 'follow',
    })
    .then((response)=>{
        return response.json()
    }).then((results)=>{
        search(results)        
    })
})
let campagnesIndex = document.querySelector("#campagnesIndex")  
let divCagnotte = document.querySelector("#cagnotte-list");
let inputSearch = document.querySelector(".search-cagnotte");

function search(results){

    let search = document.querySelector(".search-cagnotte");
   
    search.addEventListener("input", (event)=>{
        searchCagnotte = event.target.value
        
        divCagnotte.innerHTML = ''

        if(searchCagnotte != ""){
            
        results.forEach(result => {
            
            if (result.nameCampagne.includes(searchCagnotte) ) {
                resize()
                campagnesIndex.style.position = 'relative';
                campagnesIndex.style.zIndex= -1000;
                document.getElementById('overlayModalSearch').style.opacity= '1';
                document.getElementById('modalSearch').style.opacity= '1';
                

            divCagnotte.innerHTML += `<a href="http://cagnotpote.loc/campagne/${result.id}">
                <div class="col m12 l6 xl4">
                    <div class="card center">
                        <div class="card-content" id='cardSearch'>
                            <span class="card-title teal-text">${result.nameCampagne}</span>
                            <span ><p class="teal-text">${result.name}</p></span>
                        </div>
                    </div>
                </div>
            </a>`
            }
        });
    }else{
        divCagnotte.innerHTML = ""
    }
    });

}
const buttonCloseSearch = document.getElementById('closeBtnModalSearch')
  
  buttonCloseSearch.addEventListener('click', ()=>{
    document.getElementById('overlayModalSearch').style.opacity= 0;
    document.getElementById('modalSearch').style.opacity= 0;
     campagnesIndex.style.position = 'relative';
    campagnesIndex.style.zIndex= 1000;
    divCagnotte.innerHTML = ""
    inputSearch.value =""
  });

  function resize() {
    $(window).resize(function() {
        sH = $(window).height();
        var porcentage = 25/100*sH;
        sH = sH - porcentage;
        console.log(sH);
        $('.modalSearch').css('height', sH + 'px');
    });
}

