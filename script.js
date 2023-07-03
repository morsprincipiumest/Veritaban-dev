$(document).ready(function() {
  // Load initial product list
  loadProducts();

  // Search functionality
  $('#search').on('input', function() {
    filterProducts();
  });

  // Sort functionality
  $('#sort').on('change', function() {
    filterProducts();
  });

  function loadProducts() {
    // Make an AJAX request to fetch the product data
    $.ajax({
      url: 'products.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        displayProducts(data);
      },
      error: function
      () {
        alert('Ürünleri filtrelerken hata oldu');
      }
    });
  }

  function displayProducts(products) {
    var productList = $('#product-list');
    productList.empty();

    $.each(products, function(index, product) {
      var productItem = $('<div class="product-card">');
      var productImage = $('<div class="product-image">');
      productImage.append('<img src="' + product.image + '" alt="' + product.name + '">');
      productItem.append(productImage);
      productItem.append('<h3 class="product-name">' + product.name + '</h3>');
      productItem.append('<p class="product-price">' + product.price.toFixed(2) + '₺</p>');
      productItem.append('<p class="product-category">Kategori: ' + product.category + '</p>');
      productItem.append('<p class="product-features">Özellikler: ' + product.features + '</p>');
      productList.append(productItem);
    });
  }

  function filterProducts() {
    var searchTerm = $('#search').val().toLowerCase();
    var sortBy = $('#sort').val();

    // Make an AJAX request to filter and sort the product data
    $.ajax({
      url: 'products.php',
      type: 'GET',
      dataType: 'json',
      data: {
        search: searchTerm,
        sort: sortBy
      },
      success: function(data) {
        displayProducts(data);
      },
      error: function() {
        alert('Ürünleri filtrelerken hata oldu');
      }
    });
  }
});
