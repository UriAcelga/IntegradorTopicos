// Gestor de Vistas (Adaptado para múltiples páginas)
class ViewManager {
    constructor() {
        // No necesitamos inicializar las vistas principales aquí,
        // ya que cada página es su propia vista.

        // Inicializar eventos que son relevantes DENTRO de cada página.
        this._initPageSpecificEvents();

        // Añadir inicialización explícita de la pestaña activa al cargar
        this._activateInitialTab();
    }

    _initPageSpecificEvents() {
        // ... (tu código actual de listeners para botones de pestaña) ...
         document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const tabId = e.target.getAttribute('data-tab');
                const viewContainer = e.target.closest('.view');

                if (!viewContainer) return;

                viewContainer.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                viewContainer.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                e.target.classList.add('active');
                const tabContentElement = viewContainer.querySelector('#' + tabId + '-tab');
                if (tabContentElement) {
                    tabContentElement.classList.add('active');
                } else {
                    console.warn('No se encontró el contenido de la pestaña:', tabId + '-tab');
                }
            });
        });

        // ... (resto de tus listeners, para selects de modificación, etc.) ...

        // No es necesario añadir listeners de navegación aquí si se usa href/onclick
    }

    // Método para asegurar que la pestaña marcada como 'active' en el HTML se muestre
    _activateInitialTab() {
        // Buscar todos los contenedores de vista en la página (debería haber 1 por página)
        document.querySelectorAll('.view').forEach(viewContainer => {
            // Buscar el botón de pestaña que está marcado como activo inicialmente en este contenedor de vista
            const initialTabBtn = viewContainer.querySelector('.tab-btn.active');

            if (initialTabBtn) {
                const tabId = initialTabBtn.getAttribute('data-tab');
                const tabContentElement = viewContainer.querySelector('#' + tabId + '-tab');

                if (tabContentElement) {
                    // Asegurarse de que el contenido correspondiente también tenga la clase active
                    // (Aunque ya la tenga en el HTML, esto lo refuerza y es claro)
                    tabContentElement.classList.add('active');
                    // Opcional: Si el CSS falla, podrías intentar setting display directamente
                    // tabContentElement.style.display = 'block'; // Esto es una solución temporal si el CSS está mal

                    console.log(`Inicializando con pestaña activa: ${tabId}`);
                } else {
                     console.warn(`Botón de pestaña activo encontrado (${tabId}), pero no se encontró el contenido con ID: ${tabId}-tab`);
                }
             } else {
                 // Si no hay ningún botón con 'active' en este .view, podrías decidir
                 // qué hacer, por ejemplo, activar el primer botón y su contenido
                 // o simplemente no hacer nada (basándose en que el HTML define el estado inicial).
                 // Por ahora, simplemente registramos si no hay activo inicial.
                 console.log('No se encontró botón de pestaña marcado como activo inicialmente en un contenedor .view');
             }
        });
    }
}
