<?php
include 'conn.php';
session_start();

if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_email'])) {
    header('location:login.php');
    exit;
}

$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
$user_id = $_SESSION['user_id']; // Assure-toi d'avoir stocké user_id lors de la connexion

if (isset($_GET['logout'])) {
    session_destroy();
    header('location:login.php');
    exit;
}

// Ajouter au panier
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_name'])) {
    $product_name = $_POST['product_name'];
    $product_quantity = $_POST['product_quantity'];
    $product_price = $_POST['product_prix'];
    $product_image = $_POST['product_image'];

    // Vérifier si le produit existe déjà dans le panier de l'utilisateur
    $check_query = "SELECT * FROM cart WHERE user_id = :user_id AND name = :name";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->execute(['user_id' => $user_id, 'name' => $product_name]);
    
    if ($check_stmt->rowCount() > 0) {
        // Mettre à jour la quantité si le produit existe déjà
        $update_query = "UPDATE cart SET quantity = quantity + :quantity WHERE user_id = :user_id AND name = :name";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->execute(['quantity' => $product_quantity, 'user_id' => $user_id, 'name' => $product_name]);
    } else {
        // Sinon, ajouter le produit au panier
        $insert_query = "INSERT INTO cart (user_id, name, quantity, price, image) VALUES (:user_id, :name, :quantity, :price, :image)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->execute([
            'user_id' => $user_id,
            'name' => $product_name,
            'quantity' => $product_quantity,
            'price' => $product_price,
            'image' => $product_image
        ]);
    }
}

// Mettre à jour le panier
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];

    $update_query = "UPDATE cart SET quantity = :quantity WHERE id = :cart_id AND user_id = :user_id";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->execute([
        'quantity' => $cart_quantity,
        'cart_id' => $cart_id,
        'user_id' => $user_id
    ]);
}

// Supprimer un produit du panier
if (isset($_GET['remove'])) {
    $cart_id = $_GET['remove'];

    $remove_query = "DELETE FROM cart WHERE id = :cart_id AND user_id = :user_id";
    $remove_stmt = $conn->prepare($remove_query);
    $remove_stmt->execute([
        'cart_id' => $cart_id,
        'user_id' => $user_id
    ]);
}

// Supprimer tous les produits du panier
if (isset($_GET['delete_all'])) {
    $delete_all_query = "DELETE FROM cart WHERE user_id = :user_id";
    $delete_all_stmt = $conn->prepare($delete_all_query);
    $delete_all_stmt->execute(['user_id' => $user_id]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="user-profile">
            <p>Username: <span><?php echo htmlspecialchars($user_name); ?></span></p>
            <p>Email: <span><?php echo htmlspecialchars($user_email); ?></span></p>
            <div class="flex">
                <a href="login.php" class="btn">Login</a>
                <a href="register.php" class="option-btn">Register</a>
                <a href="?logout=true" onclick="return confirm('Are you sure you want to logout?');" class="delete-btn">Logout</a>
            </div>
        </div>
    </div>

    <div class="produits">
        <h1 class="heading">Latest Products</h1>
        <div class="box-container">
            <?php
            $REQ = "SELECT * FROM produits";
            $RES = $conn->query($REQ);
            $tab = $RES->fetchAll(PDO::FETCH_ASSOC);
            foreach ($tab as $ligne) {
            ?>
            <form method="post" class="box" action="">
                <img src="images/<?php echo htmlspecialchars($ligne['image']); ?>" height="100" alt="">
                <div class="name"><?php echo htmlspecialchars($ligne['name']); ?></div>
                <div class="prix"><?php echo htmlspecialchars($ligne['price']); ?></div>
                <input type="number" min="1" name="product_quantity" value="1">
                <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($ligne['image']); ?>">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($ligne['name']); ?>">
                <input type="hidden" name="product_prix" value="<?php echo htmlspecialchars($ligne['price']); ?>">
                <input type="submit" value="Add to Cart" class="btn">
            </form>
            <?php } ?>
        </div>
    </div>

    <div class="shopping-cart">
        <h1 class="heading">Shopping Cart</h1>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cart_query = "SELECT * FROM cart WHERE user_id = :user_id";
                $stmt = $conn->prepare($cart_query);
                $stmt->execute(['user_id' => $user_id]);
                $tabl = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $grand_total = 0;

                foreach ($tabl as $ligne) {
                    $sub_total = $ligne['price'] * $ligne['quantity'];
                    $grand_total += $sub_total;
                ?>
                <tr>
                    <td><img src="images/<?php echo htmlspecialchars($ligne['image']); ?>" height="100" alt=""></td>
                    <td><?php echo htmlspecialchars($ligne['name']); ?></td>
                    <td><?php echo htmlspecialchars($ligne['price']); ?>/-</td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $ligne['id']; ?>">
                            <input type="number" min="1" name="cart_quantity" value="<?php echo htmlspecialchars($ligne['quantity']); ?>">
                            <input type="submit" name="update_cart" value="Update" class="option-btn">
                        </form>
                    </td>
                    <td><?php echo $sub_total; ?></td>
                    <td><a href="index.php?remove=<?php echo $ligne['id']; ?>" class="delete-btn" onclick="return confirm('Remove item from cart?');">Remove</a></td>
                </tr>
                <?php } ?>
                <tr class="table-bottom">
                    <td colspan="4">Grand Total:</td>
                    <td>$<?php echo $grand_total; ?>/-</td>
                    <td><a href="index.php?delete_all" onclick="return confirm('Delete all from cart?');" class="delete-btn <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>">Delete All</a></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
