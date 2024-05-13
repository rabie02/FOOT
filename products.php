<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



$panierCount = 0;
if (isset($_SESSION['panier'])) {
    $panierCount = count($_SESSION['panier']);
}

require_once('connexion.php');

// Vérifier si le formulaire d'ajout au panier a été soumis
if (isset($_POST['ajouter']) && isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Vérifier si le panier existe dans la session, sinon le créer
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    // Vérifier si le produit est déjà dans le panier
    if (array_key_exists($productId, $_SESSION['panier'])) {
        // Le produit existe déjà dans le panier, augmenter la quantité
        $_SESSION['panier'][$productId]++;
    } else {
        // Le produit n'est pas encore dans le panier, l'ajouter avec une quantité de 1
        $_SESSION['panier'][$productId] = 1;
    }

    // Rediriger vers la page panier.php après avoir ajouté le produit
    header('Location: products.php');
    exit();
}

// Récupérer la catégorie sélectionnée (s'il y a lieu)
$category = '';
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}

// Récupérer le type sélectionné (s'il y a lieu)
$type = '';
if (isset($_GET['type'])) {
    $type = $_GET['type'];
}

// Récupérer le filtre par prix sélectionné (s'il y a lieu)
$priceFilter = '';
if (isset($_GET['price'])) {
    $priceFilter = $_GET['price'];
}

