<div class="modal" tabindex="-1" role="dialog" id="thinking">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <?php $sayings = ['Trying to...', 'I got this...', 'One sec...', '#BigFacts...', 'mmmmk...', '"By the rings! Arbiter!"'];?>
        <h5 class="modal-title"><?php echo (rand(0, 50) == 5 ? __($sayings[rand(0, count($sayings) - 1)])  : __('Thinking...')); ?></h5>
      </div>
      <div class="modal-body">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style=""></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $('a, button').not('.dont-think').click(function(e) {
        $('#thinking').modal({
            keyboard: false,
            focus: true,
            show: true,
            backdrop: 'static'
        });
    });
</script>
