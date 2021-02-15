
<form method="GET">
    <div class="field has-addons is-horizontal">
        <p class="control has-icons-left is-expanded">
            <input class="input" type="text" name="search" placeholder="Search" value="<?php echo h($_GET['search'] ?? null); ?>">
            <span class="icon is-small is-left">
                <i class="fas fa-search"></i>
            </span>
        </p>
        <p class="control">
            <button type="submit" class="button is-primary">Search</button>
        </p>
    </div>
</form>
