<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . G5_SHOP_SKIN_URL . '/style.css">', 0);

// 장바구니 또는 위시리스트 ajax 스크립트
add_javascript('<script src="' . G5_THEME_JS_URL . '/theme.shop.list.js"></script>', 10);
?>

<!-- 상품진열 10 시작 { -->
<?php
$i = 0;

$this->view_star = (method_exists($this, 'view_star')) ? $this->view_star : true;

foreach ((array) $list as $row) {
    if (empty($row)) continue;

    $item_link_href = shop_item_url($row['it_id']);     // 상품링크
    $star_score = $row['it_use_avg'] ? (int) get_star($row['it_use_avg']) : '';     //사용자후기 평균별점
    $list_mod = $this->list_mod;    // 분류관리에서 1줄당 이미지 수 값 또는 파일에서 지정한 가로 수
    $is_soldout = is_soldout($row['it_id'], true);   // 품절인지 체크

    $classes = array();

    $classes[] = 'col-row-' . $list_mod;

    if ($i && ($i % $list_mod == 0)) {
        $classes[] = 'row-clear';
    }

    $i++;   // 변수 i 를 증가

    if ($i === 1) {
        if ($this->css) {
            echo "<div class=\"{$this->css}\">\n";
        } else {
            echo "<div class=\"sct sct_10 grid xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-4\">\n";
        }
    }

    echo "<div class=\"sct_li w-[225px] justify-self-center " . implode(' ', $classes) . "\" data-css=\"nocss\" style=\"height:auto\">\n";
    echo "<div class=\"sct_img\">\n";

    if ($this->href) {
        echo "<a href=\"{$item_link_href}\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name'])) . "\n";
    }

    if ($this->href) {
        echo "</a>\n";
    }

    if (!$is_soldout) {    // 품절 상태가 아니면 출력합니다.
        echo "<div class=\"sct_btn list-10-btn\">
            <button type=\"button\" class=\"btn_cart sct_cart\" data-it_id=\"{$row['it_id']}\"><i class=\"fa fa-shopping-cart\" aria-hidden=\"true\"></i> 장바구니</button>\n";
        echo "</div>\n";
    }

    echo "<div class=\"cart-layer\"></div>\n";

    if ($this->view_it_icon) {
        // 품절
        if ($is_soldout) {
            echo '<span class="shop_icon_soldout"><span class="soldout_txt">SOLD OUT</span></span>';
        }
    }
    echo "</div>\n";

    echo "<div class=\"sct_ct_wrap\">\n";

    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;" . stripslashes($row['it_id']) . "&gt;</div>\n";
    }

    if ($this->href) {
        echo "<a href=\"{$item_link_href}\" class=\"text-primary\">\n";
    }

    echo "<div class=\"flex justify-end items-baseline font-righteous\">";

    if ($this->view_it_name) {
        echo "<div class=\"text-2xl mr-2\">".stripslashes($row['it_name']) . "</div>\n";
    }

    if ($this->view_it_basic && $row['it_basic']) {
        echo "<div class=\"\">" . stripslashes($row['it_basic']) . "</div>\n";
    }

    echo "</div>";

    if ($this->view_it_cust_price || $this->view_it_price) {

        echo "<div class=\"text-right font-light\">\n";
        if ($this->view_it_price) {
            echo display_price(get_price($row), $row['it_tel_inq']) . "\n";
        }
        if ($this->view_it_cust_price && $row['it_cust_price']) {
            echo "<span class=\"sct_dict\">" . display_price($row['it_cust_price']) . "</span>\n";
        }
        echo "</div>\n";
    }

    if ($this->href) {
        echo "</a>\n";
    }

    echo "</div>\n";

    echo "</div>\n";
}   //end foreach

if ($i >= 1) echo "</div>\n";

if ($i === 0) echo "<p class=\"sct_noitem text-primary\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->

<script>
    //SNS 공유
    $(function() {
        $(".btn_share").on("click", function() {
            $(this).parent("div").children(".sct_sns_wrap").show();
        });
        $('.sct_sns_bg, .sct_sns_cls').click(function() {
            $('.sct_sns_wrap').hide();
        });
    });
</script>