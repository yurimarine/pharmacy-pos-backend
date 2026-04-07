<?php

use App\Models\Supplier;

it('shows a list of suppliers', function () {
    Supplier::factory(5)->create();

    $this->getJson(route('suppliers.index'))
         ->assertOk()
         ->assertJsonCount(5, 'data');
});

it('creates a supplier with valid data', function () {
    $this->postJson(route('suppliers.store'), [
        'name'           => 'Acme Pharma',
        'contact_person' => 'John Doe',
        'phone'          => '555-1234',
        'email'          => 'acme@example.com',
        'address'        => '123 Main St',
    ])
    ->assertCreated()
    ->assertJsonFragment(['name' => 'Acme Pharma']);

    $this->assertDatabaseHas('suppliers', ['name' => 'Acme Pharma']);
});

it('fails to create a supplier with duplicate name', function () {
    Supplier::factory()->create(['name' => 'Existing Supplier']);

    $this->postJson(route('suppliers.store'), [
        'name' => 'Existing Supplier',
    ])
    ->assertUnprocessable()
    ->assertJsonValidationErrors(['name']);
});

it('fails to create a supplier with duplicate email', function () {
    Supplier::factory()->create(['email' => 'taken@example.com']);

    $this->postJson(route('suppliers.store'), [
        'name'  => 'New Supplier',
        'email' => 'taken@example.com',
    ])
    ->assertUnprocessable()
    ->assertJsonValidationErrors(['email']);
});

it('shows a supplier', function () {
    $supplier = Supplier::factory()->create();

    $this->getJson(route('suppliers.show', $supplier))
         ->assertOk()
         ->assertJsonFragment(['name' => $supplier->name]);
});

it('updates a supplier', function () {
    $supplier = Supplier::factory()->create();

    $this->putJson(route('suppliers.update', $supplier), [
        'name' => 'Updated Supplier',
    ])
    ->assertOk()
    ->assertJsonFragment(['name' => 'Updated Supplier']);

    $this->assertDatabaseHas('suppliers', ['name' => 'Updated Supplier']);
});

it('deletes a supplier', function () {
    $supplier = Supplier::factory()->create();

    $this->deleteJson(route('suppliers.destroy', $supplier))
         ->assertOk()
         ->assertJsonFragment(['message' => 'Deleted successfully']);

    $this->assertDatabaseMissing('suppliers', ['id' => $supplier->id]);
});
