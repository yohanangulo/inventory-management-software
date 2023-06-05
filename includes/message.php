<?php if (isset($_SESSION['message'])) { ?>
  <!-- toast -->
  <div class="toast-container position-fixed top-0 end-0 p-3">
    <?php $i = 0; do { ?>
    <div class="toast" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header text-bg-<?=$_SESSION['message_type']?>" style="--bs-bg-opacity: .7">
        <strong class="me-auto"><?=$_SESSION['message_type'] == 'success' ? 'Success' : 'Error'?></strong>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="toast"
          aria-label="Close"
        ></button>
      </div>
      <div class="toast-body"><?=$_SESSION['message']?></div>
    </div>
    <?php $i++; } while ( isset($_SESSION['errors']) && count(($_SESSION['errors'])) > $i ) ?>
  </div>
  <!-- end toast -->
<?php unset($_SESSION['message'], $_SESSION['message_type']); } ?>