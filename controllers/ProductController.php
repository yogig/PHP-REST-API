<?php
class ProductController {
    private $product;

    public function __construct($product) {
        $this->product = $product;
    }

    public function getProducts() {
        $stmt = $this->product->read();
        $num = $stmt->rowCount();

        if($num > 0) {
            $products_arr = array();
            $products_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $product_item = array(
                    "id" => $id,
                    "name" => $name,
                    "description" => $description,
                    "price" => $price,
                    "category" => $category,
                    "created_at" => $created_at
                );
                array_push($products_arr["records"], $product_item);
            }

            http_response_code(200);
            echo json_encode($products_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "No products found."));
        }
    }

    public function getProduct($id) {
        $this->product->id = $id;

        if($this->product->readOne()) {
            $product_arr = array(
                "id" => $this->product->id,
                "name" => $this->product->name,
                "description" => $this->product->description,
                "price" => $this->product->price,
                "category" => $this->product->category,
                "created_at" => $this->product->created_at
            );

            http_response_code(200);
            echo json_encode($product_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "Product not found."));
        }
    }

    public function createProduct() {
        $data = json_decode(file_get_contents("php://input"));

        if(!empty($data->name) && !empty($data->price) && !empty($data->category)) {
            $this->product->name = $data->name;
            $this->product->description = $data->description ?? '';
            $this->product->price = $data->price;
            $this->product->category = $data->category;

            if($this->product->create()) {
                http_response_code(201);
                echo json_encode(array("message" => "Product was created."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Unable to create product."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
        }
    }

    public function updateProduct($id) {
        $data = json_decode(file_get_contents("php://input"));

        $this->product->id = $id;
        $this->product->name = $data->name;
        $this->product->description = $data->description ?? '';
        $this->product->price = $data->price;
        $this->product->category = $data->category;

        if($this->product->update()) {
            http_response_code(200);
            echo json_encode(array("message" => "Product was updated."));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Unable to update product."));
        }
    }

    public function deleteProduct($id) {
        $this->product->id = $id;

        if($this->product->delete()) {
            http_response_code(200);
            echo json_encode(array("message" => "Product was deleted."));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Unable to delete product."));
        }
    }
}
?>
