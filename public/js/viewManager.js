// public/js/viewManager.js
class ViewManager {
    constructor() {
        // Inicializar eventos específicos de la página (como los listeners de las pestañas).
        this._initPageSpecificEvents();
        // Activar la pestaña inicial que esté marcada en el HTML o la primera por defecto.
        this._activateInitialTab();
    }

    _initPageSpecificEvents() {
        // Selecciona todos los botones de pestaña en el documento.
        document.querySelectorAll('.tab-btn').forEach(btn => {
            // Añade un event listener para el evento 'click' a cada botón.
            btn.addEventListener('click', (e) => {
                const clickedButton = e.currentTarget; // El botón que fue clickeado.
                const tabId = clickedButton.getAttribute('data-tab'); // El valor de 'data-tab' del botón.
                // Encuentra el contenedor '.view' más cercano que envuelve este grupo de pestañas.
                const viewContainer = clickedButton.closest('.view');

                // Si no se encuentra un contenedor, muestra una advertencia y no hace nada.
                if (!viewContainer) {
                    console.warn('Contenedor .view no encontrado para el botón de pestaña.');
                    return;
                }

                // Selecciona todos los botones de pestaña y paneles de contenido dentro del mismo contenedor.
                const buttonsInGroup = viewContainer.querySelectorAll('.tab-btn');
                const contentPanesInGroup = viewContainer.querySelectorAll('.tab-content');

                // Itera sobre cada botón en el grupo.
                buttonsInGroup.forEach(b => {
                    const isClicked = (b === clickedButton); // Verifica si este botón 'b' es el que se clickeó.

                    // Clases base (comunes a todos los botones, no se tocan aquí):
                    // tab-btn py-2 px-4 border-b-2 font-semibold

                    // Clases para el estado ACTIVO:
                    // active, border-green-500, text-green-500
                    // (y se quitan las de inactivo/hover si el diseño lo requiere)

                    // Clases para el estado INACTIVO:
                    // border-transparent, text-gray-500, hover:text-green-500, hover:border-gray-300
                    // (y se quitan las de activo)

                    if (isClicked) {
                        // Si es el botón clickeado, aplicar estilos de ACTIVO.
                        b.classList.add('active', 'border-green-500', 'text-green-500');
                        // Quitar estilos de INACTIVO y los de hover específicos de inactivo.
                        b.classList.remove('border-transparent', 'text-gray-500', 'hover:text-green-500', 'hover:border-gray-300');
                    } else {
                        // Si NO es el botón clickeado, aplicar estilos de INACTIVO.
                        b.classList.remove('active', 'border-green-500', 'text-green-500');
                        // Añadir estilos de INACTIVO y los de hover para inactivos.
                        b.classList.add('border-transparent', 'text-gray-500', 'hover:text-green-500', 'hover:border-gray-300');
                    }
                });

                // Itera sobre cada panel de contenido en el grupo.
                contentPanesInGroup.forEach(pane => {
                    // Comprueba si el ID del panel coincide con el 'data-tab' del botón clickeado.
                    if (pane.id === tabId + '-tab') {
                        pane.classList.add('active'); // Muestra el panel (CSS: .tab-content.active { display: block; })
                    } else {
                        pane.classList.remove('active'); // Oculta el panel (CSS: .tab-content { display: none; })
                    }
                });
            });
        });
    }

    _activateInitialTab() {
        // Itera sobre cada contenedor '.view' en la página (normalmente uno por conjunto de pestañas).
        document.querySelectorAll('.view').forEach(viewContainer => {
            // Intenta encontrar un botón que ya esté marcado como 'active' en el HTML.
            let initialTabBtn = viewContainer.querySelector('.tab-btn.active');

            if (!initialTabBtn) {
                // Si ningún botón está marcado como 'active', selecciona el primer botón de pestaña que encuentre.
                initialTabBtn = viewContainer.querySelector('.tab-btn');
            }

            if (initialTabBtn) {
                // Si se encuentra un botón inicial (ya sea pre-marcado o el primero),
                // simula un clic en él. Esto ejecutará el event listener definido en _initPageSpecificEvents,
                // asegurando que los estilos se apliquen consistentemente y el contenido correcto se muestre.
                initialTabBtn.click();
                console.log(`Pestaña inicial activada: ${initialTabBtn.getAttribute('data-tab')}`);
            } else {
                // Si no se encuentra ningún botón de pestaña en el contenedor.
                console.warn('No se encontró ningún botón de pestaña para activar inicialmente en un .view');
            }
        });
    }
}

// Asegúrate de que el DOM esté completamente cargado antes de instanciar ViewManager y App.
// Esto ya lo tienes en tu app.js, así que esta parte es solo para recordar el contexto.
/*
document.addEventListener('DOMContentLoaded', () => {
    const viewManager = new ViewManager(); 
    const app = new App(); 
});
*/
