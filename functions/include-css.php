<?php
/*----------------------------------------------------------------------------------------------------*/
/* サイトに読み込むCSSファイルを指定 */
/*----------------------------------------------------------------------------------------------------*/

/*
 * スタイルを追加する方法
 * 
 * 基本的にはWordPressで用意された下記のfunctionを使って実装
 * wp_enqueue_style( $handle, $src, $deps, $ver, $media ); 
 * 
 * $handle
 * （文字列） （必須） スタイルシートのハンドルとして使われる名称
 * CSSファイル名を書いておけば大丈夫です。
 * 
 * $src
 * （オプション） スタイルシートのURL
 * 
 * $deps
 * （オプション） このスタイルシートが依存する他のスタイルシートのハンドル配列
 * 分からなければ省略
 * 
 * $ver
 * （オプション） スタイルシートのバージョン番号を指定する文字列 (存在する場合) 
 * 分からなければ省略
 * 
 * $media
 * （オプション） スタイルシートが定義されているメディアを指定する文字列。例: 'all'、'screen'、'handheld'、'print'。
 * 分からなければ省略
*/


add_action( 'wp_enqueue_scripts', function(){
  /*---------------------------------------------------------------*/
  /* ↓↓↓　全ページ共通 ↓↓↓ */
  /*---------------------------------------------------------------*/

  /*
   * common.css
  */
  wp_enqueue_style(
    'fontello',
    get_stylesheet_directory_uri() . '/fonts/fontello-custom/css/fontello.css'
  );

  /*
   * font-awesome
  */
  wp_enqueue_style(
    'font-awesome',
    get_stylesheet_directory_uri() . '/fonts/font-awesome-4.7.0/css/font-awesome.min.css'
  );

  /*
   * common.css
  */
  wp_enqueue_style(
    'os-common',
    get_stylesheet_directory_uri() . '/css/common.css'
  );


  if(is_front_page()) {
  /*---------------------------------------------------------------*/
  /* ↓↓↓　トップページ ↓↓↓ */
  /*---------------------------------------------------------------*/

  /*
   * index.css
  */
  wp_enqueue_style(
    'os-index',
    get_stylesheet_directory_uri() . '/css/index.css'
  );

  /*
   * slick.css
  */
  wp_enqueue_style(
    'slick.css',
    get_stylesheet_directory_uri() . '/vendor/slick/slick.css'
  );
  wp_enqueue_style(
    'slick-theme.css',
    get_stylesheet_directory_uri() . '/vendor/slick/slick-theme.css'
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
   * news.css （新着情報）
  */
  wp_enqueue_style(
    'os-blog',
    get_stylesheet_directory_uri() . '/css/blog.css'
  );


  } elseif((is_single() || is_archive() || is_home())) {
  /*---------------------------------------------------------------*/
  /* ↓↓↓　ブログ（投稿） ↓↓↓ */
  /*---------------------------------------------------------------*/

  /*
   * news.css （新着情報）
  */
  wp_enqueue_style(
    'os-blog',
    get_stylesheet_directory_uri() . '/css/blog.css'
  );


  } elseif(is_search()) {
  /*---------------------------------------------------------------*/
  /* ↓↓↓　検索結果ページ ↓↓↓ */
  /*---------------------------------------------------------------*/

  /*
   * search.css （新着情報）
  */
  wp_enqueue_style(
    'search.css',
    get_stylesheet_directory_uri() . '/css/search.css'
  );


  } elseif(is_404()) {
  /*---------------------------------------------------------------*/
  /* ↓↓↓　404 NOT FOUND ↓↓↓ */
  /*---------------------------------------------------------------*/

  /*
   * news.css （新着情報）
  */
  wp_enqueue_style(
    '404',
    get_stylesheet_directory_uri() . '/css/404.css'
  );

  } else {}
});


add_action( 'after_link_page_css', function(){
  /*---------------------------------------------------------------*/
  /* ↓↓↓　ページごとのCSSより後に読み込まれる ↓↓↓ */
  /*---------------------------------------------------------------*/

  /*
   * style.css
  */
  wp_enqueue_style(
    'os-style',
    get_stylesheet_directory_uri() . '/style.css'
  );

});
