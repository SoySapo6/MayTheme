<p align="center">
  <img src="https://dash.nefu.life/storage/icon.png" width="220" alt="MayHost Logo">
</p>

<h1 align="center">MayTheme v12</h1>

<p align="center">
  <strong>Interfaz visual de alto rendimiento para CtrlPanel.gg</strong><br>
  Diseñado exclusivamente para <a href="https://dash.nefu.life">MayHost</a>.
</p>

|                     |                     |                     |
|:-------------------:|:-------------------:|:-------------------:|
| **Vista de Administrador**       | **Panel de Control**       | **Servidores**       |
| <img src="https://files.catbox.moe/61cf7c.png" width="1920"/> | <img src="https://files.catbox.moe/unii6d.png" width="1920"/> | <img src="https://files.catbox.moe/q05d22.png" width="1920"/> |

---

## Descripción

MayTheme es una modificación visual integral para el panel de gestión de servidores CtrlPanel.gg. Este tema ha sido desarrollado con un enfoque en el minimalismo, el alto contraste (Dark Mode) y la fluidez de interacción mediante animaciones CSS aceleradas por hardware.

El diseño elimina el ruido visual innecesario, priorizando la legibilidad y la experiencia de usuario tanto en dispositivos móviles como en escritorio.

## Características Técnicas

*   **Arquitectura Visual:** Diseño High-Contrast (Fondo #000000 puro) con bordes blancos definidos.
*   **Motor de Animaciones:** Transiciones CSS3 fluidas para elementos interactivos (hover, focus, modales).
*   **Responsive Design:** Adaptación nativa corregida para viewports móviles sin colisiones de elementos.
*   **Footer Dinámico:** Inyección de créditos mediante JavaScript para evitar conflictos con el motor de plantillas Blade.
*   **Musica Integrada:** Si se detecta que en un motd contiene ```[REPRODUCE](https://ejemplo.com/cancion.mp3)``` se reproducira la musica automáticamente.

## Instalación

Siga estos pasos para la implementación del tema en su entorno de producción.

### 1. Clonar el Repositorio

Acceda al directorio de temas de su instalación CtrlPanel y clone los archivos fuente.

```bash
cd /var/www/ctrlpanel/themes
git clone https://github.com/SoySapo6/MayTheme.git
cp -r /var/www/ctrlpanel/themes/MayTheme/MayTheme /var/www/ctrlpanel/public/themes
```

> **NOTA:** Si decides actualizar el tema ejecuta ```cd /var/www/ctrlpanel/themes/MayTheme; git pull && rm -rf /var/www/ctrlpanel/public/themes/MayTheme && cp -r /var/www/ctrlpanel/themes/MayTheme/MayTheme /var/www/ctrlpanel/public/themes```

### 2. Activación

1.  Ingrese a su panel de administración.
2.  Navegue a **Configuraciones** > **General**.
3.  Bajas hasta encontrarte con "Theme", seleccione **MayTheme**.
4.  Guarde los cambios.

## Créditos y Atribución

Este tema utiliza como base estructural el tema **BlueInfinity** para garantizar la compatibilidad con las versiones actuales de CtrlPanel.gg, sobre el cual se ha reescrito la capa de presentación (CSS/JS).

*   **Desarrollador Principal:** SoyMaycol
*   **Organización:** MayHost
*   **Base:** BlueInfinity Theme

---

Copyright &copy; 2025 MayHost. Todos los derechos reservados.
