<?php get_header(); ?>


<!-- title204 -->
<!--==================================================-->

<div class="row title204 mb-30">
  <div class="container-fluid">
    <h2 class="title204-text family-serif">
      <?php /* functions/utility.php にて編集可 */ ?>
      <span>地図で見る神社一覧</span>
    </h2>
  </div>
</div>


<?php
// ↓↓↓ パラーメタ指定 ↓↓↓ --------------------------------
$post_type  = 'cp_shrines';           // 投稿タイプを指定
$gmap_field = 'acf_shrines_map';     // GoogleMapフィールド（Advanced custom fieldプラグインのMapフィールド）
$file_name  = '/gmap-spot.json'; // 自動生成する外部ファイル
$map_center_lat = '35.658581';    // 地図の中心座標（緯度）
$map_center_lng = '139.745433';   // 地図の中心座標（経度）
$map_zoom       = 10;              // ズームレベル
$map_add_key    = 'cfs_shrines_address';
// ↑↑↑ パラーメタ指定 ↑↑↑ --------------------------------

$json_file_dir  = get_stylesheet_directory() . $file_name;
$json_file_uri = get_stylesheet_directory_uri() . $file_name;
// 取得した投稿データそのままJSON形式にて別ファイル保存
$arr_shops = get_posts(array('post_type' => $post_type,'numberposts' => -1));
$infowin = array();
$infowin['property']['lat']        = $map_center_lat;
$infowin['property']['lng']        = $map_center_lng;
$infowin['property']['zoom']       = $map_zoom;

$i = 0;
foreach ($arr_shops as $arr_shop) {
  $shop       = get_post($arr_shop->ID);
  $cfield_map = get_post_meta($arr_shop->ID, $gmap_field, true);
  $cfield_add = get_post_meta($arr_shop->ID, $map_add_key, true);
  // サムネイル画像を取得
  $image = wp_get_attachment_image_src(get_post_thumbnail_id($arr_shop->ID), 'thumbnail');
  if($image)  {
    $infowin['post'][$i]['imgurl'] = $image[0];
  } else {
    $infowin['post'][$i]['imgurl'] = 'https://placehold.jp/777777/ffffff/750x750.png?text=NO%20IMAGE';
  }
  $infowin['post'][$i]['link']    = get_permalink( $arr_shop->ID );
  $infowin['post'][$i]['title']   = $shop->post_title;
  $infowin['post'][$i]['address'] = $cfield_add!='' ? $cfield_add : $cfield_map['address'];
  $infowin['post'][$i]['lat']     = $cfield_map['lat'];
  $infowin['post'][$i]['lng']     = $cfield_map['lng'];
  $i++;
}
$shops_json = json_encode($infowin);
// ファイルに保存
file_put_contents($json_file_dir, $shops_json);
?>


<section class="map-area">
  <div class="container-fluid">
    <div id="map_canvas" style="width:100%; height:400px;box-shadow: 0px 3px 8px 0px rgba(49, 49, 49, 0.26),0px 9px 24px 0px rgba(49, 49, 49, 0.16);"></div>
  </div>
</section>

<script type="text/javascript">
  // 外部JSONデータ取得
  jQuery(function($) {
    $.getJSON('<?php echo $json_file_uri; ?>' , function(data) {
      var markers = data;
      var currentWindow = null;
      function initialize() {
        var rdata = [];
        var myOptions = {
          zoom: markers.property.zoom,
          center: new google.maps.LatLng(markers.property.lat, markers.property.lng),
          mapTypeId: google.maps.MapTypeId.ROADMAP
          };
        var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
        for (var i = 0; i < markers.post.length; i++) {
          var name    = markers.post[i]['title'];
          var address = markers.post[i]['address'];
          var link    = markers.post[i]['link'];
          var imgurl  = markers.post[i]['imgurl'];
          var latlng  = new google.maps.LatLng(markers.post[i]['lat'],markers.post[i]['lng']);
          var html = '';
          html += '<div id="mapWin' + i + '" class="align-center">';
          html += '<img style="width:150px;margin-bottom:10px" src="' + imgurl + '">';
          html += '</div>';
          html += '<p class="infowin-title">' + name + '</p>';
          html += '<p class="infowin-address">' + address + '</p>';
          html += '<p class="infowin-link">[<a href="' + link + '" target="_bkank">記事の詳細</a>]</p>';
          rdata[i] = createMarker(html, latlng, map);
        }
        // console.log(rdata[2]);
        $('.gotomap').on("click",function(){
          var mapIndex = $(this).data('mapindex');
          var infoWindow = new google.maps.InfoWindow();
          if (currentWindow) {
            currentWindow.close();
          }
          infoWindow.setContent(rdata[mapIndex]['html']);
          infoWindow.open(map,rdata[mapIndex]['marker']);
          currentWindow = infoWindow;
        });


      }
      function createMarker(name,latlng,map){
        var rdata = [];
        var infoWindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({position: latlng,map: map});
        google.maps.event.addListener(marker, 'click', function() {
          if (currentWindow) {
            currentWindow.close();
          }
          infoWindow.setContent(name);
          infoWindow.open(map,marker);
          currentWindow = infoWindow;
        });
        rdata['marker'] = marker;
        rdata['html']   = name;
        return rdata;

      }
      google.maps.event.addDomListener(window, 'load', initialize);
    });
  });
