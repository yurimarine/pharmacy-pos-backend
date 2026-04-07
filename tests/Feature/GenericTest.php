// tests/Feature/GenericTest.php
<?php

use App\Models\Generic;

it('shows a list of generics', function () {
    Generic::factory(5)->create();

    $this->getJson(route('generics.index'))
         ->assertOk()
         ->assertJsonCount(5, 'data');
});

it('creates a generic with valid data', function () {
    $this->postJson(route('generics.store'), [
        'name'        => 'My Generic',
        'description' => 'Some description',
    ])
    ->assertCreated()
    ->assertJsonFragment(['name' => 'My Generic']);

    $this->assertDatabaseHas('generics', ['name' => 'My Generic']);
});

it('fails to create a generic with duplicate name', function () {
    Generic::factory()->create(['name' => 'Existing Name']);

    $this->postJson(route('generics.store'), [
        'name' => 'Existing Name',
    ])
    ->assertUnprocessable()
    ->assertJsonValidationErrors(['name']);
});

it('updates a generic', function () {
    $generic = Generic::factory()->create();

    $this->putJson(route('generics.update', $generic), [
        'name' => 'Updated Name',
    ])
    ->assertOk()
    ->assertJsonFragment(['name' => 'Updated Name']);

    $this->assertDatabaseHas('generics', ['name' => 'Updated Name']);
});

it('deletes a generic', function () {
    $generic = Generic::factory()->create();

    $this->deleteJson(route('generics.destroy', $generic))
         ->assertOk()
         ->assertJsonFragment(['message' => 'Deleted successfully']);

    $this->assertDatabaseMissing('generics', ['id' => $generic->id]);
});