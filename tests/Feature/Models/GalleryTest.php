<?php

namespace Tests\Feature\Models;

use App\Models\Gallery;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryTest extends TestCase
{
    use RefreshDatabase;

    public function test_gallery_can_be_created(): void
    {
        $gallery = Gallery::create([
            'title' => 'Test Gallery',
            'description' => 'Test Description',
            'image_path' => 'uploads/gallery/test.jpg',
            'category' => 'umroh',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $this->assertDatabaseHas('lafatour_galleries', [
            'title' => 'Test Gallery',
            'category' => 'umroh',
        ]);
    }

    public function test_gallery_belongs_to_package(): void
    {
        $package = Package::create([
            'name' => 'Test Package',
            'slug' => 'test-package',
            'type' => 'umroh',
            'price' => 15000000,
            'duration' => 9,
            'quota' => 40,
            'is_active' => true,
        ]);

        $gallery = Gallery::create([
            'title' => 'Test Gallery',
            'image_path' => 'uploads/gallery/test.jpg',
            'category' => 'umroh',
            'package_id' => $package->id,
            'is_active' => true,
        ]);

        $this->assertEquals($package->id, $gallery->package->id);
        $this->assertEquals('Test Package', $gallery->package->name);
    }

    public function test_gallery_image_url_accessor(): void
    {
        $gallery = Gallery::create([
            'title' => 'Test Gallery',
            'image_path' => 'uploads/gallery/test.jpg',
            'category' => 'umroh',
            'is_active' => true,
        ]);

        $this->assertStringContainsString('uploads/gallery/test.jpg', $gallery->image_url);
    }

    public function test_gallery_image_url_with_full_url(): void
    {
        $gallery = Gallery::create([
            'title' => 'Test Gallery',
            'image_path' => 'https://example.com/image.jpg',
            'category' => 'umroh',
            'is_active' => true,
        ]);

        $this->assertEquals('https://example.com/image.jpg', $gallery->image_url);
    }

    public function test_thumbnail_url_returns_image_url_when_null(): void
    {
        $gallery = Gallery::create([
            'title' => 'Test Gallery',
            'image_path' => 'uploads/gallery/test.jpg',
            'thumbnail_path' => null,
            'category' => 'umroh',
            'is_active' => true,
        ]);

        $this->assertEquals($gallery->image_url, $gallery->thumbnail_url);
    }

    public function test_active_scope(): void
    {
        Gallery::create([
            'title' => 'Active Gallery',
            'image_path' => 'uploads/gallery/test1.jpg',
            'category' => 'umroh',
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Inactive Gallery',
            'image_path' => 'uploads/gallery/test2.jpg',
            'category' => 'umroh',
            'is_active' => false,
        ]);

        $activeGalleries = Gallery::active()->get();

        $this->assertCount(1, $activeGalleries);
        $this->assertEquals('Active Gallery', $activeGalleries->first()->title);
    }

    public function test_umroh_scope(): void
    {
        Gallery::create([
            'title' => 'Umroh Gallery',
            'image_path' => 'uploads/gallery/test1.jpg',
            'category' => 'umroh',
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Haji Gallery',
            'image_path' => 'uploads/gallery/test2.jpg',
            'category' => 'haji',
            'is_active' => true,
        ]);

        $umrohGalleries = Gallery::umroh()->get();

        $this->assertCount(1, $umrohGalleries);
        $this->assertEquals('Umroh Gallery', $umrohGalleries->first()->title);
    }

    public function test_haji_scope(): void
    {
        Gallery::create([
            'title' => 'Umroh Gallery',
            'image_path' => 'uploads/gallery/test1.jpg',
            'category' => 'umroh',
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Haji Gallery',
            'image_path' => 'uploads/gallery/test2.jpg',
            'category' => 'haji',
            'is_active' => true,
        ]);

        $hajiGalleries = Gallery::haji()->get();

        $this->assertCount(1, $hajiGalleries);
        $this->assertEquals('Haji Gallery', $hajiGalleries->first()->title);
    }

    public function test_videos_scope(): void
    {
        Gallery::create([
            'title' => 'Video Gallery',
            'image_path' => 'uploads/gallery/test1.jpg',
            'category' => 'umroh',
            'is_video' => true,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Image Gallery',
            'image_path' => 'uploads/gallery/test2.jpg',
            'category' => 'umroh',
            'is_video' => false,
            'is_active' => true,
        ]);

        $videos = Gallery::videos()->get();

        $this->assertCount(1, $videos);
        $this->assertEquals('Video Gallery', $videos->first()->title);
    }

    public function test_images_scope(): void
    {
        Gallery::create([
            'title' => 'Video Gallery',
            'image_path' => 'uploads/gallery/test1.jpg',
            'category' => 'umroh',
            'is_video' => true,
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Image Gallery',
            'image_path' => 'uploads/gallery/test2.jpg',
            'category' => 'umroh',
            'is_video' => false,
            'is_active' => true,
        ]);

        $images = Gallery::images()->get();

        $this->assertCount(1, $images);
        $this->assertEquals('Image Gallery', $images->first()->title);
    }
}