</script>


<div class="container-fluid single-news mt-50">
  <div class="row">
    <div class="col-md-9 col-sm-8">

      <!-- title204 -->
      <!--==================================================-->

      <div class="row title204 mb-30">
        <div class="container-fluid">
          <h2 class="title204-text family-serif">
            <?php /* functions/utility.php にて編集可 */ ?>
            <span>神社一覧</span>
          </h2>
        </div>
      </div>

      <?php
      query_posts(
        array(
          /* 投稿タイプのslug */
          'post_type' => 'cp_shrines',
          'posts_per_page' => 5, // 5件表示
          'paged' => get_query_var('paged'),
        )
      );
      ?>

      <?php if (have_posts()): ?>
        <?php $i=0; while(have_posts()) : the_post(); ?>
          <?php /* ↓↓ 記事が存在したら下記を実行 ↓↓ */ ?>
          <div class="row mb-30">
            <div class="col-sm-2">
              <?php /* アイキャッチ画像が設定されていた場合 */ ?>
              <?php if(has_post_thumbnail()): ?>
                <?php /* アイキャッチ画像を出力 */ ?>
                <?php the_post_thumbnail('thumbnail', array('class'=>'img-responsive center-block mb-xs-15')); ?>
              <?php else: ?>
                <img class="img-responsive" src="https://placehold.jp/777777/ffffff/750x750.png?text=NO%20IMAGE">
              <?php endif; ?>
            </div>
            <div class="col-sm-10">
              <?php /* タイトルを出力 */ ?>
              <h2 class="single-title">
                  <?php the_title(); ?> 
                  <span class="text-14">
                  <a href="<?php the_permalink(); ?>">[記事詳細]</a>
                  <a href="#mapWin<?php echo $i; ?>" class="gotomap" data-mapindex="<?php echo $i; ?>">[地図]</a>
                  </span>
              </h2>
              <div class="single-meta mb-5">
                <?php /* 投稿日を出力 */ ?>
                <time datetime="<?php the_time('Y-m-d'); ?>" class="single-time">投稿日： <?php the_time('Y.m.d'); // 投稿日時を表示 ?></time>

                <?php $cat_terms = get_the_terms( $post->ID, 'category' ); ?>
                <?php if($cat_terms): ?>
                  <span class="ml-30">カテゴリー：
                    <?php foreach ($cat_terms as $term): ?>
                      <?php $term_link = get_term_link( $term->slug, 'category' ); ?>
                      <a href="<?php echo esc_url($term_link); ?>" class="news-cat-tag"><?php echo $term->name; ?></a>
                    <?php endforeach; ?>
                  </span>
                <?php endif; ?>
              </div><!-- .single-meta -->
              <dl class="single-dl-1">
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
          <?php /* ↑↑ 記事が存在したら上記を実行 ↑↑ */ ?>
        <?php $i++; endwhile; ?>

        <div class="pagenation">
          <?php
          /*
          * 投稿一覧系ページで各ページへのリンクを出力
          * 例) << 前へ 1 2 3 次へ >>
          */
          ?>
          <?php
          /* 固定ページで使いたい場合は下記をコメントアウトをはずす */
          // $GLOBALS['wp_query']->max_num_pages = $the_query->max_num_pages;
          ?>
          <?php
          the_posts_pagination(array(
            'mid_size' => 3,
            'prev_text' => '&lt;  前',
            'next_text' => '次 &gt;',
            'screen_reader_text' => ' ',
          ));
          ?>
        </div>

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