<?php
/*----------------------------------------------------------------------------------------------------*/
/* サイトに読み込むJSファイルを指定 */
/*----------------------------------------------------------------------------------------------------*/

/*
 * JSを追加する方法
 * 
 * 基本的にはWordPressで用意された下記のfunctionを使って実装
 * wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer ); 
 * 
 * 第1引数 $handle
 * （必須）スクリプトのハンドルとして使われる名称
 * JSファイル名を書いておけば大丈夫です。
 * 
 * 第2引数 $src
 * （オプション） スクリプトの URL
 * 
 * 第3引数 $deps
 * （オプション） このスクリプトが依存する他のスクリプトのハンドル配列
 * 通常は「 array('jquery') 」を指定
 * 
 * 第4引数 $ver
 * （オプション） クエリストリングとしてファイルパスの最後に連結される、スクリプトのバージョン番号を指定する文字列
 * 分からなければ省略
 * 
 * 第5引数 $in_footer
 * （オプション）スクリプトを</body>終了タグの前に配置する場合は「true」を指定
 * 分からなければ省略
*/


add_action( 'wp_enqueue_scripts', function(){
  /*---------------------------------------------------------------*/
  /* ↓↓↓　全ページ共通 ↓↓↓ */
  /*---------------------------------------------------------------*/

  /*
   * Google Map を使う場合は下記のコメントアウトを外す
  */
  wp_enqueue_script(
    'google-map',
    'https://maps.googleapis.com/maps/api/js?key=AIzaSyBtZf7reHhZ6Ax_lg5VExElBb39BDgvx2o',
    array('jquery'), 
    false, 
    true
  );

  /*
   * common.js
  */
  wp_enqueue_script(
    'os-common', 
    get_stylesheet_directory_uri() . '/js/common.js', 
    array('jquery'), 
    false, 
    true
  );


  if(is_front_page()) {
  /*---------------------------------------------------------------*/
  /* ↓↓↓　トップページ ↓↓↓ */
  /*---------------------------------------------------------------*/

  /*
   * index.js （トップページ）
  */
  wp_enqueue_script(
    'os-index',
    get_stylesheet_directory_uri() . '/js/index.js',
    array('jquery'),
    false,
    true
  );


  /*
   * slick.min.js
  */
  wp_enqueue_script(
    'slick.min.js',
    get_stylesheet_directory_uri() . '/vendor/slick/slick.min.js',
    array('jquery'),
    false,
    true
  );



  } else if(is_page()) {
  /*---------------------------------------------------------------*/
  /* ↓↓↓　固定ページ ↓↓↓ */
  /*---------------------------------------------------------------*/



  } else if(is_page('slug')) {
  /*---------------------------------------------------------------*/
  /* ↓↓↓　特定の固定ページ ↓↓↓ */
  /*---------------------------------------------------------------*/



  } elseif((is_singular('news') || is_tax('newscategory'))) {
  /*---------------------------------------------------------------*/
  /* ↓↓↓　新着情報 ↓↓↓ */
  /*---------------------------------------------------------------*/

  /*
   * blog.js （ブログ・投稿）
  */
  wp_enqueue_script(
   'os-blog',
    get_stylesheet_directory_uri() . '/js/blog.js',
    array('jquery'),
    false,
    true
  );

  } elseif((is_single() || is_archive() || is_home())) {
  /*---------------------------------------------------------------*/
  /* ↓↓↓　ブログ（投稿） ↓↓↓ */
  /*---------------------------------------------------------------*/

  /*
   * blog.js （ブログ・投稿）
  */
  wp_enqueue_script(
   'os-blog',
    get_stylesheet_directory_uri() . '/js/blog.js',
    array('jquery'),
    false,
    true
  );


  } elseif((is_search())) {
  /*---------------------------------------------------------------*/
  /* ↓↓↓　検索結果ページ ↓↓↓ */
  /*---------------------------------------------------------------*/

  /*
   * search.js
  */
  wp_enqueue_script(
   'search.js',
    get_stylesheet_directory_uri() . '/js/search.js',
    array('jquery'),
    false,
    true
  );

  } else {}
});


add_action( 'after_link_page_css', function(){
  /*---------------------------------------------------------------*/
  /* ↓↓↓　ページごとのCSSより後に読み込まれる ↓↓↓ */
  /*---------------------------------------------------------------*/


});
