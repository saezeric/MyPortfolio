# **MyPortfolio | Portfolio Personal en WordPress**

## **1. Introducción**

Este documento explica los detalles básicos del proyecto **Portfolio Personal en WordPress**. Su objetivo es definir qué se va a hacer, cómo se va a hacer y qué se necesita para completarlo. Además, proporciona un marco de referencia para futuras modificaciones y mejoras en el desarrollo del sitio.

**Nota:** Ninguno de los contenidos que se presentan a continuación representa una fase final del proyecto. A medida que avance el desarrollo, podrán ser modificados o ajustados según sea necesario.

## **2. Objetivo del Proyecto**

El proyecto consiste en la creación de un **portafolio web personal**, que será una herramienta para mostrar mi trabajo y conocimientos en desarrollo web. Este portafolio digital servirá como una carta de presentación en línea y permitirá visualizar mi evolución profesional y proyectos desarrollados.

El sitio incluirá documentación sobre cada proyecto, enlaces a repositorios de código y demostraciones del proyecto. Así, ofrecerá información relevante tanto para empleadores como para otros desarrolladores interesados en mi trabajo.

El portafolio será dinámico y fácil de actualizar, permitiendo la incorporación de nuevas habilidades y proyectos. Además, se aplicarán estrategias básicas de **SEO** únicamente por disfrute personal, sin que esto sea un requisito esencial en la estructura del sitio.

Su propósito es:

- Presentar mi experiencia y habilidades en desarrollo web o en otras áreas de manera estructurada y visualmente atractiva.
- Mostrar los proyectos en los que he trabajado y en los que sigo trabajando, incluyendo detalles técnicos y aprendizajes obtenidos.
- Facilitar la interacción y conocimiento de mi persona a empresarios u empresas del sector.
- Hacer que el sitio sea fácil de actualizar y mejorar con el tiempo, permitiendo incorporar nuevas secciones o funcionalidades según sea necesario.

## **3. Alcance del Proyecto**

- **Uso de WordPress:** Se utilizará WordPress como plataforma para administrar el contenido, permitiendo una gestión sencilla y flexible.
- **Construcción desde cero:** Se creará una plantilla personalizada para WordPress completamente desde cero, sin el uso de maquetadores visuales como Elementor.
- **Estructura del sitio:**
  - Página principal con información destacada, incluyendo una introducción breve y enlaces rápidos a las secciones más relevantes.
  - Sección "Sobre mí" con detalles personales, formación académica, certificaciones y experiencia laboral.
  - Página de proyectos con imágenes, descripciones, enlaces a repositorios y tecnologías utilizadas.
  - Sección de contacto con formulario, redes sociales y dirección de correo electrónico.
  - Posible integración de un blog donde se compartirán artículos, avances de proyectos o conocimientos adquiridos.
  - _Posibilidad de incluir nuevas funcionalidades a medida que vaya desarrollándose el proyecto._
- **Optimización SEO:** Se aplicarán estrategias básicas de SEO sin que esto sea un factor primordial en la construcción del sitio.
- **Seguridad y mantenimiento:** Se utilizarán plugins de seguridad para proteger la web, pero no se desarrollarán medidas de seguridad personalizadas desde cero.

## **4. Requisitos Técnicos**

### **4.1. Herramientas y Tecnologías**

- **Lenguajes:** HTML, CSS, JavaScript, PHP.
- **Base de Datos:** MySQL (manejado por WordPress).
- **Plugins esenciales:**
  - WPForms para formularios de contacto.
  - Wordfence o similar para seguridad.
  - Yoast SEO o Rank Math para posicionamiento en buscadores.
  - WP Rocket para mejorar la velocidad del sitio.
  - WPML o Polylang para traducción opcional.
  - BackWPup o UpdraftPlus para copias de seguridad automatizadas.
  - Google Analytics para monitorear el tráfico del sitio | _parte opcional, en todo caso se realizara si veo que puede estar interesante, si no no será implementado._

### **4.2. Hosting y Dominio**

