<div class="w3-center w3-padding-32">
    <div class="w3-bar">

        <a href="<?= current_url(true)->setQuery("?page=" . ($page - 1)) ?>" class="w3-bar-item w3-button w3-hover-teal <?= $page == 1 ? "w3-disabled" : "" ?>">«</a>

        <?php $chunks = floor($total / $chunk) ?>

        <?php for ($i = 0; $i <  $chunks; $i++) : ?>

            <a href="<?= $page == $i + 1 ? "#" : current_url(true)->setQuery("?page=" . ($i + 1)) ?>" class="w3-bar-item w3-button w3-hover-teal <?= $page == ($i + 1) ? "w3-teal" : "" ?>"><?= $i + 1 ?></a>

        <?php endfor; ?>
        <a href="<?= current_url(true)->setQuery("?page=" .  ($page + 1)) ?>" class="w3-bar-item w3-button w3-hover-teal <?= $page ==  ($chunks + 1) ? "w3-disabled" : "" ?>">»</a>
    </div>
</div>