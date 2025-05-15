// Aplicación principal
class App {
    constructor() {
        // ViewManager se instanciará una vez en DOMContentLoaded y manejará las pestañas.
        // App no necesita su propia instancia de ViewManager si ViewManager es global
        // o si su única tarea es configurar los listeners de pestañas.
        this.init();
    }

    // Inicializar la aplicación
    init() {
        // Mostrar fecha y hora actual (si el elemento existe en la página)
        const datetimeElement = document.getElementById('datetime');
        if (datetimeElement) {
            this.actualizarDateTime();
            setInterval(() => this.actualizarDateTime(), 1000);
        }
        
        // Inicializar eventos de formularios y otros elementos interactivos.
        this.initFormEvents();
    }

    // Actualizar fecha y hora
    actualizarDateTime() {
        const datetimeElement = document.getElementById('datetime');
        // Doble verificación por si el elemento desaparece dinámicamente, aunque es poco probable aquí.
        if (datetimeElement) { 
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            datetimeElement.textContent = now.toLocaleDateString('es-ES', options);
        }
    }

    
}



// Al final de tu app.js
document.addEventListener('DOMContentLoaded', () => {
    // Crea UNA SOLA instancia de ViewManager. Esta configurará los listeners de las pestañas.
    const viewManager = new ViewManager(); 
    
    // Crea la instancia de la aplicación principal.
    const app = new App(); 
});