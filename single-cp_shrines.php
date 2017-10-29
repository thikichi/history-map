<?php get_header(); ?>

<div class="container-fluid single-news mb-50">
  <div class="row">
    <div class="col-md-9 col-sm-8">
      <?php if (have_posts()): ?>
        <?php the_post(); ?>
        <?php /* ↓↓ 記事が存在したら下記を実行 ↓↓ */ ?>
        <h2 class="single-title mb-10"><?php the_title(); // タイトルを表示 ?></h2>
        <div class="single-meta mb-30">
          <time datetime="<?php the_time('Y-m-d'); ?>" class="single-time">投稿日： <?php the_time('Y.m.d'); // 投稿日時を表示 ?></time>
          <?php
          global $ofm_ptype;
          $news_tax_slug = $ofm_ptype->get_ptype_news_cat();
          $terms = get_the_terms( $post->ID, $news_tax_slug );
          ?>
          <?php if($terms): ?>
            <span class="ml-30">カテゴリー：
              <?php foreach ($terms as $term): ?>
                <?php $term_link = get_term_link( $term->slug, $news_tax_slug ); ?>
                <a href="<?php echo esc_url($term_link); ?>" class="news-cat-tag"><?php echo $term->name; ?></a>
              <?php endforeach; ?>
            </span>
          <?php endif; ?>
        </div>

        <?php /* アイキャッチ画像があれば出力する */ ?>
        <?php if(has_post_thumbnail()): ?>
          <div class="layout-1">
            <div class="layout-1-left">      
              <div class="eyecatching mb-30">
                <?php the_post_thumbnail('large', array('class'=>'img-responsive center-block mb-xs-15')); ?>
              </div>
            </div>
            <div class="layout-1-right">
              
              <dl class="single-dl-2">
                <?php $cfield = get_post_meta( $post->ID, 'cfs_shrines_address', true ); ?>
                <?php if($cfield!=''): ?>
                  <dt>所在地</dt>
                  <dd><?php echo $cfield; ?></dd>        
                <?php endif; ?>
                <?php $cfield = get_post_meta( $post->ID, 'cfs_shrines_official_url', true ); ?>
                <?php if($cfield!=''): ?>
                  <dt>公式URL</dt>
                  <dd>
                    <a href="<?php echo esc_url($cfield); ?>" target="_blank">
                      <?php echo esc_url($cfield); ?> <i class="fa fa-external-link" aria-hidden="true"></i>
                    </a>
                  </dd>        
                <?php endif; ?>

              </dl>
            </div>
          </div>
        <?php endif; ?>


        <h3>公式サイトより引用文</h3>
        <div class="inyo">
          <?php $cfield = get_post_meta( $post->ID, 'cfs_shrines_official_quotation', true ); ?>
          <?php if($cfield!=''): ?>
              <?php echo esc_html($cfield); ?>
          <?php endif; ?>
        </div>


        <div class="post-content"><?php the_content(); // コンテンツを表示 ?></div>
        <?php /* ↑↑ 記事が存在したら上記を実行 ↑↑ */ ?>

        <?php
        /*
         * 前の記事、次の記事へのリンク
         * prev next link for single-page
        */
        ?>
        <div class="single-arrow row mt-30">
          <div class="col-xs-4 col-xs-offset-2 single-arrow-prev">
            <?php previous_post_link('%link', '&lt;&lt; 前の記事へ'); ?>
          </div><!-- .col-xs-6 -->
          <div class="col-xs-4 single-arrow-next">
            <?php next_post_link('%link', '次の記事へ &gt;&gt;'); ?>
          </div><!-- .col-xs-6 -->
        </div><!-- .row -->

      <?php else: ?>
        <?php /* ↓↓ 記事が存在しない場合 ↓↓ */ ?>
        <p>まだ記事の投稿がありません。</p>
        <?php /* ↑↑ 記事が存在しない場合 ↑↑ */ ?>
      <?php endif; ?>
    </div>
    <div class="col-md-3 col-sm-4 mt-xs-30 mt-sm-0">
      <div class="widget-rapper">
        <?php if(function_exists('dynamic_sidebar')) dynamic_sidebar('sidebar-cp_shrines'); /* 新着サイドバー */ ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>