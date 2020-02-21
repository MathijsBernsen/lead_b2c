<div class="navigation_bar">
    <div id="navigation_container">
        <div class="logo">
            <div class="logo_container"></div>
        </div>
        <div class="services_navbar">
              <button class="dropbtn">Andere Diensten</button>
        </div>
        <div class="register_navbar">
          <span class="">Ben jij een vakspecialist?</span>
          <button class="">Meld je aan!</button>
        </div>
    </div>
    <div id="menu_navbar">
      <div class="dropdown-content">

      <?php
      //Set arguments to search by
      //Category_name isnt a columm name in the database but it works.
      $args = array(
        'category_name' => 'pageLink',
        'posts_per_page' => -1,
        'order' => 'ASC',
      );

      $your_query = new WP_Query($args);

      while ($your_query->have_posts()) : $your_query->the_post();
      ?>
      <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
      <?php

      endwhile;
       ?>


      </div>
    </div>
</div>