- Todavía no está definido cómo se realizará la elección del hosting, pero se están explorando múltiples opciones para garantizar la mejor solución. Como alternativa, se puede comenzar trabajando en un entorno **LOCAL**, lo que permitirá desarrollar y probar la web con calma antes de decidir el servidor definitivo que se utilizará.

## **5. Metodología de Desarrollo**

El proyecto se desarrollará en varias etapas, asegurando una implementación estructurada y organizada:

- **Fase 1: Planificación**
  - Diseñar la estructura del sitio y definir su contenido.
  - Elegir las herramientas necesarias y planificar la arquitectura del sitio.
  - Crear bocetos y prototipos iniciales del diseño.
- **Fase 2: Desarrollo**
  - Instalar y configurar WordPress en un entorno de prueba.
  - Crear las páginas y configurar las funciones necesarias.
  - Construir la plantilla de WordPress completamente desde cero, sin maquetadores visuales.
  - Implementar funcionalidades interactivas como formularios de contacto y galerías dinámicas.
- **Fase 3: Pruebas y Optimización**
  - Comprobar que el sitio funciona bien en distintos dispositivos y navegadores.
  - Aplicar mejoras en SEO a modo de experimentación y aprendizaje (no es necesario pero se realizara en todo caso por puro aprendizaje y diversion).
  - Optimizar el rendimiento del sitio mediante compresión de imágenes o cualquier ajuste que mejore la velocidad de nuestro sitio.
  - Realizar pruebas de seguridad mediante plugins especializados si fuera necesario.
- **Fase 4: Publicación**
  - Subir el sitio al hosting definitivo y configurar el dominio.
  - Realizar ajustes finales y pruebas en el entorno en vivo.

## **6. Consideraciones Finales**

Este documento es una versión inicial de la definición del proyecto. A medida que se avance en el desarrollo, se podrán hacer cambios y mejoras para ajustarlo mejor a las necesidades. Se actualizará conforme se detecten nuevas oportunidades de mejora, asegurando que el sitio crezca y evolucione junto con la experiencia y los requerimientos del usuario.

## **Casos de Uso \- Portfolio Personal en WordPress**

### **Introducción**

Este documento define los **casos de uso** del proyecto **Portfolio Personal en WordPress**. La web no contará con sistema de autenticación ni funcionalidades que requieran registro de usuarios. Se identifican dos tipos de actores principales:

- **Usuarios (Anónimos):** Visitantes que navegan el sitio sin necesidad de registro. Pueden interactuar con ciertas secciones de la web, como leer el blog y dejar comentarios.
- **Admin:** El administrador del sitio, responsable de gestionar todo el contenido y la configuración del portafolio.

---

### **Casos de Uso para Usuarios Anónimos**

#### **CU-01: Navegar por el sitio web**

**Actor:** Usuario (Anónimo) **Descripción:** El usuario puede acceder a la web y navegar por sus distintas secciones. **Flujo principal:**

1. El usuario accede a la web a través de un navegador.
2. Puede visualizar el contenido del portafolio, incluyendo la sección "Sobre mí", "Proyectos" y "Blog".
3. Puede interactuar con enlaces de redes sociales proporcionados en la web.
4. Fin del caso de uso.

---

#### **CU-02: Visualizar la información del portfolio**

**Actor:** Usuario (Anónimo) **Descripción:** El usuario puede acceder a la información sobre el propietario del portafolio. **Flujo principal:**

1. El usuario accede a la sección "Sobre mí" o "Proyectos".
2. Se muestra información personal y profesional del administrador.
3. Puede leer sobre la trayectoria, habilidades y proyectos realizados.
4. Fin del caso de uso.

---

#### **CU-03: Visualizar el blog**

**Actor:** Usuario (Anónimo) **Descripción:** El usuario puede acceder y leer los artículos publicados en la sección del blog. **Flujo principal:**

1. El usuario accede a la sección "Blog".
2. Se muestra una lista de artículos publicados.
3. El usuario selecciona un artículo para leer su contenido.
4. Puede regresar a la lista de artículos o seguir navegando por la web.
5. Fin del caso de uso.

---

#### **CU-04: Comentar en artículos del blog**

