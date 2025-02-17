<?php

namespace App\Http\Controllers;

use App\Interfaces\IProductService;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    private readonly IProductService $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;

    }

    public function index(): View
    {
        return view('products.index');
    }

    public function show(Product $product): View
    {
        $product = cache()->remember('product-index', 60 * 1, function () use ($product) {
            return $this->productService->getProduct($product);
        });
        $relatedProducts = $this->productService->getRelatedProducts($product->id);

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
