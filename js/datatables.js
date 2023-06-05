// window.addEventListener("DOMContentLoaded", (event) => {
  // Simple-DataTables
  // https://github.com/fiduswriter/Simple-DataTables/wiki

  const datatablesSimple = document.getElementById("datatablesSimple");
  if (datatablesSimple) {
    new simpleDatatables.DataTable(datatablesSimple);
  }

  // products table
  const productsTable = document.getElementById("productsTable");
  if (productsTable) {
    new simpleDatatables.DataTable(productsTable, {
      searchable: false,
      paging: false,
    });

    const hasAction = document.querySelector('#productsTable > thead:nth-child(1) > tr:nth-child(1) > th:nth-child(7)')

    const inputSearch = `
    <div class="datatable-search">
      <form >
        <input autocomplete="off" name="q" class="datatable-input" placeholder="Search..." type="search" title="Search within table" aria-controls="datatablesSimple">
      </form>
    </div>`;

    if (hasAction) {
      document.querySelector(".datatable-top").innerHTML = `
      <a href="add-product.php" class="btn btn-success">
          <div>
          <i class="fa-solid fa-circle-plus"></i>
          Add product
          </div>
      </a>
      ${inputSearch}
      `
    } else {
      document.querySelector(".datatable-top").innerHTML = inputSearch;
    }

  }
// });
