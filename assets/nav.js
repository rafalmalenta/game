import './styles/nav.css'

function toggleActive(element){
    element.classList.toggle('open')
}
let dropdowns = document.querySelectorAll('.dropdown');
dropdowns.forEach(dropdown=>{
    dropdown.addEventListener("click",(event )=>{
        console.log(event.currentTarget);
        event.stopPropagation();
        toggleActive(event.currentTarget);
    })
})
// dropdown.addEventListener("click",(event )=>{
//     toggleActive(event.currentTarget);
// })