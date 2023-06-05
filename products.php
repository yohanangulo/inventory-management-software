<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location: signin.php');
  exit;
} 

require_once "./db/db.php";

$kw = isset($_GET['q']) ? mysqli_real_escape_string($conn, $_GET['q']) : '';

if (isset($_GET['q']) && $kw !== $_SESSION['prev_kw']) unset($_SESSION['product_count']); 
$_SESSION['prev_kw'] = isset($_GET['q']) ? $kw : '';

// query base
$query =
"SELECT 
  p.id,
  p.name,
  p.category,
  s.name AS seller_name,
  p.stock,
  pt.type
FROM
  product AS p
    INNER JOIN
  seller AS s ON p.seller_id = s.id
    INNER JOIN
  product_type AS pt ON p.type_id = pt.id
WHERE
  p.name LIKE '%$kw%' OR p.category LIKE '%$kw%'
    OR s.name LIKE '%$kw%'
    OR p.stock LIKE '%$kw%'
    OR pt.type LIKE '%$kw%'
    OR p.id LIKE '%$kw%' "
;

// count products
if (!isset($_SESSION['product_count'])) {

  $count_result = $conn->query("SELECT COUNT(*) as count FROM ($query) AS count_query");
  $row = $count_result->fetch_assoc();
  $product_count = $row['count'];
  $_SESSION['product_count'] = $product_count;

} else {
  $product_count = $_SESSION['product_count'];
}

// set items per page
$items_per_page = 12;

// calculate how many pages are available
$pages_available = ceil($product_count / $items_per_page);
$has_next = false;

if (isset($_GET['p'])) {
  $page = mysqli_real_escape_string($conn, $_GET['p']);
  if (!is_numeric($page)) header('location: products.php');

  $prev_page = $page - 1;
  $item_start = $prev_page * $items_per_page;
  $query = $query . "LIMIT $item_start, $items_per_page";
} else {
  $query = $query . "LIMIT $items_per_page";
}

$result = $conn->query($query);
$conn->close();



if ($pages_available > 1) $has_next = (isset($page) && $page == $pages_available) ? false : true; 

?>

<?php require_once "./includes/panel/dashboard_header.php"; ?>
<?php require_once "./includes/panel/dashborad_nav.php"; ?>

<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <?php require_once "./includes/siderbar.php"; ?>
  </div>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <h1 class="mt-4">Products</h1>
        <div class="row">
          <?php require_once "./includes/message.php"; ?>
          <div class="card mb-4 mt-5">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              List of products <?php if (strlen($kw) > 0) { ?> - <b>Showing results for "<?=$kw?>"</b> - <?=$product_count?> results were found <?php } ?>
            </div>
            <div class="card-body">
              <table id="productsTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>seller</th>
                    <th>Stock</th>
                    <th>Type</th>
                    <?php if ($_SESSION['role_id'] == 1 ) { ?> <th>Action</th> <?php } ?> 
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                      <td><?= $row['id'] ?></td>
                      <td><?= $row['name'] ?></td>
                      <td><?= $row['category'] ?></td>
                      <td><?= $row['seller_name'] ?></td>
                      <td><?= $row['stock'] ?></td>
                      <td><?= $row['type'] ?></td>
                      <?php if ($_SESSION['role_id'] == 1 ) { ?> 
                      <td>
                        <div class="d-flex justify-content-center gap-1">
                          <!-- edit -->
                          <a title="Edit" href="./edit-product.php?id=<?= $row['id'] ?>" class="btn btn-secondary btn-sm">
                            <i class="fa-solid fa-pencil"></i>
                          </a>

                          <!-- delete -->
                          <a title="Delete" href="./operations/delete_product.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                          </a>
                        </div>
                      </td>
                      <?php } ?>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php if ($pages_available > 1) { ?>
      <script>
        window.addEventListener('DOMContentLoaded', () => {
          const dataTableBottom = document.querySelector('.datatable-bottom')

          dataTableBottom.innerHTML = <?="`"
          ?><nav aria-label="Page navigation">
            <ul class="pagination mb-0">
              <?php if (!(!isset($page) || $page - 1 == 0)) { ?>
              <li class="page-item">
                <a class="page-link" href="<?=strlen($kw) > 0 ? "?q=$kw&" : "?" ?><?php echo isset($page) ? "p=" . $page - 1 : "p=2" ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <?php } ?>

              <li class="page-item">
                <a
                  class="page-link <?php if (!isset($page) || $page == 1) echo "active" ?>"
                  href="<?=strlen($kw) > 0 ? "?q=$kw&" : "?" ?>p=1"
                >
                  1
                </a>
              </li>

              <?php if (isset($page) and $page > 2) { ?>
              <li class="page-item disabled">
                <a class="page-link" >...</a>
              </li>
              <?php } ?>
              
              <?php if (isset($page) and $page > 1) { ?>
              <li class="page-item">
                <a
                  class="page-link active"
                  href="<?=strlen($kw) > 0 ? "?q=$kw&" : "?" ?>p=<?= $page ?>"
                >
                  <?= $page ?>
                </a>
              </li>
              <?php } ?>

              <?php if ($has_next) { ?>
              <li class="page-item">
                <a class="page-link" href="<?=strlen($kw) > 0 ? "?q=$kw&" : "?" ?><?php echo isset($page) ? "p=" . $page + 1 : "p=2" ?>" aria-lbel="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
              <?php } ?>
            </ul>
          </nav><?="`"?>
        })
      </script>
      <?php } ?>
    </main>
    <?php require_once "./includes/panel/dashboard_footer.php"; ?>
      <script>
        let nextUrl

        document.addEventListener('click', e => {
          if (e.target.tagName === 'A') {
            nextUrl = e.target.href
          }
        })

        window.addEventListener('beforeunload', e => {
          if (nextUrl && !nextUrl.includes('/products.php')) {
            let xhr = new XMLHttpRequest()
            xhr.open('GET', 'includes/unset_product_count.php', false)
            xhr.send()
            console.log('variable session destroyed')
          }
        })
      </script>