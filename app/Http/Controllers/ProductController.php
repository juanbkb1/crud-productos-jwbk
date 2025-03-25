<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    // Mostrar listado de productos (vista)
    public function index()
    {
        return view('products.index');
    }

    // Mostrar formulario de creación
    public function create()
    {
        $categories = Category::all();
        return view('products.form', compact('categories'));
    }

    // Guardar nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Producto creado correctamente');
    }

    // Mostrar formulario de edición
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.form', compact('product', 'categories'));
    }

    // Actualizar producto
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    // Eliminar producto
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['success' => 'Producto eliminado']);
    }

    // Datos para DataTables
    public function data()
    {
        $products = Product::with('category')->select('products.*');
        
        return DataTables::of($products)
            ->addColumn('category', function($product) {
                return $product->category->name;
            })
            ->addColumn('actions', function($product) {
                return '
                    <a href="'.route('products.edit', $product).'" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-sm btn-danger delete-btn" 
                            data-id="'.$product->id.'"
                            data-name="'.htmlspecialchars($product->name, ENT_QUOTES).'">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}