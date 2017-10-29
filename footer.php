  <?php if(is_front_page()): /* TOPページ */ ?>
    </main>
  <?php else: /* 下層ページ */ ?>
      </article>
    </main>
  <?php endif; ?>

  <?php /* この下にフッターを記述 */ ?>


<footer class="footer">
  <div class="container-fluid footer-inner">
    <div class="row">
      <p class="copyright">
        © 2017 t.hikichi &amp; chachamrunet.
      </p>
    </div>
  </div>
</footer>



  <?php /* この下にページトップを記述 */ ?>

  <!-- pagetop170 -->
  <!--==================================================-->

  <button class="pagetop170">
    <i class="fontello-1-arrow1-w0-up"></i>
    <span class="pagetop170-text">PAGE TOP</span>
  </button>


  <?php /* 条件分岐テンプレ（以下の条件分岐のどれか1つのみが適用されます） */ ?>

  <?php /* TOPページ */ ?>
  <?php if(is_front_page()): ?>

  <?php /* 特定の固定ページ ※ slug : 固定ページのスラッグ名を指定 */ ?>
  <?php elseif(is_page('slug')): ?>

  <?php /* 上記以外の固定ページ */ ?>
  <?php elseif(is_page()): ?>

  <?php /* 新着情報（アーカイブ ＆ 詳細） */ ?>
  <?php elseif(is_post_type_archive('news') || is_singular('news') || is_tax('newscategory')): ?>

  <?php /* 特定のカスタム投稿のアーカイブ　※ slug: カスタム投稿のスラッグ名を指定 */ ?>
  <?php elseif(is_post_type_archive('slug')): ?>

  <?php /* 特定のカスタム投稿の詳細　※ slug: カスタム投稿のスラッグ名を指定 */ ?>
  <?php elseif(is_singular('slug')): ?>

  <?php /* 特定のカスタム分類アーカイブ　※ slug: カスタム分類のスラッグ名を指定 */ ?>
  <?php elseif(is_tax('slug')): ?>

  <?php /* 「投稿」（ブログ）のアーカイブ */ ?>
  <?php elseif(is_archive() || is_single() || is_home()): ?>

  <?php /* 404ページ */ ?>
  <?php elseif(is_404()): ?>

  <?php /* その他 */ ?>
  <?php else: ?>

  <?php endif; ?>



  <?php
  /* テンプレート名を最下部に出力 */
  if(function_exists('os_disp_template_name')) os_disp_template_name();
  /* テンプレート名をコメントアウトで出力 */
  if(function_exists('os_disp_template_name_comment_out')) os_disp_template_name_comment_out();
  ?>

  <?php wp_footer(); ?>

  <script>
    (function($){

      /* すべての Javascript の後に記述したいスクリプト */



    })(jQuery);
  </script>

  </body>
</html>
