document.addEventListener('readystatechange', docReady => {
    if (docReady.target.readyState === 'complete') {
        const collapsables = document.getElementsByClassName('collapsable');

        for (i = 0; i < collapsables.length; i++) {
            const collapsableIndex = i;
            const collapsable = collapsables.item(collapsableIndex);
            const id = collapsable.hash.slice(1);

            const content = document.getElementById(id);

            content.classList.toggle('is-hidden');

            collapsable.addEventListener('click', clickEvent => {
                clickEvent.preventDefault();

                for (x = 0; x < collapsables.length; x++) {
                    const targetIndex = x;
                    const targetButton = collapsables.item(targetIndex);
                    const targetId = targetButton.hash.slice(1);
                    const targetContent = document.getElementById(targetId);
                    const targetIcon = targetButton.getElementsByTagName('i').item(0);

                    if (targetIndex == collapsableIndex) {
                        targetContent.classList.toggle('is-hidden');
                        targetButton.classList.toggle('is-primary');
                        targetIcon.classList.toggle('fa-arrow-down');
                        targetIcon.classList.toggle('fa-arrow-up');
                    } else {
                        targetContent.classList.toggle('is-hidden', true);
                        targetButton.classList.toggle('is-primary', false);
                        targetIcon.classList.replace('fa-arrow-up', 'fa-arrow-down');
                    }
                }
            });
        }
    }
});
