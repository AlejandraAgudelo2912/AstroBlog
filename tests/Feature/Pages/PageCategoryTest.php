<?php


use App\Models\Category;

it('shows a list of all categories', function () {
    //Arrange
    $category = Category::factory(3)->create();
    $response = $this->get('/categories');

    //Act & Assert
    $response->assertSee($category[0]->name)
        ->assertSee($category[1]->name)
        ->assertSee($category[2]->name);
});
