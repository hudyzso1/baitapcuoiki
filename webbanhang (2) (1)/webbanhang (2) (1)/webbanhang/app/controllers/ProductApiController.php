<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');

class ProductApiController {
    private $productModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    /**
     * Retrieves and returns a list of all products in JSON format.
     */
    public function index() {
        header('Content-Type: application/json');
        $products = $this->productModel->getProducts();
        echo json_encode($products);
    }

    /**
     * Retrieves and returns a single product by its ID in JSON format.
     *
     * @param int $id The product ID.
     */
    public function show($id) {
        header('Content-Type: application/json');
        $product = $this->productModel->getProductById($id);

        if ($product) {
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Product not found']);
        }
    }

    /**
     * Creates a new product from the JSON data in the request body.
     */
    public function store() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);

        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';
        $price = $data['price'] ?? '';
        $categoryId = $data['category_id'] ?? null;

        $result = $this->productModel->addProduct($name, $description, $price, $categoryId);

        if (is_array($result)) {
            http_response_code(400);
            echo json_encode(['errors' => $result]);
        } else {
            http_response_code(201);
            echo json_encode(['message' => 'Product created successfully']);
        }
    }

    /**
     * Updates an existing product by its ID from the JSON data in the request body.
     *
     * @param int $id The product ID.
     */
    public function update($id) {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);

        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';
        $price = $data['price'] ?? '';
        $categoryId = $data['category_id'] ?? null;

        $result = $this->productModel->updateProduct($id, $name, $description, $price, $categoryId);

        if ($result) {
            echo json_encode(['message' => 'Product updated successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Product update failed']);
        }
    }

    /**
     * Deletes a product by its ID.
     *
     * @param int $id The product ID.
     */
    public function destroy($id) {
        header('Content-Type: application/json');
        $result = $this->productModel->deleteProduct($id);

        if ($result) {
            echo json_encode(['message' => 'Product deleted successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Product deletion failed']);
        }
    }
}
?>