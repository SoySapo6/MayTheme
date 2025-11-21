<p align="center">
  <img src="https://dash.nefu.life/storage/icon.png" width="220" alt="MayHost Logo">
</p>

<h1 align="center">MayTheme</h1>

<p align="center">
  <strong>Interfaz visual de alto rendimiento para CtrlPanel.gg</strong><br>
  Diseñado exclusivamente para <a href="https://dash.nefu.life">MayHost</a>.
</p>

---

## Descripción

MayTheme es una modificación visual integral para el panel de gestión de servidores CtrlPanel.gg. Este tema ha sido desarrollado con un enfoque en el minimalismo, el alto contraste (Dark Mode) y la fluidez de interacción mediante animaciones CSS aceleradas por hardware.

El diseño elimina el ruido visual innecesario, priorizando la legibilidad y la experiencia de usuario tanto en dispositivos móviles como en escritorio.

## Características Técnicas

*   **Arquitectura Visual:** Diseño High-Contrast (Fondo #000000 puro) con bordes blancos definidos.
*   **Motor de Animaciones:** Transiciones CSS3 fluidas para elementos interactivos (hover, focus, modales).
*   **Responsive Design:** Adaptación nativa corregida para viewports móviles sin colisiones de elementos.
*   **Footer Dinámico:** Inyección de créditos mediante JavaScript para evitar conflictos con el motor de plantillas Blade.

## Instalación

Siga estos pasos estrictos para la implementación del tema en su entorno de producción.

### 1. Clonar el Repositorio

Acceda al directorio de temas de su instalación CtrlPanel y clone los archivos fuente.

```bash
cd /var/www/ctrlpanel/themes
git clone https://github.com/SoySapo6/MayTheme.git
```

### 2. Actualizar la Caché del Sistema

Es necesario limpiar la caché de vistas de Laravel para que el sistema reconozca la nueva estructura de directorios.

```bash
cd /var/www/ctrlpanel
php artisan theme:refresh
php artisan optimize:clear
php artisan view:clear
```

### 3. Activación

1.  Ingrese a su panel de administración.
2.  Navegue a **Admin** > **Settings** > **General**.
3.  En el menú desplegable "Theme", seleccione **MayTheme**.
4.  Guarde los cambios.

> **Nota:** Se recomienda forzar una recarga del navegador (Ctrl + F5) tras la activación para purgar estilos CSS antiguos almacenados en caché.

## Créditos y Atribución

Este tema utiliza como base estructural el tema **BlueInfinity** para garantizar la compatibilidad con las versiones actuales de CtrlPanel.gg, sobre el cual se ha reescrito la capa de presentación (CSS/JS).

*   **Desarrollador Principal:** SoyMaycol
*   **Organización:** MayHost
*   **Base:** BlueInfinity Theme

---

Copyright &copy; 2025 MayHost. Todos los derechos reservados.
