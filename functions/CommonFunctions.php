<?php

use Symfony\Component\VarDumper\VarDumper;

class Query
{
    public static function fetchAllProducts()
    {
        global $connect;
        $product_query = "SELECT * FROM products WHERE product_status=1 ORDER BY rand()";
        $fetch_query = mysqli_query($connect, $product_query);

        if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {

                while ($row = mysqli_fetch_assoc($fetch_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description  = $row['product_description'];
                    $product_keywords = $row['product_keywords'];
                    $product_price = $row['product_price'];
                    $product_brand = $row['brand_id'];
                    $product_categories = $row['category_id'];
                    $product_img1 = $row['product_img1'];

                    echo ("<div class='col-md-4'>
                        <div class='card text-center'>
                            <div class='card-body'>
                                <img src='./admin_area/insert/product_img/$product_img1' class='card-img-top' alt='>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>
                                    $product_description
                                </p>
                                <a href='/display_all.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart <i class='fa-solid fa-cart-plus'></i></a>
                                <a href='/product_detail.php?product=$product_id&category=$product_categories&brand=$product_brand' class='btn btn-secondary'>View More</a>
                            </div>
                        </div>
                    </div>");
                }
            } else {
                static::fetchByBrands();
            }
        } else {
            static::fetchByCatagories();
        }
    }

    public static function fetchProducts()
    {
        global $connect;
        $product_query = "SELECT * FROM products  WHERE product_status<>0 AND product_status=1 ORDER BY rand() LIMIT 0,9";
        $fetch_query = mysqli_query($connect, $product_query);

        if (!isset($_GET['search_data'])) {
            if (!isset($_GET['category'])) {
                if (!isset($_GET['brand'])) {

                    while ($row = mysqli_fetch_assoc($fetch_query)) {
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_description  = $row['product_description'];
                        $product_keywords = $row['product_keywords'];
                        $product_price = $row['product_price'];
                        $product_brand = $row['brand_id'];
                        $product_categories = $row['category_id'];
                        $product_img1 = $row['product_img1'];

                        echo ("<div class='col-md-4'>
                        <div class='card text-center'>
                            <div class='card-body'>
                                <img src='./admin_area/insert/product_img/$product_img1' class='card-img-top' alt='>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>
                                    $product_description
                                </p>
                                <a href='/index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart <i class='fa-solid fa-cart-plus'></i></a>
                                <a href='/product_detail.php?product=$product_id&category=$product_categories&brand=$product_brand' class='btn btn-secondary'>View More</a>
                            </div>
                        </div>
                    </div>");
                    }
                } else {
                    static::fetchByBrands();
                }
            } else {
                static::fetchByCatagories();
            }
        } else {
            static::fetchBySearch();
        }
    }

    public static function fetchByCatagories()
    {
        $category_id = $_GET['category'];
        global $connect;
        $product_query = "SELECT * FROM products WHERE category_id=$category_id AND product_status=1";
        $fetch_query = mysqli_query($connect, $product_query);


        if (isset($category_id)) {
            if (mysqli_num_rows($fetch_query) == 0) {
                echo "<h3 class='text-center text-warning'>No items with this category";
                return;
            }
            while ($row = mysqli_fetch_assoc($fetch_query)) {

                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description  = $row['product_description'];
                $product_keywords = $row['product_keywords'];
                $product_price = $row['product_price'];
                $product_brand = $row['brand_id'];
                $product_categories = $row['category_id'];
                $product_img1 = $row['product_img1'];

                echo ("<div class='col-md-4'>
                    <div class='card text-center'>
                        <div class='card-body'>
                            <img src='./admin_area/insert/product_img/$product_img1' class='card-img-top' alt='>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>
                                $product_description
                            </p>
                            <a href='/index.php?category=$category_id&add_to_cart=$product_id' class='btn btn-info'>Add to Cart <i class='fa-solid fa-cart-plus'></i></a>
                            <a href='/product_detail.php?product=$product_id&category=$product_categories&brand=$product_brand' class='btn btn-secondary'>View More</a>
                        </div>
                    </div>
                </div>");
            }
        }
    }

    public static function fetchByBrands()
    {
        $brand_id = $_GET['brand'];
        global $connect;
        $product_query = "SELECT * FROM products WHERE brand_id=$brand_id AND product_status=1";
        $fetch_query = mysqli_query($connect, $product_query);

        if (mysqli_num_rows($fetch_query) == 0) {
            echo "<h3 class='text-center text-warning'>No items with this brand";
            return;
        }

        if (isset($brand_id)) {
            while ($row = mysqli_fetch_assoc($fetch_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description  = $row['product_description'];
                $product_keywords = $row['product_keywords'];
                $product_price = $row['product_price'];
                $product_brand = $row['brand_id'];
                $product_categories = $row['category_id'];
                $product_img1 = $row['product_img1'];

                echo ("<div class='col-md-4'>
                    <div class='card text-center'>
                        <div class='card-body'>
                            <img src='./admin_area/insert/product_img/$product_img1' class='card-img-top' alt='>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>
                                $product_description
                            </p>
                            <a href='/index.php?brand=$brand_id&add_to_cart=$product_id' class='btn btn-info'>Add to Cart <i class='fa-solid fa-cart-plus'></i></a>
                            <a href='/product_detail.php?product=$product_id&category=$product_categories&brand=$product_brand' class='btn btn-secondary'>View More</a>
                        </div>
                    </div>
                </div>");
            }
        }
    }


    public static function fetchBySearch()
    {
        $searching = $_GET['data_searching'];
        $search = $_GET['search_data'];
        global $connect;
        $product_query = "SELECT * FROM products WHERE product_keywords LIKE '%$search%' AND product_status=1";
        $fetch_query = mysqli_query($connect, $product_query);


        if (isset($searching)) {
            if (mysqli_num_rows($fetch_query) == 0) {
                echo "<h3 class='text-center text-warning'>No items with this keywords";
                return;
            }
            while ($row = mysqli_fetch_assoc($fetch_query)) {

                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description  = $row['product_description'];
                $product_keywords = $row['product_keywords'];
                $product_price = $row['product_price'];
                $product_brand = $row['brand_id'];
                $product_categories = $row['category_id'];
                $product_img1 = $row['product_img1'];

                echo ("<div class='col-md-4'>
                    <div class='card text-center'>
                        <div class='card-body'>
                            <img src='./admin_area/insert/product_img/$product_img1' class='card-img-top' alt='>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>
                                $product_description
                            </p>
                            <a href='/index.php?search_data=$search&data_searching=Search&add_to_cart=$product_id' class='btn btn-info'>Add to Cart <i class='fa-solid fa-cart-plus'></i>
                            </a>
                            <a href='/product_detail.php?product=$product_id&category=$product_categories&brand=$product_brand' class='btn btn-secondary'>View More</a>
                        </div>
                    </div>
                </div>");
            }
        }
    }

    public static function showProductDetail()
    {
        $show_id = $_GET['product'];
        global $connect;
        $product_query = "SELECT * FROM products WHERE product_id=$show_id AND product_status=1";
        $fetch_query = mysqli_query($connect, $product_query);

        if (isset($show_id)) {
            while ($row = mysqli_fetch_assoc($fetch_query)) {

                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description  = $row['product_description'];
                $product_keywords = $row['product_keywords'];
                $product_price = $row['product_price'];
                $product_brand = $row['brand_id'];
                $product_categories = $row['category_id'];
                $product_img1 = $row['product_img1'];
                $product_img2 = $row['product_img2'];
                $product_img3 = $row['product_img3'];

                echo ("<div class='card'>
                        <div id='carouselExampleIndicators' class='carousel slide'>
                            <div class='carousel-indicators bg-success'>
                                <button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>
                                <button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='1' aria-label='Slide 2'></button>
                                <button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='2' aria-label='Slide 3'></button>
                            </div>
                            <div class='carousel-inner p-5'>
                                <div class='carousel-item active'>
                                    <img src='./admin_area/insert/product_img/$product_img1' class='d-block w-100' alt='...'>
                                </div>
                                <div class='carousel-item'>
                                    <img src='./admin_area/insert/product_img/$product_img2' class='d-block w-100' alt='...'>
                                </div>
                                <div class='carousel-item'>
                                    <img src='./admin_area/insert/product_img/$product_img3' class='d-block w-100' alt='...'>
                                </div>
                            </div>
                            <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='prev'>
                                <span class='bg-info carousel-control-prev-icon' aria-hidden='true'></span>
                                <span class='visually-hidden'>Previous</span>
                            </button>
                            <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='next'>
                                <span class='bg-info carousel-control-next-icon' aria-hidden='true'></span>
                                <span class='visually-hidden'>Next</span>
                            </button>
                        </div>
                        <div class='card-body text-center'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'> $product_description</p>
                            <h3 class='text-success'>Price : $ {$product_price}</h3>
                            <a href='/product_detail.php?product=$show_id&category=$product_categories&brand=$product_brand&add_to_cart=$product_id' class='btn btn-info'>Add to Cart <i class='fa-solid fa-cart-plus'></i>
                            </a>
                        </div>
                    </div>");
            }
        }
    }

    public static function showRelatedProduct()
    {
        $product = $_GET['product'];
        $brand = $_GET['brand'];
        $category = $_GET['category'];
        global $connect;
        $product_query = "SELECT * FROM products WHERE product_id<>$product AND (brand_id=$brand OR category_id=$category) AND product_status=1 LIMIT 0,5";
        $fetch_query = mysqli_query($connect, $product_query);


        if (!isset($brand) && !isset($category)) {
            echo "<h1>No Related Products found</h1>";
            return;
        }
        if (mysqli_num_rows($fetch_query) == 0) {
            echo "<h3 class='text-center text-warning'>No items with this keywords";
            return;
        }
        while ($row = mysqli_fetch_assoc($fetch_query)) {

            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description  = $row['product_description'];
            $product_keywords = $row['product_keywords'];
            $product_price = $row['product_price'];
            $product_brand = $row['brand_id'];
            $product_categories = $row['category_id'];
            $product_img1 = $row['product_img1'];

            echo ("<div class='col-md-12 col-sm-6 col-12 mb-3'>
                    <div class='card text-center'>
                        <div class='card-body'>
                            <img src='./admin_area/insert/product_img/$product_img1' class='card-img-top' alt='>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>
                                $product_description
                            </p>
                            <a href='/product_detail.php?product=$product&category=$category&brand=$brand&add_to_cart=$product_id' class='btn btn-info'>Add to Cart <i class='fa-solid fa-cart-plus'></i>
                            </a>
                            <a href='/product_detail.php?product=$product_id&category=$product_categories&brand=$product_brand' class='btn btn-secondary'>View More</a>
                        </div>
                    </div>
                </div>");
        }
    }

    public static function fetchBrands()
    {
        global $connect;
        $get_brands = "SELECT * FROM brands";
        $result_brands = mysqli_query($connect, $get_brands);

        while ($row_data = mysqli_fetch_assoc($result_brands)) {
            $brand_title = $row_data['brand_title'];
            $brand_id = $row_data['brand_id'];

            echo "<li class='nav-item bg-info border-bottom border-secondary'>
                        <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
                    </li>";
        }
    }

    public static function fetchCategories()
    {
        global $connect;
        $get_categories = "SELECT * FROM categories";
        $result_categories = mysqli_query($connect, $get_categories);

        while ($row_data = mysqli_fetch_assoc($result_categories)) {
            $category_title = $row_data['category_title'];
            $category_id = $row_data['category_id'];

            echo "<li class='nav-item bg-secondary border-bottom'><a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a></li>";
        }
    }

    public static function getIPAddress()
    {
        //whether ip is from the share internet  
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from the remote address  
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public static function addToCart()
    {
        if (!isset($_GET['add_to_cart'])) {
            return;
        }
        $cartItemId = $_GET['add_to_cart'];
        $ip = static::getIPAddress();

        global $connect;
        $product_query = "SELECT * FROM cart_details WHERE product_id='$cartItemId' AND ip_address='$ip'";

        $fetch_query = mysqli_query($connect, $product_query);

        if (mysqli_num_rows($fetch_query) > 0) {
            echo "<script>alert('This Item is already added to your cart')</script>";
        } else {
            $insert_query = "INSERT INTO cart_details (product_id, ip_address, quantity) VALUES ('$cartItemId', '$ip', 0)";
            // Check if the query was successful
            if (mysqli_query($connect, $insert_query)) {
                echo "<script>alert('Item is added successfully.')</script>";
            } else {
                // If there was an error, print the error message
                echo "Error: " . mysqli_error($connect);
            }
        }
    }

    public static function showCartNum()
    {
        if (isset($_GET['add_to_cart'])) {
            $ip = static::getIPAddress();
            global $connect;
            $product_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
            $fetch_query = mysqli_query($connect, $product_query);
            $num_of_product = mysqli_num_rows($fetch_query);
        } else {
            $ip = static::getIPAddress();
            global $connect;
            $product_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
            $fetch_query = mysqli_query($connect, $product_query);
            $num_of_product = mysqli_num_rows($fetch_query);
        }
        echo $num_of_product;
    }

    public static function showTotalCart()
    {
        $total_amount = 0;
        global $connect;
        $ip = static::getIPAddress();
        $user_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
        $user_cart = mysqli_query($connect, $user_query);

        while ($cart_row = mysqli_fetch_array($user_cart)) {
            $product_id = $cart_row['product_id'];
            $product_quantity = $cart_row['quantity'];
            $product_query = "SELECT * FROM products WHERE product_id='$product_id'";
            $product_detail = mysqli_query($connect, $product_query);
            while ($product_row = mysqli_fetch_array($product_detail)) {
                $product_price = $product_row['product_price'] * $product_quantity;
                $total_amount += $product_price;
            }
        }
        echo $total_amount;
    }

    public static function checkCart()
    {
        $total_amount = 0;
        global $connect;
        $ip = static::getIPAddress();
        $user_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
        $user_cart = mysqli_query($connect, $user_query);

        while ($cart_row = mysqli_fetch_array($user_cart)) {
            $product_id = $cart_row['product_id'];
            $product_quantity = $cart_row['quantity'];
            $product_query = "SELECT * FROM products WHERE product_id='$product_id'";
            $product_detail = mysqli_query($connect, $product_query);
            while ($product_row = mysqli_fetch_array($product_detail)) {
                $product_price = $product_row['product_price'] * $product_quantity;
                $total_amount += $product_price;
            }
        }
        return $total_amount;
    }

    public static function showCartTable()
    {
        global $connect;
        $ip = static::getIPAddress();
        $user_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
        $user_cart = mysqli_query($connect, $user_query);
        if (mysqli_num_rows($user_cart) <= 0) {
            $output = "<tr>
            <td colspan='7'><h2 class='text-center'>No Item in cart</h2></td>
        </tr>";
            echo $output;
        } else {
            while ($cart_row = mysqli_fetch_array($user_cart)) {
                $product_id = $cart_row['product_id'];
                $product_quantity = $cart_row['quantity'];
                $product_query = "SELECT * FROM products WHERE product_id='$product_id'";
                $product_detail = mysqli_query($connect, $product_query);
                while ($product_row = mysqli_fetch_array($product_detail)) {
                    $product_title = $product_row['product_title'];
                    $product_img = $product_row['product_img1'];
                    $product_price = $product_row['product_price'];
                    $product_brand = $product_row['brand_id'];
                    $product_category = $product_row['category_id'];
                    $total_price = $product_price * $product_quantity;
                    $output = "<tr>
                <td>$product_title</td>
                <td><a href='/product_detail.php?product=$product_id&category=$product_category&brand=$product_brand'><img class='cart-img' src='admin_area/insert/product_img/$product_img' alt=''></a></td>
                <td>$ $product_price</td>
                <td><input type='number' min='0' name='product_quantity[$product_id]' id='' value='$product_quantity'></td>
                <td>$ $total_price</td>
                <td><input class='btn btn-primary' type='submit' value='update'></td>
                <td><a href='cart.php?removeId=$product_id' class='btn btn-danger'>remove</a></td>
            </tr>";
                }
                echo $output;
            }
        }
    }

    public static function showPaymentTable()
    {
        global $connect;
        $ip = static::getIPAddress();
        $user_query = "SELECT * FROM cart_details WHERE ip_address='$ip' AND quantity>0";
        $user_cart = mysqli_query($connect, $user_query);
        if (mysqli_num_rows($user_cart) <= 0) {
            $output = "<tr>
            <td colspan='7'><h2 class='text-center'>No Item in cart</h2></td>
        </tr>";
            echo $output;
        } else {
            while ($cart_row = mysqli_fetch_array($user_cart)) {
                $product_id = $cart_row['product_id'];
                $product_quantity = $cart_row['quantity'];
                $product_query = "SELECT * FROM products WHERE product_id='$product_id'";
                $product_detail = mysqli_query($connect, $product_query);
                while ($product_row = mysqli_fetch_array($product_detail)) {
                    $product_title = $product_row['product_title'];
                    $product_img = $product_row['product_img1'];
                    $product_price = $product_row['product_price'];
                    $product_brand = $product_row['brand_id'];
                    $product_category = $product_row['category_id'];
                    $total_price = $product_price * $product_quantity;
                    $output = "<tr>
                <td>$product_title</td>
                <td><a href='/product_detail.php?product=$product_id&category=$product_category&brand=$product_brand'><img class='cart-img' src='admin_area/insert/product_img/$product_img' alt=''></a></td>
                <td>$ $product_price</td>
                <td><input type='number' style='width:10ch;' min='0' name='product_quantity[$product_id]' id='' value='$product_quantity'></td>
                <td>$ $total_price</td>
                <td><input class='btn btn-primary' type='submit' value='update'></td>
                <td><a href='cart.php?removeId=$product_id' class='btn btn-danger'>remove</a></td>
            </tr>";
                }
                echo $output;
            }
        }
    }

    public static function orderIdQtyArr()
    {
        global $connect;
        $ip = static::getIPAddress();
        $user_query = "SELECT * FROM cart_details WHERE ip_address='$ip' AND quantity>0";
        $user_cart = mysqli_query($connect, $user_query);


        while ($cart_row = mysqli_fetch_array($user_cart)) {
            $product_id = $cart_row['product_id'];
            $product_quantity = $cart_row['quantity'];

            $product_id_arr[] = $product_id;
            $product_qty_arr[] = $product_quantity;
        }
        return array($product_id_arr, $product_qty_arr);
    }

    public static function updateProductQty($dir)
    {
        if (!isset($_GET['product_quantity'])) {
            return;
        }

        $product_quantities = $_GET['product_quantity'];

        global $connect;
        $ip = static::getIPAddress();

        foreach ($product_quantities as $product_id => $product_quantity) {
            $user_query = "UPDATE cart_details SET quantity='$product_quantity' WHERE ip_address='$ip' AND product_id='$product_id'";
            $user_cart = mysqli_query($connect, $user_query);
        }

        echo "<script>location.href = '/$dir'</script>";
    }

    public static function removeCartItemByOne($dir)
    {
        if (!isset($_GET['removeId'])) {
            return;
        }

        $product_id = $_GET['removeId'];

        global $connect;
        $ip = static::getIPAddress();


        $user_query = "DELETE FROM `cart_details` WHERE ip_address='$ip' AND product_id='$product_id'";
        $user_cart = mysqli_query($connect, $user_query);


        echo "<script>location.href = '/$dir'</script>";
    }

    public static function removeAllCart($product_id_arr = [])
    {
        global $connect;
        $ip = static::getIPAddress();
        foreach ($product_id_arr as $product_id) {
            $remove_query = "DELETE FROM `cart_details` WHERE ip_address='$ip' AND product_id='$product_id' AND quantity>0";
            $result = mysqli_query($connect, $remove_query);
        }
    }

    public static function userSessionStatus()
    {
        global $connect;
        $user_img = 'default.jpg';
        if (isset($_SESSION['username']) && isset($_SESSION['userid'])) {
            $userid = $_SESSION['userid'];
            $username = $_SESSION['username'];
            $user_query = "SELECT * FROM user_info WHERE user_id=$userid AND user_name='$username'";
            $user_result = mysqli_query($connect, $user_query);
            if ($data = mysqli_fetch_assoc($user_result)) {
                $user_img = $data['user_img'];
            } else {
                $user_img = 'default.jpg';
            }
            echo "<li class='nav-item'>
            <a href='profileController.php?orders' class='nav-link'>Welcome $username</a>
        </li>
        <li class='nav-item'> 
        <a href='profileController.php?orders' class='nav-link'><img style='width:55px; height:55px;border:5px solid #a39;border-radius:50%;' src='user_area/user_imgs/$user_img'/></a>
        </li>
        <li class='nav-item'>
            <a href='user_area/logout.php' class='nav-link'>Logout</a>
        </li>
        ";
        } else {
            echo "<li class='nav-item'>
            <a href='profileController.php' class='nav-link'>Welcome Guest</a>
        </li>
        <li class='nav-item'> 
        <a href='profileController.php' class='nav-link'><img style='width:60px; height:60px;border-radius:50%;' src='user_area/user_imgs/$user_img'/></a>
        </li>
        <li class='nav-item'>
            <a href='userController.php?login=1' class='nav-link'>Login</a>
        </li>
        ";
        }
    }

    public static function pendingOrderTable($order_id, $product_id_arr, $product_price_arr, $product_qty_arr)
    {
        global $connect;
        $no = 1;
        foreach ($product_id_arr as $idx => $product_id) {
            $product_name_query = "SELECT * FROM products WHERE product_id='$product_id'";
            $product_name_result = mysqli_query($connect, $product_name_query);
            $product_name_row = mysqli_fetch_assoc($product_name_result);
            $product_name = $product_name_row['product_title'];
            $product_price = $product_price_arr[$idx];
            $product_qty = $product_qty_arr[$idx];
            $amount = $product_price * $product_qty;
            $no += $idx;
            echo "<tr>
            <td>{$no}</td>
            <td>{$product_name}</td>
            <td><input type='text' name='product_price_new_arr[]' value='{$product_price}' readonly class='price'></td>
            <td><input type='number' min='1' name=' product_qty_new_arr[]' id='' class='quantity' value='{$product_qty}'></td>
            <td><input type='text' class='amount' name='product_amount_new_arr[]' value='{$amount}' readonly id=''></td>
            <td><a href='orderController.php?edit&orderid=$order_id&removeid=$product_id' class='btn btn-danger'>Remove</a></td>
        </tr>    <input type='hidden' name='product_id_new_arr[]' value='{$product_id}'>";
        }
    }

    public static function showingOrderTable($order_id, $product_id_arr, $product_price_arr, $product_qty_arr)
    {
        global $connect;
        $no = 1;
        foreach ($product_id_arr as $idx => $product_id) {
            $product_name_query = "SELECT * FROM products WHERE product_id='$product_id'";
            $product_name_result = mysqli_query($connect, $product_name_query);
            $product_name_row = mysqli_fetch_assoc($product_name_result);
            $product_name = $product_name_row['product_title'];
            $product_price = $product_price_arr[$idx];
            $product_qty = $product_qty_arr[$idx];
            $amount = $product_price * $product_qty;
            $no += $idx;
            echo "<tr>
            <td>{$no}</td>
            <td>{$product_name}</td>
            <td><input type='text'value='{$product_price}' readonly></td>
            <td><input type='number' value='{$product_qty}' readonly></td>
            <td><input type='text' value='{$amount}' readonly id=''></td>
        </tr>";
        }
    }

    public static function redirectHomeBySession($bool = 1)
    {
        if ($bool == 1) {
            if (isset($_SESSION['username'])) {
                header('Location:/');
            }
        } else if ($bool == 0) {
            if (!isset($_SESSION['username'])) {
                header('Location:/');
            }
        }
    }
}
