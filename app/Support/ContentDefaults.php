<?php

namespace App\Support;

/** Contenido inicial editable desde el admin. */
class ContentDefaults
{
    public static function faqs(): array
    {
        return [
            ['¿Cómo solicito una cotización?', 'Puedes escribirnos desde la página de contacto, enviarnos un mensaje por WhatsApp o usar el botón “Solicitar cotización” en la ficha de cualquier producto. Un asesor te responderá a la brevedad.'],
            ['¿Qué garantía tienen los productos?', 'Cada producto indica su garantía en su ficha (por ejemplo, 2 o 3 años según el modelo). Consulta el detalle en el catálogo.'],
            ['¿Los productos cuentan con certificación?', 'Sí, la ficha de cada producto muestra su certificación, como la NOM cuando aplica, junto con el factor de potencia y el tipo de base.'],
            ['¿Cómo encuentro el producto adecuado para mi espacio?', 'Usa el catálogo con filtros por uso y categoría, o explora la sección de aplicaciones: residencia, escuela, hotel, restaurante, centro comercial y alumbrado público.'],
            ['¿Atienden proyectos de gobierno, construcción o comercio al mayoreo?', 'Sí. Somos importadores y comercializadores para distintos segmentos de mercado, entre ellos construcción, gobierno y comercio al mayoreo.'],
            ['¿Qué servicios ofrece Grupo Litesa?', 'Además de iluminación, ofrecemos servicios de importación y exportación y otras soluciones para abrir nuevos mercados. Revisa la sección de servicios para conocer más.'],
            ['¿Cómo me doy de baja del newsletter?', 'En el correo de confirmación que recibes al suscribirte hay un enlace para darte de baja en cualquier momento.'],
        ];
    }

    public static function servicesPage(): array
    {
        return [
            'hero_title' => 'Soluciones para abrir mercados y posicionar tu marca',
            'hero_subtitle' => 'Importación, exportación, distribución e iluminación: te acompañamos de principio a fin.',
            'values' => [
                ['title' => 'Alianzas internacionales', 'text' => 'Trabajamos con marcas respaldadas internacionalmente para ofrecerte productos de gran calidad.', 'icon' => 'globe'],
                ['title' => 'Atención a distintos sectores', 'text' => 'Construcción, gobierno y comercio al mayoreo: conocemos las necesidades de cada segmento.', 'icon' => 'building'],
                ['title' => 'Proceso transparente', 'text' => 'Te mantenemos informado en cada etapa para que sepas qué sigue y cuándo.', 'icon' => 'eye'],
                ['title' => 'Cumplimiento y calidad', 'text' => 'Cuidamos los estándares y la normatividad aplicable en cada proyecto.', 'icon' => 'shield'],
            ],
            'steps' => [
                ['title' => 'Escuchamos tu necesidad', 'text' => 'Platicamos contigo para entender el proyecto, los tiempos y lo que esperas lograr.'],
                ['title' => 'Proponemos la solución', 'text' => 'Te presentamos opciones de producto o servicio adecuadas a tu caso y a tu presupuesto.'],
                ['title' => 'Ejecutamos con cuidado', 'text' => 'Coordinamos compra, importación, logística y entrega con aliados de confianza.'],
                ['title' => 'Damos seguimiento', 'text' => 'Seguimos a tu lado después de la entrega para resolver dudas y apoyarte en lo que sigue.'],
            ],
            'sectors' => [
                ['title' => 'Construcción', 'text' => 'Materiales y soluciones para obras y desarrollos.', 'icon' => 'home'],
                ['title' => 'Gobierno', 'text' => 'Proyectos públicos como alumbrado de vialidades y espacios.', 'icon' => 'government'],
                ['title' => 'Comercio al mayoreo', 'text' => 'Surtido y distribución para comercializadores.', 'icon' => 'store'],
                ['title' => 'Hogar y comercio', 'text' => 'Iluminación LED para residencias, tiendas y restaurantes.', 'icon' => 'bulb'],
            ],
            'reasons' => [
                ['text' => 'Más de una opción de producto y proveedor para cada necesidad.'],
                ['text' => 'Acompañamiento cercano de un asesor durante todo el proyecto.'],
                ['text' => 'Garantía y certificaciones visibles en cada producto de iluminación.'],
                ['text' => 'Experiencia en importación, exportación y distribución.'],
            ],
            'cta_title' => 'Platiquemos de tu proyecto',
            'cta_text' => 'Cuéntanos qué necesitas y un asesor te responderá a la brevedad.',
            'meta_title' => 'Servicios de importación, exportación e iluminación',
            'meta_description' => 'Servicios de Grupo Litesa: importación y exportación, distribución, iluminación inteligente y soluciones para construcción, gobierno y comercio al mayoreo.',
        ];
    }
}
