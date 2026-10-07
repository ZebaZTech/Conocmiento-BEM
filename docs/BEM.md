1. Introducción

Este documento explica por qué se eligió la metodología BEM (Block, Element, Modifier) para escribir el CSS del sitio, y cómo se aplicó a cada sección: navbar, hero, tarjetas de productos y footer. El objetivo fue lograr un código fácil de leer, fácil de mantener y sin conflictos entre estilos.

2. ¿Qué es BEM y por qué se eligió?

BEM es una convención para nombrar clases CSS. Divide la interfaz en tres conceptos:

Bloque (block): un componente independiente con sentido propio. Ejemplo: navbar, hero, card.
Elemento (element): una parte que solo existe dentro de un bloque. Se escribe con dos guiones bajos. Ejemplo: card__price.
Modificador (modifier): una variante de un bloque o elemento, escrita con dos guiones. Ejemplo: card--destacada. En este proyecto no hizo falta usarlos, pero la convención deja preparado el camino para agregarlos sin romper nada.

Se eligió BEM por cuatro razones:

El nombre de la clase explica su función. Al leer card__price se entiende que es el precio dentro de una tarjeta, sin abrir el HTML.
Evita conflictos de estilos. Cada clase pertenece a un único bloque, así que cambiar .card__title no afecta al título del hero.
Mantiene la especificidad baja. Todos los selectores son una sola clase (.hero__title), sin cadenas como .hero h1 ni header nav ul li a. Esto evita tener que usar !important o selectores cada vez más largos para sobrescribir estilos.
Permite reutilizar componentes. El bloque card funciona en cualquier parte de la página, y se podrían agregar más tarjetas sin escribir CSS nuevo.
3. Decisiones por componente
3.1 Navbar
Bloque: navbar
Elementos: navbar__list, navbar__item, navbar__link

Se usó una lista <ul> dentro de <nav> porque un menú es semánticamente una lista de enlaces, lo cual ayuda a la accesibilidad y a los lectores de pantalla. El diseño horizontal se resolvió con display: flex y gap, que es más simple y limpio que usar márgenes en cada elemento. Los enlaces usan anclas internas (#inicio, #productos) para navegar dentro de la misma página.

3.2 Hero
Bloque: hero
Elementos: hero__title, hero__text, hero__button

El hero comunica el propósito de la página con un título (<h1>, único en el documento), un texto breve y un botón de acción. El botón es un enlace <a> con aspecto de botón, porque su función es navegar hacia la sección de productos. El padding generoso crea la sensación de sección principal destacada.

3.3 Sección de productos y tarjetas
Bloques: products (la sección) y card (cada tarjeta)
Elementos de products: products__title, products__grid
Elementos de card: card__image, card__body, card__price, card__title, card__shipping

Aquí la decisión clave fue separar en dos bloques. products solo se encarga de la disposición (el contenedor y la cuadrícula), mientras que card solo se encarga de cómo se ve una tarjeta. Esto significa que la tarjeta no depende de dónde esté colocada: si mañana se coloca en otra sección, mantiene su aspecto.

Otras decisiones técnicas:

CSS Grid con repeat(auto-fit, minmax(240px, 1fr)): hace el diseño adaptable. Las tarjetas se acomodan solas según el ancho de pantalla, sin necesidad de reglas distintas para cada dispositivo.
Efecto hover: se logró con transform: translateY(-6px) y un cambio de box-shadow, junto con transition para suavizar el cambio. Se eligió transform en lugar de modificar margin o top porque es más fluido visualmente y no mueve el resto de los elementos de la página.
object-fit: cover: mantiene las imágenes con la misma altura sin deformarlas.
Estructura inspirada en Mercado Libre: imagen, precio destacado, título del producto y etiqueta de envío, en ese orden de importancia visual.
3.4 Footer
Bloque: footer
Elementos: footer__links, footer__link, footer__copy

El footer contiene los tres enlaces externos. Estos usan target="_blank" para abrirse en una pestaña nueva y rel="noopener noreferrer" como medida de seguridad, ya que evita que la página externa pueda acceder a la ventana original.

4. Organización de archivos

Cada bloque tiene su propio archivo CSS, y un archivo principal los reúne con @import:

css/
├── main.css
├── base.css
└── components/
    ├── navbar.css
    ├── hero.css
    ├── cards.css
    └── footer.css

La regla que se siguió es un bloque, un archivo. Las ventajas son:

Localizar un estilo es inmediato: para cambiar el footer se abre footer.css.
Se puede trabajar en un componente sin tocar los demás.
base.css queda reservado para estilos generales, separados de los componentes.
main.css funciona como índice del proyecto.
5. Buenas prácticas aplicadas
Solo clases en los selectores, sin selectores de etiqueta ni de id para dar estilos.
Un solo nivel de profundidad, sin anidar selectores.
Nombres en inglés y en minúsculas, con guiones solo dentro de una palabra compuesta y separadores BEM entre bloque, elemento y modificador.
Etiquetas HTML semánticas (header, nav, main, section, article, footer) combinadas con las clases BEM, de modo que la estructura es clara tanto para las personas como para los navegadores.
Hover con transiciones, para dar retroalimentación visual al usuario.
6. Conclusión

BEM permitió construir el sitio con un CSS predecible: cada clase indica a qué componente pertenece, ningún estilo interfiere con otro y cada componente tiene su propio archivo. Esto reduce errores y facilita ampliar el sitio, por ejemplo agregando nuevas tarjetas o un modificador como card--destacada, sin reescribir lo que ya existe.