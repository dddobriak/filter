<?php
error_reporting(E_ALL);
get_header(); 
get_template_part('bar', 'top');
get_template_part('bar', 'nav');
get_template_part('functions', 'filter');
get_template_part('bar', 'filter');
//echo '<pre>';
//var_dump(metaQueryArrays());
//echo '</pre>';
?>
<div class="container">
  <h1 class="head-title"><?php post_type_archive_title(); single_cat_title(); ?></h1>
</div>
  <?php
    get_template_part('bar','cat');

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'post_type'   => 'post',
      'posts_per_page' => 12,
      //'meta_key' => 'project_price',
      //'orderby' => 'meta_value_num',
      'paged' => $paged,
      'cat' => getFilterCat(),
      'order' => 'ASC',
      'meta_query'  => array(
        'relation'    => 'AND',
        metaQueryArrays()
      )
    );

    $wp_query = new WP_Query( $args );
  ?>
  <section class="content-inside container">
    <div class="row col-4">
    <?php if($wp_query->have_posts()) : ?>
      <?php  while ($wp_query->have_posts()) : $wp_query->the_post(); ?>   
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="item">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php 
              echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_id(), 'preview-thumb', array('class' => 'img-responsive img-thumbnail')) . '</a>';
              echo '<em class="optn">Общая пл. - <strong>' . get_field('project_area') . ' кв.м</strong></em>';
              echo '<em class="optn">Цена - <strong>' . get_field('project_price') . ' т.р.</strong></em>';
            ?>
            <p class="ac"><a href="<?php the_permalink(); ?>" class="btn">Подробнее</a></p>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
        <div class="col-md-12">
          <p>Проектов, соответствующих выбранным критериям не нашлось.</p>
        </div>
    <?php endif; ?>
    </div>
    <?php wp_pagenavi(); ?>
  </section>
<?php get_footer(); ?>