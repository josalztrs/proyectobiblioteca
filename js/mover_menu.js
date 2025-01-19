document.getElementById("btn-open").addEventListener("click", open_close_menu);

let menu_lateral = document.getElementById("menu-lateral");
let btn_open = document.getElementById("btn-open");
let body = document.getElementById("body");

function open_close_menu(){

    body.classList.toggle("mover-body");
    menu_lateral.classList.toggle("mover-menu-lateral");

}

// responsive de la pagina

    if(window.innerWidth < 760){

        body.classList.add("mover-body");
        menu_lateral.classList.add("mover-menu-lateral");
    }

    window.addEventListener("resize", function(){
        
        if(window.innerWidth > 760){
           
            body.classList.remove("mover-body");
            menu_lateral.classList.remove("mover-menu-lateral");
        }
    
        if(window.innerWidth < 760){
           
            body.classList.add("mover-body");
            menu_lateral.classList.add("mover-menu-lateral");
        }
    });

    // funcion para marcar el estado actual de la pagin (en donde se encuentra)
    function highlightMenu(selected) {
        // Remove 'active' class from all menu items
            const menuItems = document.querySelectorAll('.menu-item');
                menuItems.forEach(item => {
                item.classList.remove('active');
            });
            // Add 'active' class to the selected menu item
            selected.classList.add('active');
        }

        document.getElementById('btn-open').addEventListener('click', function() {
            const namePagIcon = document.querySelector('.name__pag i');
            namePagIcon.classList.add('rotate');
    
            // Remover la clase después de la animación para que se pueda volver a aplicar
            setTimeout(() => {
                namePagIcon.classList.remove('rotate');
            }, 500); // 500ms es el mismo tiempo que la animación
        });