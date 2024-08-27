<!-- <div class="sub_banner1">
  <div class="container">
    <h3>Projects</h3>
  </div>
</div>


<div class="main_brands">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="shop_colmn1">
          <h4 class="prod_head_2">Ongoing projects</h4>
          <button class="collapse_b" data-toggle="collapse" data-target="#demo">Ongoing projects <i
              class="fa fa-bars"></i></button>
          <div id="demo" class="collapse">
            <ul class="shop_nav__1">
              <?php foreach ($project_data as $item): ?>
                <li><a href="<?= MAINSITE . "ongoing-projects/" . $item->project_id ?>"
                    class="active <?= $item->project_id == $single_project_data->project_id ? 'actviea' : '' ?>"><?= $item->name ?>
                    <i class="fa fa-angle-right"></i></label></a></li>
              <?php endforeach; ?>


            </ul>
          </div>
        </div>
      </div>



      <div class="col-md-9">
        <h1 class="main_headera"><?= $single_project_data->name ?></h1>
        <?php foreach ($single_project_data->project_gallery_image as $item): ?>
          <div class="glry_col_1">
            <div class="glry_col_w">
              <figure class="snip1584"><img src="<?= _uploaded_files_ . 'project_gallery_image/' . $item->file ?>"
                  alt="sample87" width="253" height="183" />
                <figcaption>

                </figcaption><a class="example-image-link"
                  href="<?= _uploaded_files_ . 'project_gallery_image/' . $item->file ?>"
                  title="<?= $single_project_data->name ?>" data-lightbox="example-1"></a>
              </figure>
              </a>
            </div>
          </div>
        <?php endforeach; ?>



      </div>
    </div>
  </div>
</div> -->

<link href="<?= CSS ?>custome2.css" rel="stylesheet">



<div class="container-fluid pdngnone mybanner2">
  <div class="container pdngnone">
    <h2 class="mybanner2_h2">Our Projects</h2>
  </div>
</div>


<div class="main_brands">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="shop_colmn1">
          <h4 class="prod_head_2">Ongoing projects</h4>
          <button class="collapse_b" data-toggle="collapse" data-target="#demo">Ongoing projects <i
              class="fa fa-bars"></i></button>
          <div id="demo" class="collapse">
            <ul class="shop_nav__1">
              <?php foreach ($project_data as $item): ?>
                <li><a href="<?= MAINSITE . "ongoing-projects/" . $item->slug_url ?>"
                    class="active <?= $item->project_id == $single_project_data->project_id ? 'actviea' : '' ?>"><?= $item->name ?>
                    <i class="fa fa-angle-right"></i></label></a></li>
              <?php endforeach; ?>


            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <h1 class="main_headera"><?= $single_project_data->name ?></h1>
        <h4><?= $single_project_data->description ?></h4>
        <?php foreach ($single_project_data->project_gallery_image as $item): ?>
          <div class="glry_col_1">
            <div class="glry_col_w">
              <figure class="snip1584"><img src="<?= _uploaded_files_ . 'project_gallery_image/' . $item->file ?>"
                  alt="sample87" width="253" height="183" />
                <figcaption>

                </figcaption><a class="example-image-link"
                  href="<?= _uploaded_files_ . 'project_gallery_image/' . $item->file ?>"
                  title="<?= $single_project_data->name ?>" data-lightbox="example-1"></a>
              </figure>
              </a>
            </div>
          </div>
        <?php endforeach; ?>



      </div>
    </div>
  </div>
</div>