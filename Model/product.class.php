<?php 
class product
{
    private $product_id;
    private $product_name;
    private $price;
    private $image;
    private $category;
    
    public function setProductName($_name)
    {
        $this->product_name = $_name;
    }
    public function getProductName()
    {
        return $this->product_name;
    }
    public function setProductPrice($price)
    {
        $this->price = $price ;

    }
    public function getProductPrice()
    {
        $this->price;
    }
    public function setProductImage($img)
    {
        $this->image =$img;
    }
    public function getProductImage()
    {
        return $this->image ;
    }
    public function setProductCategory($cat)
    {
        $this->category = $cat;
    }
    public function getProductCategory()
    {
        return $this->category;
    }
    public function addProduct($name ,$price,$cat,$pic)
    {

        global $db;
        // var_dump($pic);
        $result = mysqli_query($db,"insert into products(product_name,price,category,image) values('{$name}',{$price},'{$cat}','{$pic}')");
        return $result;
    }
    public function listAllProducts()
    {
        global $db;
        $result = mysqli_query($db,"select * from products");
        return $result;
    }

}


?>