<?php if(!empty($nodes)): ?>
    <div class="table-of-contents">
        <script type="text/javascript">
            document.addEventListener('readystatechange', docReady => {
                if (docReady.target.readyState === 'complete') {
                    const nodes = document.querySelectorAll('.table-of-contents .table-of-contents-node');

                    nodes.forEach((v, i, o) => {
                        const icon = v.querySelector('i.fas');
                        v.addEventListener('click', (click) => {
                            // click.preventDefault();
                            v.nextElementSibling.classList.toggle('is-hidden');

                            if(icon) {
                                if (icon.classList.contains('fa-folder')) {
                                    icon.classList.replace('fa-folder', 'fa-folder-open');
                                } else {
                                    icon.classList.replace('fa-folder-open', 'fa-folder');
                                }
                            }
                        });
                    });
                }
            });
        </script>

        <ul class="menu-list">
            <?php echo $this->cell('TableOfContents::child', [$nodes, $path]); ?>
        </ul>
    </div>
<?php endif; ?>
