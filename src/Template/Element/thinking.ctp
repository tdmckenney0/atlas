<div class="modal thinking">
    <div class="modal-background"></div>
    <div class="modal-content">
        <article class="message is-info">
            <div class="message-header">
                <?php $sayings = ['Trying to...', 'I got this...', 'One sec...', '#BigFacts...', 'mmmmk...', '"By the rings! Arbiter!"'];?>
                <p><?php echo (rand(0, 50) == 5 ? __($sayings[rand(0, count($sayings) - 1)])  : __('Thinking...')); ?></p>
            </div>
            <div class="message-body">
                <progress class="progress is-info" max="100">Unknown</progress>
            </div>
        </article>
    </div>
</div>

<script type="text/javascript">
    window.addEventListener('beforeunload', (event) => {
        document.querySelector('div.modal.thinking').classList.add('is-active');
    });
</script>
