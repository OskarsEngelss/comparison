<x-layout title="Create">
    <div class="categories">
        <p>Categories:</p>
        <form class="categories-form">
            <x-category-switch categoryName="price">Use price:</x-category-switch>
            <x-category-switch categoryName="specs">Use specs:</x-category-switch>
            <x-category-switch categoryName="shipping">Use shipping:</x-category-switch>
        </form>
    </div>
    <form class="main-form">
        <label>
            Product type:
            <input type="text" name="productType"/>
        </label>
        <label>
            Product name:
            <input type="text" name="name" />
        </label>
        <label>
            Price:
            <input type="number" name="price" />
        </label>
        <label>
            Specs:
            <input type="text" name="specs" />
        </label>
    </form>
</x-layout>