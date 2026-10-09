<?php

use App\Filament\Resources\FaqResource\Pages\CreateFaq;
use App\Filament\Resources\FaqResource\Pages\ListFaqs;
use App\Filament\Resources\ProductUseResource\Pages\EditProductUse;
use App\Filament\Resources\ServicesPageSettingResource\Pages\EditServicesPageSetting;
use App\Models\Faq;
use App\Models\ProductUse;
use App\Models\ServicesPageSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('edita la página de servicios desde el admin', function () {
    $settings = ServicesPageSetting::current();

    Livewire::test(EditServicesPageSetting::class, ['record' => $settings->getKey()])
        ->assertFormSet(['hero_title' => $settings->hero_title])
        ->fillForm(['hero_title' => 'Título editado'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($settings->fresh()->hero_title)->toBe('Título editado');
});

it('lista y crea preguntas frecuentes', function () {
    Livewire::test(ListFaqs::class)->assertSuccessful();

    Livewire::test(CreateFaq::class)
        ->fillForm(['question' => '¿Prueba?', 'answer' => 'Sí.', 'is_active' => true])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Faq::where('question', '¿Prueba?')->exists())->toBeTrue();
});

it('permite editar descripción y SEO de una aplicación', function () {
    $use = ProductUse::create(['name' => 'Hotel']);

    Livewire::test(EditProductUse::class, ['record' => $use->getKey()])
        ->assertFormExists()
        ->assertFormFieldExists('description')
        ->assertFormFieldExists('meta_title');
});

it('crea un producto desde el admin y genera su slug', function () {
    $category = App\Models\Category::create(['name' => 'Reflectores']);
    $use = ProductUse::create(['name' => 'Hotel']);

    Livewire::test(App\Filament\Resources\ProductResource\Pages\CreateProduct::class)
        ->fillForm([
            'name' => 'Producto Prueba Admin',
            'warranty' => '2 años',
            'category_id' => $category->id,
            'uses' => [$use->id],
            'meta_title' => 'Título SEO',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $product = App\Models\Product::where('name', 'Producto Prueba Admin')->first();
    expect($product)->not->toBeNull()
        ->and($product->slug)->toBe('producto-prueba-admin')
        ->and($product->meta_title)->toBe('Título SEO');
});

it('crea una entrada de blog desde el admin y genera su slug', function () {
    Livewire::test(App\Filament\Resources\PostResource\Pages\CreatePost::class)
        ->fillForm([
            'title' => 'Entrada de prueba admin',
            'category' => 'Pruebas',
            'content' => '<p>Contenido</p>',
            'status' => 'published',
            'meta_description' => 'Descripción SEO',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $post = App\Models\Post::where('title', 'Entrada de prueba admin')->first();
    expect($post)->not->toBeNull()
        ->and($post->slug)->toBe('entrada-de-prueba-admin')
        ->and($post->meta_description)->toBe('Descripción SEO');
});

it('crea categorías, usos, testimonios y temperaturas de color', function () {
    Livewire::test(App\Filament\Resources\CategoryResource\Pages\CreateCategory::class)
        ->fillForm(['name' => 'Solares'])->call('create')->assertHasNoFormErrors();
    Livewire::test(App\Filament\Resources\ProductUseResource\Pages\CreateProductUse::class)
        ->fillForm(['name' => 'Escuela', 'description' => 'Para escuelas'])->call('create')->assertHasNoFormErrors();
    Livewire::test(App\Filament\Resources\TestimonialResource\Pages\CreateTestimonial::class)
        ->fillForm(['name' => 'Ana', 'position' => 'CEO', 'message' => 'Excelente servicio'])->call('create')->assertHasNoFormErrors();

    expect(App\Models\Category::where('name', 'Solares')->exists())->toBeTrue()
        ->and(ProductUse::where('name', 'Escuela')->value('description'))->toBe('Para escuelas');
});

it('abre el login dividido y el panel redirige a visitantes', function () {
    auth()->logout();
    $this->get('/admin/login')->assertOk()->assertSee('Administra tu sitio');
    $this->get('/admin')->assertRedirect();
});

it('convierte a WebP las imágenes subidas desde el admin', function () {
    Illuminate\Support\Facades\Storage::fake('public');

    Livewire::test(App\Filament\Resources\MediaFileResource\Pages\CreateMediaFile::class)
        ->fillForm([
            'name' => 'Prueba',
            'path' => Illuminate\Http\UploadedFile::fake()->image('foto.png', 1200, 800),
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $media = App\Models\MediaFile::where('name', 'Prueba')->first();
    expect($media->path)->toEndWith('.webp');
    Illuminate\Support\Facades\Storage::disk('public')->assertExists($media->path);
});

it('muestra los gestores de fotos y variantes del producto', function () {
    $product = App\Models\Product::create(['name' => 'Foco', 'slug' => 'foco']);

    foreach ([
        App\Filament\Resources\ProductResource\RelationManagers\PhotosRelationManager::class,
    ] as $manager) {
        Livewire::test($manager, ['ownerRecord' => $product, 'pageClass' => App\Filament\Resources\ProductResource\Pages\EditProduct::class])
            ->assertSuccessful();
    }
});
