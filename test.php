<script>
        window.addEventListener('DOMContentLoaded', () => {
          const dataTableBottom = document.querySelector('.datatable-bottom')
          console.log(dataTableBottom)

          dataTableBottom.innerHTML = <?="`"
          ?><nav aria-label="Page navigation">
            <ul class="pagination mb-0">
              
              <li class="page-item <?php if (!isset($page)) echo "disabled" ?>">
                <a class="page-link" href="<?php echo isset($page) ? "?p=" . $page - 1 : null ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>

              <li class="page-item">
                <a
                  class="page-link <?php if (!isset($page)) echo "active" ?>"
                  href="<?php echo isset($page) ? "?p=" . $page - 1 : "?p=1" ?>"
                >
                  <?php echo (isset($page)) ? $page - 1 : 1 ?>
                </a>
              </li>

              <li class="page-item <?php if (isset($page)) echo "active" ?>">
                <a
                  class="page-link"
                  href="<?php echo isset($page) ? "?p=" . $page  : "?p=2" ?>"
                >
                  <?php echo (isset($page)) ? $page : 2 ?>
                </a>
              </li>

              <li class="page-item">
                <a
                  class="page-link"
                  href="<?php echo isset($page) ? "?p=" . $page + 1 : "?p=3" ?>"
                >
                  <?php echo (isset($page)) ? $page + 1 : 3  ?>
                </a>
              </li>

              <li class="page-item">
                <a class="page-link" href="<?php echo isset($page) ? "?p=" . $page + 1 : "?p=2" ?>" aria-lbel="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>

            </ul>
          </nav><?="`"?>
        })
      </script>