**Actor:** Usuario (Anónimo) **Descripción:** El usuario puede dejar comentarios en los artículos del blog sin necesidad de registro. **Flujo principal:**

1. El usuario accede a un artículo en la sección "Blog".
2. En la parte inferior del artículo, encuentra un formulario de comentarios.
3. Escribe un comentario y lo envía.
4. El sistema guarda el comentario y lo muestra en la sección de comentarios.
5. Fin del caso de uso.

---

<!-- #### **CU-05: Contactar al administrador**

**Actor:** Usuario (Anónimo) **Descripción:** El usuario puede enviar un mensaje al administrador a través del formulario de contacto. **Flujo principal:**

1. El usuario accede a la sección "Contacto".
2. Completa el formulario con su nombre, email y mensaje.
3. Envía el formulario.
4. El administrador recibe el mensaje por correo electrónico.
5. Fin del caso de uso.

---

### **Casos de Uso para el Administrador**

#### **CU-06: Gestionar información del portfolio**

**Actor:** Admin **Descripción:** El administrador puede editar la información del portfolio (biografía, experiencia, habilidades, etc.). **Flujo principal:**

1. El administrador accede al panel de administración de WordPress.
2. Selecciona la sección "Sobre mí" o "Proyectos".
3. Edita los textos e imágenes correspondientes.
4. Guarda los cambios y verifica la actualización en el sitio público.
5. Fin del caso de uso.

---

#### **CU-07: Gestionar los proyectos mostrados en el portafolio**

**Actor:** Admin **Descripción:** El administrador puede agregar, editar o eliminar proyectos del portafolio. **Flujo principal:**

1. El administrador accede al panel de WordPress.
2. Navega a la sección "Proyectos".
3. Puede agregar un nuevo proyecto, modificar uno existente o eliminar un proyecto.
4. Guarda los cambios y verifica la actualización en la web pública.
5. Fin del caso de uso.

---

#### **CU-08: Gestionar los artículos del blog**

**Actor:** Admin **Descripción:** El administrador puede escribir, editar o eliminar artículos del blog. **Flujo principal:**

1. El administrador accede a la sección "Entradas" en el panel de administración.
2. Puede agregar un nuevo artículo, modificar uno existente o eliminar un artículo.
3. Guarda los cambios y verifica que se reflejen en la web.
4. Fin del caso de uso.

---

#### **CU-09: Moderar comentarios en el blog**

**Actor:** Admin **Descripción:** El administrador puede aprobar, eliminar o marcar como spam los comentarios realizados por los usuarios en los artículos del blog. **Flujo principal:**

1. El administrador accede a la sección "Comentarios" en el panel de WordPress.
2. Revisa los comentarios pendientes de aprobación.
3. Puede aprobar, responder, eliminar o marcar comentarios como spam.
4. Fin del caso de uso.

---

#### **CU-10: Configurar y optimizar el sitio web**

**Actor:** Admin **Descripción:** El administrador puede realizar ajustes en la configuración del sitio, instalar plugins y optimizar el rendimiento. **Flujo principal:**

1. El administrador accede a la configuración de WordPress.
2. Ajusta parámetros del sitio, como título, descripciones, enlaces permanentes, etc.
3. Puede instalar y configurar plugins para mejorar la seguridad, SEO y rendimiento.
4. Guarda los cambios y verifica que el sitio funcione correctamente.
5. Fin del caso de uso.

--- -->

## **Diagrama de Casos de Uso**

Este apartado presenta los **diagramas de casos de uso** del proyecto **Portfolio Personal en WordPress**. Estos diagramas permiten visualizar de manera estructurada las interacciones entre los distintos actores del sistema y las funcionalidades que pueden realizar dentro del sitio web.

A continuación, se presentan los diagramas de casos de uso correspondientes a cada actor, detallando sus interacciones dentro del sistema.

1. **Usuarios Anónimos:**

![Diagrama casos de uso Usuarios Anonimos](./images/diagramas/casos_uso/diagramaCasosUsoUsuarios.png)

2. **Administrador:**

**En proceso**
