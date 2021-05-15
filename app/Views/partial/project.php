<div class="project-item w3-padding-small w3-show-inline-block" data-slug="<?= $project ?>">
    <a href="<?= root_url($project) ?>" target="_blank">
        <img src="<?= assets_url("img/place-holder.png") ?>" alt="Place Holder" style="width:100%; min-height:150px" class="project-screenshot w3-hover-opacity">
        <div class="w3-container w3-white">
            <p class="project-title"><b></b></p>
            <p class="project-slug"><?= lang("Projects.project.slug", ["<code>" . $project . "</code>"]) ?></p>
            <p class="project-time"><?= lang("Projects.project.time", ["<span></span>"])  ?></p>
            <p class="project-description"></p>
        </div>
    </a>
</div>