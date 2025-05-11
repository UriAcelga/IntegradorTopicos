// Aplicación principal
class App {
    constructor() {
        // ViewManager ahora maneja la lógica interna de la página actual (pestañas, visibilidad de campos)
        this.viewManager = new ViewManager(); 
        
        // Inicializar la aplicación
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
        
        // La llamada a this.viewManager.showWelcomeScreen() se elimina,
        // ya que la página de inicio (inicio.html) se carga directamente.
        
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
                minute: '2-digit',
                second: '2-digit'
            };
            datetimeElement.textContent = now.toLocaleDateString('es-ES', options);
        }
    }

    // Inicializar eventos de formularios y otros elementos interactivos
    initFormEvents() {
        // --- Formularios de Alta (altas.html) ---
        document.getElementById('mascota-amo-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Formulario de alta mascota-amo enviado');
            alert('Alta Mascota-Amo: Implementa tu lógica aquí.');
        });
        
        document.getElementById('veterinario-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Formulario de alta veterinario enviado');
            alert('Alta Veterinario: Implementa tu lógica aquí.');
        });

        document.getElementById('mascota-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Formulario de alta mascota individual enviado');
            alert('Alta Mascota: Implementa tu lógica aquí.');
        });

        document.getElementById('amo-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Formulario de alta amo individual enviado');
            alert('Alta Amo: Implementa tu lógica aquí.');
        });
        
        // --- Formularios de Baja (bajas.html) ---
        document.getElementById('baja-mascota-amo-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Formulario de baja mascota-amo enviado');
            alert('Baja Mascota-Amo: Implementa tu lógica aquí.');
        });
        
        document.getElementById('baja-veterinario-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Formulario de baja veterinario enviado');
            alert('Baja Veterinario: Implementa tu lógica aquí.');
        });
        
        // --- Formularios de Modificación (modificacion.html) ---
        // Los botones "Modificar" (type="button") podrían necesitar listeners aquí
        // si deben cargar datos antes de que viewManager.js muestre los campos.
        // Por ahora, viewManager.js maneja la visibilidad basada en el 'change' del select.

        document.getElementById('mod-amo-form')?.addEventListener('submit', (e) => {
            // Este evento se dispara con el botón "Actualizar" (type="submit")
            e.preventDefault();
            console.log('Formulario de modificación amo ACTUALIZADO');
            alert('Modificación Amo (Actualizar): Implementa tu lógica aquí.');
        });
        
        document.getElementById('mod-mascota-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Formulario de modificación mascota ACTUALIZADO');
            alert('Modificación Mascota (Actualizar): Implementa tu lógica aquí.');
        });
        
        document.getElementById('mod-veterinario-form')?.addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Formulario de modificación veterinario ACTUALIZADO');
            alert('Modificación Veterinario (Actualizar): Implementa tu lógica aquí.');
        });
        
        // --- Interacciones específicas ---
        // Habilitar/deshabilitar select de mascota en la vista de BAJA
        document.getElementById('baja-amo-select')?.addEventListener('change', (e) => {
            const mascotaSelect = document.getElementById('baja-mascota-select');
            if (mascotaSelect) {
                mascotaSelect.disabled = !e.target.value; // Habilitar si hay un valor, deshabilitar si no.
                if (!e.target.value) {
                    mascotaSelect.value = ""; // Limpiar selección de mascota si se deselecciona el amo
                }
                // Aquí podrías añadir lógica para poblar 'baja-mascota-select'
                // con las mascotas del amo seleccionado (e.target.value).
            }
        });
        
        // Lógica para los botones "Mostrar" en la vista MOSTRAR (mostrar.html)
        const btnMostrarAmoMascotas = document.querySelector('#mostrar-amo-mascotas-tab button.btn-primary');
        if (btnMostrarAmoMascotas) {
            btnMostrarAmoMascotas.addEventListener('click', () => {
                const selectAmo = document.getElementById('amo-mascotas-select');
                const resultContainer = document.getElementById('amo-mascotas-result');
                const amoNombreDisplay = document.getElementById('amo-nombre-display');

                if (selectAmo?.value && resultContainer && amoNombreDisplay) {
                    console.log(`Mostrar mascotas para el amo: ${selectAmo.options[selectAmo.selectedIndex].text}`);
                    amoNombreDisplay.textContent = selectAmo.options[selectAmo.selectedIndex].text;
                    // Aquí iría la lógica para cargar y mostrar los datos en la tabla 'amo-mascotas-table'
                    resultContainer.classList.remove('hidden');
                    alert('Lógica para CARGAR y MOSTRAR mascotas del amo aquí.');
                } else if (resultContainer) {
                    resultContainer.classList.add('hidden');
                    if (amoNombreDisplay) amoNombreDisplay.textContent = "";
                    if (!selectAmo?.value) alert("Por favor, seleccione un amo para mostrar sus mascotas.");
                }
            });
        }

        const btnMostrarMascotaAmos = document.querySelector('#mostrar-mascota-amos-tab button.btn-primary');
        if (btnMostrarMascotaAmos) {
            btnMostrarMascotaAmos.addEventListener('click', () => {
                const selectMascota = document.getElementById('mascota-amos-select');
                const resultContainer = document.getElementById('mascota-amos-result');
                const mascotaNombreDisplay = document.getElementById('mascota-nombre-display');

                if (selectMascota?.value && resultContainer && mascotaNombreDisplay) {
                    console.log(`Mostrar amos para la mascota: ${selectMascota.options[selectMascota.selectedIndex].text}`);
                    mascotaNombreDisplay.textContent = selectMascota.options[selectMascota.selectedIndex].text;
                    // Aquí iría la lógica para cargar y mostrar los datos en la tabla 'mascota-amos-table'
                    resultContainer.classList.remove('hidden');
                    alert('Lógica para CARGAR y MOSTRAR amos de la mascota aquí.');
                } else if (resultContainer) {
                    resultContainer.classList.add('hidden');
                    if (mascotaNombreDisplay) mascotaNombreDisplay.textContent = "";
                    if (!selectMascota?.value) alert("Por favor, seleccione una mascota para mostrar sus amos.");
                }
            });
        }

        // Opcional: Si quieres que el contenedor de resultados se oculte si se deselecciona la opción en el select
        document.getElementById('amo-mascotas-select')?.addEventListener('change', (e) => {
            if (!e.target.value) {
                const resultContainer = document.getElementById('amo-mascotas-result');
                if (resultContainer) resultContainer.classList.add('hidden');
                const amoNombreDisplay = document.getElementById('amo-nombre-display');
                if (amoNombreDisplay) amoNombreDisplay.textContent = "";
            }
        });

        document.getElementById('mascota-amos-select')?.addEventListener('change', (e) => {
            if (!e.target.value) {
                const resultContainer = document.getElementById('mascota-amos-result');
                if (resultContainer) resultContainer.classList.add('hidden');
                const mascotaNombreDisplay = document.getElementById('mascota-nombre-display');
                if (mascotaNombreDisplay) mascotaNombreDisplay.textContent = "";
            }
        });
    }
}

// Al final de tu app.js (si es el último script cargado)
document.addEventListener('DOMContentLoaded', () => {
    // Primero asegúrate que ViewManager esté listo si no usaste import/export
    // Si ViewManager está definido globalmente por la carga <script>, puedes instanciarlo
    // Si viewManager.js es el script cargado justo antes, ViewManager debería estar definido.
    const viewManager = new ViewManager(); // Esto llamará a _activateInitialTab()
    const app = new App(); // Esto llamará a init() que tiene initFormEvents()
});