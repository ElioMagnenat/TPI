<?php if (isset($_SESSION['popup_message'])): ?>
  <div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="popupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content shadow-lg">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="popupModalLabel">Notification</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fermer">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?= htmlspecialchars($_SESSION['popup_message']) ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      $('#popupModal').modal('show');
    });
  </script>

  <?php unset($_SESSION['popup_message']); ?>
<?php endif; ?>
