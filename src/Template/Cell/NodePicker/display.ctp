<div class="field node-picker">
    <label class="label">Node Picker</label>
    <div class="field">
        <script type="text/javascript">
            document.addEventListener('readystatechange', docReady => {
                if (docReady.target.readyState === 'complete') {
                    const nodes = document.querySelectorAll('.node-picker .node-picker-node');
                    const inputs = document.querySelectorAll('.node-picker .node-picker-radio');

                    nodes.forEach((v, i, o) => {
                        const icon = v.querySelector('i.fas');
                        v.addEventListener('click', (click) => {
                            if (click.target.tagName.toLowerCase() !== 'input') {
                                click.preventDefault();
                                v.nextElementSibling.classList.toggle('is-hidden');

                                if(icon) {
                                    if (icon.classList.contains('fa-book')) {
                                        icon.classList.replace('fa-book', 'fa-book-open');
                                    } else {
                                        icon.classList.replace('fa-book-open', 'fa-book');
                                    }
                                }
                            }
                        });
                    });

                    inputs.forEach((v, i, o) => {
                        v.addEventListener('change', (change) => {
                            const link = v.closest('.node-picker-node');

                            document.querySelectorAll('.node-picker-node.is-active').forEach((node) => {
                                node.classList.replace('is-active', 'has-text-dark');
                            });

                            if (v.checked) {
                                link.classList.replace('has-text-dark', 'is-active');
                            }
                        });
                    });
                }
            });
        </script>

        <ul class="menu-list">
            <li>
                <?php echo $this->cell('Nodepicker::child', [$nodes, $path, $field]); ?>
            </li>
        </ul>
    </div>
</div>
