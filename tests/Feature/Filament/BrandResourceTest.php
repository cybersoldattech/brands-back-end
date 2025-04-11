<?php

declare(strict_types=1);

use App\Filament\Resources\BrandResource;
use App\Models\Brand;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Livewire\Livewire;

/**
 * @var \Tests\TestCase $this
 */
beforeEach(function (): void {
    $this->user = User::factory(['email' => 'admin@casinoonlinefrancais.info'])->create();
    $this->actingAs($this->user);
});

describe(BrandResource::class, function (): void {
    it('page can display table with records', function (): void {
        $brands = Brand::factory()
            ->count(10)
            ->create();
        Livewire::test(BrandResource\Pages\ListBrands::class)
            ->assertCanSeeTableRecords($brands);
    });

    it('Admin user can create brand', function (): void {
        Livewire::test(BrandResource\Pages\ListBrands::class)
            ->callAction(CreateAction::class, data: [
                'brand_name' => $name = 'Brand 1',
                'description' => 'Description 1',
                'brand_tag' => 'tag 1',
                'rating' => 5,
            ])
            ->assertHasNoActionErrors()
            ->assertStatus(200);

        $brand = Brand::query()->first();

        expect($brand)
            ->toBeInstanceOf(Brand::class)
            ->and($brand->brand_name)
            ->toBe($name);
    });

    it('Admin user can edit channel', function (): void {
        $brand = Brand::factory()->create();

        Livewire::test(BrandResource\Pages\ListBrands::class)
            ->callTableAction(EditAction::class, $brand, data: [
                'brand_name' => 'Edited brand 1',
            ])
            ->assertHasNoTableActionErrors();

        $brand->refresh();

        expect($brand->brand_name)->toBe('Edited brand 1');
    });
});
