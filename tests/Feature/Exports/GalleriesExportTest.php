<?php

namespace Tests\Feature\Exports;

use App\Exports\GalleriesExport;
use App\Models\Gallery;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class GalleriesExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_galleries_export_can_be_instantiated(): void
    {
        $export = new GalleriesExport();
        $this->assertInstanceOf(GalleriesExport::class, $export);
    }

    public function test_galleries_export_returns_collection(): void
    {
        Gallery::create([
            'title' => 'Test Gallery 1',
            'image_path' => 'uploads/gallery/test1.jpg',
            'category' => 'umroh',
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Test Gallery 2',
            'image_path' => 'uploads/gallery/test2.jpg',
            'category' => 'haji',
            'is_active' => true,
        ]);

        $export = new GalleriesExport();
        $collection = $export->collection();

        $this->assertCount(2, $collection);
    }

    public function test_galleries_export_filters_by_category(): void
    {
        Gallery::create([
            'title' => 'Umroh Gallery',
            'image_path' => 'uploads/gallery/umroh.jpg',
            'category' => 'umroh',
            'is_active' => true,
        ]);

        Gallery::create([
            'title' => 'Haji Gallery',
            'image_path' => 'uploads/gallery/haji.jpg',
            'category' => 'haji',
            'is_active' => true,
        ]);

        $export = new GalleriesExport('umroh');
        $collection = $export->collection();

        $this->assertCount(1, $collection);
        $this->assertEquals('Umroh Gallery', $collection->first()->title);
    }

    public function test_galleries_export_filters_by_ids(): void
    {
        $gallery1 = Gallery::create([
            'title' => 'Gallery 1',
            'image_path' => 'uploads/gallery/test1.jpg',
            'category' => 'umroh',
            'is_active' => true,
        ]);

        $gallery2 = Gallery::create([
            'title' => 'Gallery 2',
            'image_path' => 'uploads/gallery/test2.jpg',
            'category' => 'haji',
            'is_active' => true,
        ]);

        $export = new GalleriesExport();
        $export->onlyIds([$gallery1->id]);
        $collection = $export->collection();

        $this->assertCount(1, $collection);
        $this->assertEquals('Gallery 1', $collection->first()->title);
    }

    public function test_galleries_export_has_correct_headings(): void
    {
        $export = new GalleriesExport();
        $headings = $export->headings();

        $expectedHeadings = [
            'ID',
            'Title',
            'Description',
            'Category',
            'Package',
            'Alt Text',
            'Is Video',
            'Sort Order',
            'Is Active',
            'Created At',
        ];

        $this->assertEquals($expectedHeadings, $headings);
    }

    public function test_galleries_export_maps_data_correctly(): void
    {
        $gallery = Gallery::create([
            'title' => 'Test Gallery',
            'description' => 'Test Description',
            'image_path' => 'uploads/gallery/test.jpg',
            'category' => 'umroh',
            'alt_text' => 'Alt text',
            'is_video' => false,
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $export = new GalleriesExport();
        $mapped = $export->map($gallery);

        $this->assertEquals($gallery->id, $mapped[0]);
        $this->assertEquals('Test Gallery', $mapped[1]);
        $this->assertEquals('Test Description', $mapped[2]);
        $this->assertEquals('Umroh', $mapped[3]);
        $this->assertEquals('Alt text', $mapped[5]);
        $this->assertEquals('No', $mapped[6]);
        $this->assertEquals(1, $mapped[7]);
        $this->assertEquals('Yes', $mapped[8]);
    }

    public function test_galleries_export_includes_package_name(): void
    {
        $package = Package::create([
            'name' => 'Test Package',
            'slug' => 'test-package',
            'type' => 'umroh',
            'price' => 15000000,
            'duration' => 9,
            'is_active' => true,
        ]);

        $gallery = Gallery::create([
            'title' => 'Test Gallery',
            'image_path' => 'uploads/gallery/test.jpg',
            'category' => 'umroh',
            'package_id' => $package->id,
            'is_active' => true,
        ]);

        $export = new GalleriesExport();
        $mapped = $export->map($gallery);

        $this->assertEquals('Test Package', $mapped[4]);
    }

    public function test_galleries_export_shows_na_for_no_package(): void
    {
        $gallery = Gallery::create([
            'title' => 'Test Gallery',
            'image_path' => 'uploads/gallery/test.jpg',
            'category' => 'umroh',
            'is_active' => true,
        ]);

        $export = new GalleriesExport();
        $mapped = $export->map($gallery);

        $this->assertEquals('N/A', $mapped[4]);
    }

    public function test_galleries_export_downloads_excel_file(): void
    {
        Gallery::create([
            'title' => 'Test Gallery',
            'image_path' => 'uploads/gallery/test.jpg',
            'category' => 'umroh',
            'is_active' => true,
        ]);

        Excel::fake();
        Excel::store(new GalleriesExport(), 'galleries.xlsx');

        Excel::assertStored('galleries.xlsx');
    }

    public function test_galleries_export_with_combination_filters(): void
    {
        $gallery1 = Gallery::create([
            'title' => 'Umroh Gallery 1',
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

        Gallery::create([
            'title' => 'Umroh Gallery 2',
            'image_path' => 'uploads/gallery/test3.jpg',
            'category' => 'umroh',
            'is_active' => true,
        ]);

        // Test category filter first
        $export = new GalleriesExport('umroh');
        $this->assertCount(2, $export->collection());

        // Then test with IDs
        $export->onlyIds([$gallery1->id]);
        $this->assertCount(1, $export->collection());
        $this->assertEquals('Umroh Gallery 1', $export->collection()->first()->title);
    }
}
