let compradores = [];
const BASE_URL = ("http://localhost/web2/tpParte3/api/compradores")
let form = document.querySelector("#task-form")
form.addEventListener('submit',post);
async function getAll(){
    try {
        const response  = await fetch(BASE_URL);
        if(!response.ok){
            throw new Error("error al llamar compradores    ")
        }


        compradores = await response.json();
        console.log(typeof compradores);
         showTasks();
    } catch (error) {
        console.log(error);
    }
   
  
}
getAll();


function showTasks() {
    let ul = document.querySelector("#task-list");
    ul.innerHTML = "";
    for (const comprador of compradores) {
        let html = `
            <li 
                <span> <b>${comprador.nombre}</b> <b>${comprador.apellido}</b>  <b>${comprador.nombre_producto}</b> <b>${comprador.tipo_de_compra}</b> </span>
                
            </li>
        `;

        ul.innerHTML += html;
    }
}



async function post(e) {
    e.preventDefault();

    let data = new FormData(form);
    let comprador = {
        nombre: data.get('nombre'),
        apellido: data.get('apellido'),
        nombre_producto: data.get('nombre_producto'),
        tipoDeCompra: data.get('tipo_de_compra')
    };

    try {
        let response = await fetch(BASE_URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json' },

            body: JSON.stringify(comprador)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nTask = await response.json();
        console.log(nTask);
        compradores.push(nTask);
        showTasks();

        //form.reset();
    } catch(e) {
        console.log(e);
    }
}



    
    
    
    

