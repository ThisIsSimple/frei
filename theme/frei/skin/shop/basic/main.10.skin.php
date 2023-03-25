<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . G5_SHOP_SKIN_URL . '/style.css">', 0);
?>

<!-- 상품진열 10 시작 { -->
<div class="swiper py-4">
    <div class="swiper-wrapper">
        <?php
        $i = 0;
        foreach ((array) $list as $row) {
            if (empty($row)) continue;
            $i++;

            $item_link_href = shop_item_url($row['it_id']);
            $star_score = $row['it_use_avg'] ? (int) get_star($row['it_use_avg']) : '';
            $is_soldout = is_soldout($row['it_id'], true);   // 품절인지 체크

            if ($this->list_mod >= 2) { // 1줄 이미지 : 2개 이상
                if ($i % $this->list_mod == 0) $sct_last = 'sct_last'; // 줄 마지막
                else if ($i % $this->list_mod == 1) $sct_last = 'sct_clear'; // 줄 첫번째
                else $sct_last = '';
            } else { // 1줄 이미지 : 1개
                $sct_last = 'sct_clear';
            }
        ?>
            <div class="swiper-slide flex justify-center">
                <a href="<?php echo $item_link_href; ?>" class="block w-fit">
                    <div class="w-[215px] rounded-xl bg-gray-100">
                        <?php echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name'])) . "\n"; ?>

                        <div class="flex justify-between items-center text-primary px-5 py-3">
                            <h1 class="font-righteous text-3xl"><?php echo stripslashes($row["it_name"]); ?></h1>
                            <div class="flex flex-col items-end">
                                <h3 class="font-righteous text-lg"><?php echo stripslashes($row['it_basic']); ?></h3>
                                <?php
                                if ($this->view_it_cust_price || $this->view_it_price) {
                                    echo "<div class=\"font-normal text-sm\">\n";

                                    if ($this->view_it_price) {
                                        echo display_price(get_price($row), $row['it_tel_inq']) . "\n";
                                    }
                                    echo "</div>\n";
                                }
                                ?>
                            </div>
                        </div>

                        <?php
                        if ($this->view_it_icon) {
                            // 품절
                            if ($is_soldout) {
                                echo '<span class="shop_icon_soldout h160"><span class="soldout_txt">SOLD OUT</span></span>';
                            }
                        } ?>
                    </div>
                </a>
            </div>
        <?php } ?>

        <?php if ($i == 0) echo "<p class=\"w-full h-[100px] flex justify-center items-center text-primary\">등록된 상품이 없습니다.</p>\n"; ?>
    </div>
    <!-- <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div> -->
</div>

<script>
    new Swiper('.swiper', {
        slidesPerView: 1,
        spaceBetween: 100,
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 3,
            },
            1280: {
                slidesPerView: 4,
            },
            1536: {
                slidesPerView: 5,
            }
        }
    });
</script>
<!-- } 상품진열 10 끝 -->