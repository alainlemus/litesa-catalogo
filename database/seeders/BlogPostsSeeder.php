<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

/**
 * Reemplaza las entradas del blog por artículos acordes al negocio.
 * Las imágenes viven en storage/app/public/blog/<archivo>.
 */
class BlogPostsSeeder extends Seeder
{
    public function run(): void
    {
        Post::query()->delete();

        foreach ($this->posts() as $i => $data) {
            $post = new Post($data + ['status' => 'published']);
            $post->created_at = now()->subDays(8 + $i * 11);
            $post->updated_at = $post->created_at;
            $post->save();
        }
    }

    private function posts(): array
    {
        return [
            [
                'title' => 'Cómo elegir la iluminación LED ideal para tu hogar',
                'slug' => 'como-elegir-iluminacion-led-para-tu-hogar',
                'category' => 'Iluminación',
                'image' => 'blog/elegir-iluminacion-led-hogar.webp',
                'excerpt' => 'Lúmenes, temperatura de color y tipo de base: las tres claves para comprar el foco correcto sin equivocarte.',
                'content' => <<<'HTML'
<p>Cambiar a iluminación LED es una de las decisiones más sencillas para ahorrar energía en casa, pero no todos los focos sirven para todos los espacios. Antes de comprar, conviene revisar tres datos que aparecen en la ficha de cada producto.</p>
<h2>1. Lúmenes, no watts</h2>
<p>Los watts indican cuánta energía consume una lámpara; los <strong>lúmenes</strong> indican cuánta luz entrega. Para una sala o una cocina necesitas más lúmenes que para un pasillo o una recámara. Si dudas, elige un foco con buena cantidad de lúmenes y una potencia baja: eso es justo lo que ofrece la tecnología LED.</p>
<h2>2. Temperatura de color</h2>
<p>La luz cálida (alrededor de 2700 K) crea ambientes acogedores; la luz neutra y fría (4000 K a 6500 K) favorece la concentración y se usa en cocinas, baños y áreas de trabajo. Escoge según la función de cada habitación.</p>
<h2>3. Tipo de base</h2>
<p>Revisa la base de tus portalámparas antes de comprar. Las más comunes en el hogar son E27 (la tradicional rosca) y E14 (más delgada, usada en focos tipo vela). Una base incorrecta no encaja, sin importar qué tan buena sea la lámpara.</p>
<h2>Otros detalles que suman</h2>
<ul>
<li><strong>Certificación:</strong> verifica que el producto indique su cumplimiento de la norma aplicable.</li>
<li><strong>Garantía:</strong> una garantía clara respalda la vida útil que promete el fabricante.</li>
<li><strong>Forma y acabado:</strong> focos bulbo, vela o decorativos cambian por completo la apariencia de una lámpara visible.</li>
</ul>
<p>En nuestro <a href="/iluminacion/catalogo">catálogo</a> puedes filtrar por uso y categoría, y consultar las especificaciones de cada modelo. Si necesitas ayuda, <a href="/contacto">escríbenos</a> y un asesor te orienta.</p>
HTML,
            ],
            [
                'title' => 'Alumbrado público LED: beneficios para municipios y ciudades',
                'slug' => 'alumbrado-publico-led-beneficios',
                'category' => 'Alumbrado',
                'image' => 'blog/alumbrado-publico-led.webp',
                'excerpt' => 'Menor consumo, menos mantenimiento y calles más seguras: por qué las luminarias LED son la opción para el alumbrado de vialidades.',
                'content' => <<<'HTML'
<p>El alumbrado público representa una parte importante del gasto energético de municipios y ciudades. Modernizar las luminarias con tecnología LED permite reducir ese gasto y, al mismo tiempo, mejorar la calidad de la luz en calles, avenidas y espacios públicos.</p>
<h2>Ahorro de energía</h2>
<p>Una luminaria LED entrega la misma iluminación que una lámpara tradicional con una fracción del consumo. Para un municipio con miles de puntos de luz, el ahorro acumulado es significativo.</p>
<h2>Menos mantenimiento</h2>
<p>La larga vida útil de las luminarias LED reduce la frecuencia de reemplazos y las cuadrillas necesarias para atenderlas. Eso se traduce en menos costos operativos y menos interrupciones del servicio.</p>
<h2>Mejor visibilidad y seguridad</h2>
<p>La luz LED es más uniforme y direccional, lo que ayuda a iluminar la vialidad sin desperdiciar luz hacia el cielo o hacia propiedades vecinas. Una buena iluminación favorece la seguridad de peatones y conductores.</p>
<h2>Qué considerar al elegir luminarias</h2>
<ul>
<li>Potencia y flujo luminoso adecuados a la altura del poste y al ancho de la vialidad.</li>
<li>Grado de protección contra polvo y agua, indispensable en exteriores.</li>
<li>Cumplimiento de la normatividad aplicable a luminarios para vialidades.</li>
<li>Garantía y respaldo del proveedor.</li>
</ul>
<p>Si tu proyecto es de gobierno o de infraestructura, conoce nuestras opciones de <a href="/iluminacion/aplicaciones/alumbrado-publico">alumbrado público</a> o <a href="/contacto">solicita una cotización</a>.</p>
HTML,
            ],
            [
                'title' => 'Iluminación industrial: cómo iluminar naves y bodegas con LED',
                'slug' => 'iluminacion-industrial-naves-bodegas-led',
                'category' => 'Industria',
                'image' => 'blog/iluminacion-industrial-led.webp',
                'excerpt' => 'Altura de montaje, distribución y mantenimiento: lo que debes planear para iluminar grandes espacios de trabajo.',
                'content' => <<<'HTML'
<p>Una nave industrial o una bodega tiene necesidades de iluminación muy distintas a las de una casa: techos altos, grandes superficies y jornadas largas de operación. Una buena planeación evita zonas oscuras, deslumbramiento y gastos innecesarios.</p>
<h2>La altura de montaje importa</h2>
<p>Cuanto más alta está la luminaria, más potencia y mejor óptica se requieren para que la luz llegue al plano de trabajo con suficiente intensidad. Las lámparas de alta potencia tipo campana o bala industrial están pensadas para este escenario.</p>
<h2>Distribución uniforme</h2>
<p>Más que instalar muchas luminarias, se trata de distribuirlas correctamente. Una iluminación uniforme reduce el cansancio visual y los errores en tareas como el picking, la inspección o la operación de montacargas.</p>
<h2>Ahorro y mantenimiento</h2>
<p>En espacios que operan muchas horas al día, el consumo eléctrico pesa en los costos. El LED reduce ese consumo y, gracias a su larga vida útil, disminuye las maniobras de mantenimiento en altura, que son costosas y riesgosas.</p>
<h2>Checklist antes de comprar</h2>
<ul>
<li>Flujo luminoso (lúmenes) y potencia de cada luminaria.</li>
<li>Voltaje compatible con tu instalación.</li>
<li>Temperatura de color acorde a la tarea (la luz neutra o fría es común en áreas productivas).</li>
<li>Garantía y certificación del producto.</li>
</ul>
<p>Consulta nuestro <a href="/iluminacion/catalogo">catálogo de iluminación</a> o <a href="/contacto">cuéntanos tu proyecto</a> para recomendarte opciones.</p>
HTML,
            ],
            [
                'title' => 'Importación y exportación: pasos para abrir nuevos mercados',
                'slug' => 'importacion-exportacion-abrir-nuevos-mercados',
                'category' => 'Comercio exterior',
                'image' => 'blog/importacion-exportacion-mercados.webp',
                'excerpt' => 'Un recorrido práctico por las etapas para llevar tu producto a otro país o traer mercancía a México con orden y menos riesgos.',
                'content' => <<<'HTML'
<p>Llevar un producto a otro país, o traer mercancía a México, abre oportunidades de crecimiento, pero también exige orden. Estas son las etapas que conviene considerar.</p>
<h2>1. Define el producto y el mercado</h2>
<p>Investiga dónde existe demanda para lo que ofreces, qué competidores hay y qué precios maneja el mercado. Elegir bien el destino ahorra tiempo y dinero.</p>
<h2>2. Revisa requisitos y regulaciones</h2>
<p>Cada producto tiene su clasificación arancelaria y puede estar sujeto a normas, permisos o etiquetado específico. Conocerlos desde el inicio evita retenciones en aduana.</p>
<h2>3. Elige aliados confiables</h2>
<p>Agentes aduanales, transportistas y proveedores marcan la diferencia. Trabajar con empresas con experiencia reduce errores en documentación y tiempos de tránsito.</p>
<h2>4. Planea costos y tiempos</h2>
<p>Además del precio de la mercancía, considera flete, seguros, aranceles, impuestos y gastos de almacenaje. Un cálculo realista evita sorpresas en el margen.</p>
<h2>5. Cuida la documentación</h2>
<p>Facturas, listas de empaque, certificados y pedimentos deben coincidir entre sí. Un dato inconsistente puede detener todo el envío.</p>
<p>En Grupo Litesa acompañamos a nuestros clientes para abrir nuevos mercados y posicionar su marca. Conoce más sobre nuestros <a href="/servicios">servicios</a> o <a href="/contacto">platiquemos de tu proyecto</a>.</p>
HTML,
            ],
            [
                'title' => 'Qué es la NOM y por qué importa al comprar iluminación LED',
                'slug' => 'que-es-la-nom-iluminacion-led',
                'category' => 'Normatividad',
                'image' => 'blog/normas-nom-iluminacion-led.webp',
                'excerpt' => 'Las Normas Oficiales Mexicanas establecen requisitos para los productos que se venden en el país. Te explicamos cómo aplican a la iluminación.',
                'content' => <<<'HTML'
<p>Las Normas Oficiales Mexicanas (NOM) son regulaciones técnicas obligatorias que establecen características y especificaciones que deben cumplir ciertos productos, procesos y servicios en México. En iluminación, existen normas relacionadas con eficiencia energética y seguridad.</p>
<h2>¿Por qué es importante?</h2>
<ul>
<li><strong>Confianza:</strong> un producto que cumple la norma ha sido evaluado conforme a criterios técnicos definidos.</li>
<li><strong>Eficiencia:</strong> las normas de eficiencia energética buscan que las lámparas aprovechen mejor la electricidad.</li>
<li><strong>Cumplimiento legal:</strong> comercializar productos sin cumplir la normatividad aplicable puede acarrear sanciones y retenciones en aduana.</li>
</ul>
<h2>Normas relacionadas con iluminación LED</h2>
<p>Existen normas específicas para lámparas LED integradas de uso general (por ejemplo, la NOM-030-ENER) y para luminarios LED de vialidades y áreas exteriores públicas (por ejemplo, la NOM-031-ENER). Las normas se actualizan con el tiempo, por lo que conviene verificar siempre la versión vigente.</p>
<h2>Cómo verificar un producto</h2>
<p>Revisa que la ficha o el empaque indiquen la certificación aplicable, y solicita la documentación a tu proveedor cuando se trate de compras de volumen o proyectos de gobierno. En nuestro catálogo, cada producto muestra su certificación junto con la garantía y las demás especificaciones.</p>
<p>¿Tienes dudas sobre un producto? <a href="/contacto">Escríbenos</a> o revisa las <a href="/preguntas-frecuentes">preguntas frecuentes</a>.</p>
HTML,
            ],
            [
                'title' => 'Logística y cadena de suministro: cómo reducir tiempos en tus importaciones',
                'slug' => 'logistica-cadena-de-suministro-importaciones',
                'category' => 'Logística',
                'image' => 'blog/logistica-cadena-suministro.webp',
                'excerpt' => 'Anticipación, documentación y buena comunicación con tus aliados: cuatro prácticas para que tu mercancía llegue a tiempo.',
                'content' => <<<'HTML'
<p>En comercio exterior, un retraso rara vez se debe a un solo factor. Suele ser la suma de pequeñas fallas en la planeación y la documentación. Estas prácticas ayudan a mantener tu cadena de suministro en movimiento.</p>
<h2>Planea con anticipación</h2>
<p>Los tiempos de producción, tránsito marítimo y despacho aduanal pueden variar por temporada o congestión en puertos. Hacer pedidos con margen reduce el riesgo de quedarte sin inventario.</p>
<h2>Cuida la documentación</h2>
<p>La mayoría de las demoras en aduana provienen de datos inconsistentes o documentos incompletos. Revisa facturas, listas de empaque y certificados antes de que el embarque salga de origen.</p>
<h2>Comunícate con tus aliados</h2>
<p>Mantén contacto constante con proveedores, transportistas y agente aduanal. Una alerta a tiempo permite reaccionar antes de que un problema se convierta en retraso.</p>
<h2>Da seguimiento al embarque</h2>
<p>Conocer en qué punto de la ruta está tu carga te permite coordinar recepción, almacenaje y distribución sin tiempos muertos.</p>
<h2>Diversifica cuando sea posible</h2>
<p>Depender de un único proveedor o de una sola ruta aumenta el riesgo. Contar con alternativas da flexibilidad ante imprevistos.</p>
<p>Si buscas apoyo para tus operaciones de importación y exportación, conoce nuestros <a href="/servicios">servicios</a>.</p>
HTML,
            ],
            [
                'title' => 'Temperatura de color: luz cálida, neutra o fría, ¿cuál elegir?',
                'slug' => 'temperatura-de-color-luz-calida-neutra-fria',
                'category' => 'Iluminación',
                'image' => 'blog/temperatura-de-color-luz.webp',
                'excerpt' => 'Los grados Kelvin determinan el ambiente de un espacio. Aprende a elegir la tonalidad adecuada para cada área.',
                'content' => <<<'HTML'
<p>La <strong>temperatura de color</strong> se mide en grados Kelvin (K) y describe qué tan cálida o fría se percibe la luz. No tiene que ver con el calor que emite la lámpara, sino con su tonalidad.</p>
<h2>Luz cálida (2700 K a 3000 K)</h2>
<p>De tono amarillento, similar a la de los focos incandescentes. Crea ambientes acogedores y relajados: ideal para salas, recámaras, restaurantes y hoteles.</p>
<h2>Luz neutra (4000 K)</h2>
<p>Equilibrada y natural. Funciona bien en cocinas, oficinas, comercios y áreas donde se necesita claridad sin sensación de frialdad.</p>
<h2>Luz fría (5000 K a 6500 K)</h2>
<p>De tono blanco-azulado. Favorece la concentración y la visibilidad, por lo que se usa en áreas de trabajo, bodegas, estacionamientos y exteriores.</p>
<h2>Consejos prácticos</h2>
<ul>
<li>No mezcles temperaturas muy distintas en un mismo espacio.</li>
<li>Para zonas de descanso, prefiere luz cálida.</li>
<li>Para zonas de tareas detalladas, usa luz neutra o fría.</li>
<li>Los focos decorativos de filamento suelen ofrecer tonos cálidos que realzan el diseño de la lámpara.</li>
</ul>
<p>Explora el <a href="/iluminacion/catalogo">catálogo</a> y elige según el ambiente que quieres lograr.</p>
HTML,
            ],
            [
                'title' => 'Iluminación para hoteles y restaurantes: cómo crear ambientes que enamoran',
                'slug' => 'iluminacion-para-hoteles-y-restaurantes',
                'category' => 'Aplicaciones',
                'image' => 'blog/iluminacion-hoteles-restaurantes.webp',
                'excerpt' => 'La luz influye en la experiencia del huésped y del comensal. Conoce qué tipos de luminarias funcionan mejor en hospitalidad.',
                'content' => <<<'HTML'
<p>En hoteles y restaurantes, la iluminación es parte de la experiencia. Una buena propuesta de luz resalta la arquitectura, destaca los platillos y hace que las personas se sientan cómodas y quieran volver.</p>
<h2>Capas de luz</h2>
<p>Los espacios mejor iluminados combinan tres capas: una iluminación general suave, luz de acento para resaltar detalles (cuadros, texturas, barra, recepción) y luz funcional en las áreas de servicio.</p>
<h2>Luminarias dirigibles</h2>
<p>Las lámparas tipo MR16 y GU10, y las de tipo PAR, permiten dirigir el haz de luz hacia un punto específico. Son muy usadas para destacar mesas, vitrinas y elementos decorativos.</p>
<h2>Paneles y downlights</h2>
<p>Los paneles LED empotrables ofrecen una iluminación limpia y uniforme en lobbies, pasillos y habitaciones, con un diseño discreto.</p>
<h2>Luz cálida y regulable</h2>
<p>La luz cálida favorece el ambiente de descanso y convivencia. Si el proyecto lo permite, la posibilidad de regular la intensidad ayuda a adaptar el espacio a distintos momentos del día.</p>
<h2>Eficiencia y mantenimiento</h2>
<p>Los establecimientos operan muchas horas. El LED reduce el consumo eléctrico y las reposiciones, algo valioso en espacios de acceso complicado.</p>
<p>Conoce nuestras soluciones para <a href="/iluminacion/aplicaciones/hotel">hoteles</a> y <a href="/iluminacion/aplicaciones/restaurante">restaurantes</a>.</p>
HTML,
            ],
            [
                'title' => 'Alianzas estratégicas con marcas internacionales: ventajas para tu negocio',
                'slug' => 'alianzas-estrategicas-marcas-internacionales',
                'category' => 'Empresa',
                'image' => 'blog/alianzas-marcas-internacionales.webp',
                'excerpt' => 'Trabajar con marcas respaldadas internacionalmente te da acceso a mejores productos, soporte y confianza ante tus clientes.',
                'content' => <<<'HTML'
<p>En Grupo Litesa nacimos con el objetivo de comercializar bienes y servicios que mejoren la calidad de vida de los consumidores. Para lograrlo, construimos <strong>alianzas estratégicas</strong> con marcas respaldadas internacionalmente.</p>
<h2>Productos de mayor calidad</h2>
<p>Las marcas con trayectoria cuentan con procesos de producción y control de calidad consolidados, lo que se traduce en productos más confiables.</p>
<h2>Acceso a más opciones</h2>
<p>Una red de proveedores amplia nos permite ofrecer distintos productos y soluciones para sectores como construcción, gobierno y comercio al mayoreo.</p>
<h2>Respaldo y garantía</h2>
<p>Trabajar con marcas reconocidas facilita ofrecer garantías claras y soporte posterior a la venta, algo clave en proyectos de largo plazo.</p>
<h2>Confianza ante tus clientes</h2>
<p>Quien compra buscando calidad valora que detrás del producto haya una marca con respaldo. Esa confianza se traslada también a tu negocio.</p>
<h2>Un socio que te acompaña</h2>
<p>Más allá de vender un producto, buscamos ayudarte a abrir nuevos mercados y posicionar tu marca. Conoce <a href="/nosotros">quiénes somos</a> o <a href="/contacto">escríbenos</a> para platicar de tu proyecto.</p>
HTML,
            ],
        ];
    }
}
