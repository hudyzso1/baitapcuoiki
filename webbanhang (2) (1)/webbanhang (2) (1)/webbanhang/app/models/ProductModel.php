<?php
class ProductModel {
    private $conn;
    private $tableName = "product";

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Retrieves all products with their associated category names.
     *
     * @return array|false An array of product objects or false on failure.
     */
    public function getProducts() {
        $query = "SELECT p.id, p.name, p.description, p.price, c.name as categoryName
                  FROM " . $this->tableName . " p
                  LEFT JOIN category c ON p.category_id = c.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Retrieves a product by its ID.
     *
     * @param int $id The product ID.
     * @return object|false The product object or false if not found.
     */
    public function getProductById($id) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Adds a new product to the database.
     *
     * @param string $name The product name.
     * @param string $description The product description.
     * @param float $price The product price.
     * @param int $categoryId The category ID.
     * @return array|bool An array of errors or true on success, false on failure.
     */
    public function addProduct($name, $description, $price, $categoryId) {
        $errors = [];

        if (empty($name)) {
            $errors['name'] = 'Product name cannot be empty.';
        }

        if (empty($description)) {
            $errors['description'] = 'Description cannot be empty.';
        }

        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = 'Invalid price.';
        }

        if (count($errors) > 0) {
            return $errors;
        }

        $query = "INSERT INTO " . $this->tableName . " (name, description, price, category_id)
                  VALUES (:name, :description, :price, :category_id)";

        $stmt = $this->conn->prepare($query);

        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        $categoryId = htmlspecialchars(strip_tags($categoryId));

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $categoryId);

        return $stmt->execute();
    }

    /**
     * Updates an existing product in the database.
     *
     * @param int $id The product ID.
     * @param string $name The product name.
     * @param string $description The product description.
     * @param float $price The product price.
     * @param int $categoryId The category ID.
     * @return bool True on success, false on failure.
     */
    public function updateProduct($id, $name, $description, $price, $categoryId) {
        $query = "UPDATE " . $this->tableName . "
                  SET name = :name, description = :description, price = :price, category_id = :category_id
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        $categoryId = htmlspecialchars(strip_tags($categoryId));

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $categoryId);

        return $stmt->execute();
    }

    /**
     * Deletes a product from the database.
     *
     * @param int $id The product ID.
     * @return bool True on success, false on failure.
     */
    public function deleteProduct($id) {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>