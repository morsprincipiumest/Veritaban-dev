<?php


//$servername = "localhost";
//$username = "root";
//$password = "";
//$databasename = "vtys_odev";

//$conn = new mysqli($servername,
//$username, $password, $databasename);




//$products = "SELECT * FROM 'urunler';";


$products = array(
  array(
    'name' => 'iPhone 12',
    'category' => 'Elektronik',
    'price' => 799.99,
    'features' => array('A14 Bionic chip', 'Super Retina XDR display', 'Dual-camera system'),
    'image' => 'images/iphone12.jpg'
  ),
  array(
    'name' => 'Samsung Galaxy S21',
    'category' => 'Elektronik',
    'price' => 899.99,
    'features' => array('Exynos 2100 processor', 'Dynamic AMOLED display', 'Triple-camera system'),
    'image' => 'images/galaxys21.jpg'
  ),
  array(
    'name' => 'Sony PlayStation 5',
    'category' => 'Oyun',
    'price' => 499.99,
    'features' => array('AMD Ryzen processor', 'Ultra-High-Speed SSD', 'Ray tracing support'),
    'image' => 'images/ps5.jpg'
  ),
  array(
    'name' => 'Bose QuietComfort 35 II',
    'category' => 'Ses',
    'price' => 299.99,
    'features' => array('Active noise cancellation', 'Wireless Bluetooth connectivity', '20-hour battery life'),
    'image' => 'images/boseqc35ii.jpg'
  ),
  array(
    'name' => 'Canon EOS Rebel T7i',
    'category' => 'Fotoğrafçılık',
    'price' => 799.99,
    'features' => array('24.2MP APS-C CMOS sensor', 'DIGIC 7 image processor', 'Dual Pixel CMOS AF'),
    'image' => 'images/canonrebelt7i.jpg'
  ),
);



$searchTerm = $_GET['search'] ?? '';
$sortBy = $_GET['sort'] ?? 'name';

// Filter products based on search term
$filteredProducts = array_filter($products, function($product) use ($searchTerm) {
  $productName = strtolower($product['name']);
  return strpos($productName, strtolower($searchTerm)) !== false;
});

// Sort products based on the selected sorting option
if ($sortBy === 'price') {
  usort($filteredProducts, function($a, $b) {
    return $a['price'] <=> $b['price'];
  });
} else {
  usort($filteredProducts, function($a, $b) {
    return strcmp($a['name'], $b['name']);
  });
}

// Return the filtered and sorted products as JSON
header('Content-Type: application/json');
echo json_encode($filteredProducts);