try {
    $connection = new PDO($dsn, $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer la requête SQL en fonction de la catégorie, le type et le filtre par prix sélectionnés
    $sql = "SELECT * FROM product WHERE 1";
    if ($category && $category !== 'all') {
        $sql .= " AND category = :category";
    }
    if ($type && $type !== 'all') {
        $sql .= " AND type = :type";
    }

    // Ajouter le filtre par prix à la requête SQL
    switch ($priceFilter) {
        case 'asc':
            $sql .= " ORDER BY prix ASC";
            break;
        case 'desc':
            $sql .= " ORDER BY prix DESC";
            break;
        case '0-50':
            $sql .= " AND prix >= 0 AND prix <= 50";
            break;
        case '50-100':
            $sql .= " AND prix > 50 AND prix <= 100";
            break;
        case '100-150':
            $sql .= " AND prix > 100 AND prix <= 150";
            break;
        case '150-200':
            $sql .= " AND prix > 150 AND prix <= 200";
            break;
        case '200-500':
            $sql .= " AND prix > 200 AND prix <= 500";
            break;
        case '500+':
            $sql .= " AND prix > 500";
            break;
    }

    $statement = $connection->prepare($sql);
    if ($category && $category !== 'all') {
        $statement->bindParam(':category', $category);
    }
    if ($type && $type !== 'all') {
        $statement->bindParam(':type', $type);
    }
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="card.css">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>Products</title>
</head>
<body>
    <div>
        <?php include 'navbar.php'; ?>
        <a href="panier.php" class="cart-button">
            <span class="cart-count" style="font-size: 15px; color: #ff7831; font-size: 15px; position: absolute; top: -5px; right: 4px;"><?php echo $panierCount; ?></span>
            <i class="fas fa-shopping-cart"></i>
        </a>
    </div>

    <div class="heading" style="background: url(img/bach-1.png) no-repeat">
        <h1>Urbain store</h1>
    </div>
        
        <div class="filter">
        <h1  >filtrer : </h1>
    <div class="dropdownn">
        <h2 class="dropdown-trigger">par catégorie  <i class="fa-solid fa-chevron-down"></i> </h2>
        <div class="dropdown-content">
            <label>
                <input type="checkbox" name="category" value="all" <?php if ($category === '') echo 'checked'; ?>>
                Tous
            </label>
            <label>
                <input type="checkbox" name="category" value="adultes" <?php if ($category === 'adultes') echo 'checked'; ?>>
                Adultes
            </label>
            <label>
                <input type="checkbox" name="category" value="enfants" <?php if ($category === 'enfants') echo 'checked'; ?>>
                Enfants
            </label>
        </div>
    </div>

    <div class="dropdownn">
        <h2 class="dropdown-trigger">par type <i class="fa-solid fa-chevron-down"></i></h2>
        <div class="dropdown-content">
            <label>
                <input type="checkbox" name="type" value="all" <?php if ($type === '') echo 'checked'; ?>>
                Tous
            </label>
            <label>
                <input type="checkbox" name="type" value="ballon" <?php if ($type === 'ballon') echo 'checked'; ?>>
                Ballon
            </label>
            <label>
                <input type="checkbox" name="type" value="tenue" <?php if ($type === 'tenue') echo 'checked'; ?>>
                Tenue de foot
            </label>
            <label>
                <input type="checkbox" name="type" value="gant" <?php if ($type === 'gant') echo 'checked'; ?>>
                Gants de gardien
            </label>
            <label>
                <input type="checkbox" name="type" value="chaussure" <?php if ($type === 'chaussure') echo 'checked'; ?>>
                Chaussure de foot
            </label>
            <label>
                <input type="checkbox" name="type" value="sac" <?php if ($type === 'sac') echo 'checked'; ?>>
                Sac de sport
            </label>
            <label>
                <input type="checkbox" name="type" value="protege" <?php if ($type === 'protege') echo 'checked'; ?>>
                Protège
            </label>
            <label>
                <input type="checkbox" name="type" value="autre" <?php if ($type === 'autre') echo 'checked'; ?>>
                Autre accessoire
            </label>
        </div>
    </div>

    <div class="dropdownn">
        <h2 class="dropdown-trigger">par prix <i class="fa-solid fa-chevron-down"></i></h2>
        <div class="dropdown-content">
            <label>
                <input type="checkbox" name="price" value="asc" <?php if ($priceFilter === 'asc') echo 'checked'; ?>>
                Croissantes
            </label>
            <label>
                <input type="checkbox" name="price" value="desc" <?php if ($priceFilter === 'desc') echo 'checked'; ?>>
                Décroissantes
            </label>
            <label>
                <input type="checkbox" name="price" value="0-50" <?php if ($priceFilter === '0-50') echo 'checked'; ?>>
                De 0 à 50
            </label>
            <label>
                <input type="checkbox" name="price" value="50-100" <?php if ($priceFilter === '50-100') echo 'checked'; ?>>
                De 50 à 100
            </label>
            <label>
                <input type="checkbox" name="price" value="100-150" <?php if ($priceFilter === '100-150') echo 'checked'; ?>>
                De 100 à 150
            </label>
            <label>
                <input type="checkbox" name="price" value="150-200" <?php if ($priceFilter === '150-200') echo 'checked'; ?>>
                De 150 à 200
            </label>
            <label>
                <input type="checkbox" name="price" value="200-500" <?php if ($priceFilter === '200-500') echo 'checked'; ?>>
                De 200 à 500
            </label>
            <label>
                <input type="checkbox" name="price" value="500+" <?php if ($priceFilter === '500+') echo 'checked'; ?>>
                Plus de 500
            </label>
        </div>
    </div>
</div>


    <section class="product">
        <?php foreach ($products as $product): ?>
            <div class="card">
                <img src="img/<?php echo $product['photo']; ?>" alt="<?php echo $product['nom_produit']; ?>">
                <div class="content">
                    <div class="title"><?php echo $product['nom_produit']; ?></div>
                    <div class="price"><?php echo $product['prix']; ?> MAD</div>
                    <div class="description"><?php echo $product['description']; ?></div>
                    <div class="btns">
                        <form action="products.php?id=<?php echo $product['id_product']; ?>" method="post">
                            <button type="submit" name="ajouter" class="btnd"><i class="fa-solid fa-cart-plus"></i></button>
                        </form>
                        <a href="detail.php?afficher=<?php echo $product['id_product']; ?>" class="btnd">Voir Détail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <section class="footer">

<div class="box-container">
    <div class="box">
        <h3>Quick links</h3>
        <a href="index.php"> <i class="fas fa-angle-right"></i> Home</a>
        <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
        <a href="package.php"> <i class="fas fa-angle-right"></i> package</a>
        <a href="book_form.php"> <i class="fas fa-angle-right"></i> Book</a>
    </div>

    <div class="box">
        <h3>Extra links</h3>
        <a href="#"> <i class="fas fa-angle-right"></i> Ask questions</a>
        <a href="#"> <i class="fas fa-angle-right"></i> About us</a>
        <a href="#"> <i class="fas fa-angle-right"></i> Privacy policy</a>
        <a href="#"> <i class="fas fa-angle-right"></i> Term of use</a>
    </div>



    <div class="box">
        <h3>Contact info</h3>
        <a href="#"> <i class="fas fa-phone"></i> +212 65549-5342 </a>
        <a href="#"> <i class="fas fa-phone"></i> +212 65549-5342 </a>
        <a href="#"> <i class="fas fa-envelope"></i> Ahmedad@gmail.com </a>
        <a href="#"> <i class="fas fa-map"></i> Marrakech, Morocco, 102030 </a>
       
    </div>


    <div class="box">
        <h3>Follow us</h3>
        <a href="#"> <i class="fab fa-facebook-f"></i> Facebook </a>
        <a href="#"> <i class="fab fa-instagram"></i> Instagram </a>
        <a href="#"> <i class="fab fa-twitter"></i> Twitter </a>
        <a href="#"> <i class="fab fa-linkedin"></i> Linkedin </a>
    </div>


</div>

<div class="credit">Created by <span>Urbain Foot</span> all right reserved!</div>


</section>

    <script>
        // Gérer la sélection des catégories
        const checkboxesCategory = document.querySelectorAll('input[name="category"]');

        checkboxesCategory.forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                const category = this.value;
                const type = getCheckedType();
                const price = getCheckedPrice();
                window.location.href = `products.php?category=${category}&type=${type}&price=${price}`;
            });
        });

        // Gérer la sélection des types
        const checkboxesType = document.querySelectorAll('input[name="type"]');

        checkboxesType.forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                const type = this.value;
                const category = getCheckedCategory();
                const price = getCheckedPrice();
                window.location.href = `products.php?category=${category}&type=${type}&price=${price}`;
            });
        });

        // Gérer la sélection du filtre par prix
        const radioButtonsPrice = document.querySelectorAll('input[name="price"]');

        radioButtonsPrice.forEach((radioButton) => {
            radioButton.addEventListener('change', function() {
                const price = this.value;
                const category = getCheckedCategory();
                const type = getCheckedType();
                window.location.href = `products.php?category=${category}&type=${type}&price=${price}`;
            });
        });

        // Fonction pour récupérer la catégorie cochée
        function getCheckedCategory() {
            const checkboxes = document.querySelectorAll('input[name="category"]');
            let checkedCategory = '';
            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    checkedCategory = checkbox.value;
                }
            });
            return checkedCategory;
        }

        // Fonction pour récupérer le type coché
        function getCheckedType() {
            const checkboxes = document.querySelectorAll('input[name="type"]');
            let checkedType = '';
            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    checkedType = checkbox.value;
                }
            });
            return checkedType;
        }

        // Fonction pour récupérer le filtre par prix sélectionné
        function getCheckedPrice() {
            const radioButtons = document.querySelectorAll('input[name="price"]');
            let checkedPrice = '';
            radioButtons.forEach((radioButton) => {
                if (radioButton.checked) {
                    checkedPrice = radioButton.value;
                }
            });
            return checkedPrice;
        }
    </script>


</body>
</html>

