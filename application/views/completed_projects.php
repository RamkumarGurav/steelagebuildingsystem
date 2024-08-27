<style>
  .cus-row {
    display: flex;
    flex-wrap: wrap;
  }
</style>

<div class="container-fluid pdngnone mybanner2">
  <div class="container pdngnone">
    <h2 class="mybanner2_h2">Our Projects</h2>
  </div>
</div>


<div class="main_brands">
  <div class="container">
    <h3 class="main_head_1 wow animated slideInUp" data-wow-duration="1s">Completed Projects</h3>
    <div class="cus-row">
      <?php foreach ($project_data as $item): ?>
        <div class="glry_col_1">
          <div class="glry_col_w">
            <a href="<?= MAINSITE . "completed-projects/" . $item->slug_url ?>">
              <figure class="snip1584"><img
                  src="<?= _uploaded_files_ . 'project_cover_image/' . $item->project_cover_image ?>" alt="sample87"
                  width="360" height="260" />
              </figure>
            </a>
          </div>
          <h3 class="gim"><?= $item->name ?></h3>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
</div>