<?php


use App\Models\Category;
use App\Models\Post;

it('has many posts', function () {
    //Arrange
    $category = Category::factory()->create();

    //Act
    Post::factory()->create([
        'category_id' => $category->id
    ]);

    //Assert
    $category->refresh();
    expect($category->posts)
        ->toHaveCount(1)
        ->each->toBeInstanceOf(Post::class);

});
