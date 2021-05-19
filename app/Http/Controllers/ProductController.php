<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController
{
    private $product;

    public function __construct()
    {
        $this->product = new Product;
    }
    
    public function index()
    {
        $products = $this->product->findAll();
        return json_encode(['data' => $products]);
    }

    public function store()
    {
        $data = $_POST;
        
        $this->product->store($data);
        return json_encode(['data' => 'Produto adicionado com sucesso!']);
    }

    public function update($id)
    {
        $_PUT = [];
        parse_str(file_get_contents('php://input'), $_PUT);
        $data = $_PUT;
        
        $this->product->update($id, $data);
        return json_encode(['data' => 'Produto atualizado com sucesso!']);  
    }

    public function destroy($id)
    {
        $this->product->delete($id);
        return json_encode(['data' => 'Produto apagado com sucesso!']);  
    }

    public function show($id)
    {
        $product = $this->product->find($id);
        return json_encode(['data' => $product]);
    }
}