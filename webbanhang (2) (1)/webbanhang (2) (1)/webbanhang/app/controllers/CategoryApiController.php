<?php
require_once 'app/config/database.php';
require_once 'app/models/CategoryModel.php';

class CategoryApiController {
    private CategoryModel $categoryModel;
    private PDO $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    /**
     * Lấy danh sách tất cả các danh mục và trả về dưới dạng JSON.
     *
     * @return void
     */
    public function index(): void {
        header('Content-Type: application/json');
        $categories = $this->categoryModel->getCategories();
        echo json_encode($categories);
    }
}
?>