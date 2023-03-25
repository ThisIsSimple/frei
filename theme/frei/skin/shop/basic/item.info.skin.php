<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . G5_SHOP_CSS_URL . '/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<section class="grid grid-cols-2 gap-4">
	<div>
		<!-- <ul class="tab_tit">
			<li><button type="button" id="btn_sit_inf" rel="#sit_inf" class="selected">상품정보</button></li>
			<li><button type="button" id="btn_sit_use" rel="#sit_use">사용후기 <span class="item_use_count"><?php echo $item_use_count; ?></span></button></li>
			<li><button type="button" id="btn_sit_qa" rel="#sit_qa">상품문의 <span class="item_qa_count"><?php echo $item_qa_count; ?></span></button></li>
			<li><button type="button" id="btn_sit_dvex" rel="#sit_dex">배송/교환</button></li>
		</ul> -->
		<ul class="tab_con">

			<!-- 상품 정보 시작 { -->
			<li id="sit_inf">
				<h2 class="contents_tit"><span>상품 정보</span></h2>

				<?php if ($it['it_explan']) { // 상품 상세설명 
				?>
					<h3>상품 상세설명</h3>
					<div id="sit_inf_explan">
						<?php echo conv_content($it['it_explan'], 1); ?>
					</div>
				<?php } ?>

				<!-- TODO. 스킨 양식에 맞춰서 수정 (item.form.skin.php에서 온 코드) -->
				<?php
				$big_img_count = 0;
				$thumbnails = array();
				for ($i = 1; $i <= 10; $i++) {
					if (!$it['it_img' . $i])
						continue;

					$img = get_it_thumbnail($it['it_img' . $i], 300, 300);

					if ($img) {
						// 썸네일
						$thumb = get_it_thumbnail($it['it_img' . $i], 70, 70);
						$thumbnails[] = $thumb;
						$big_img_count++;

						echo '<a href="' . G5_SHOP_URL . '/largeimage.php?it_id=' . $it['it_id'] . '&amp;no=' . $i . '" target="_blank" class="popup_item_image">' . $img . '</a>';
					}
				}

				if ($big_img_count == 0) {
					echo '<img src="' . G5_SHOP_URL . '/img/no_image.gif" class="w-full" alt="">';
				}
				?>

				<?php
				if ($it['it_info_value']) { // 상품 정보 고시
					$info_data = unserialize(stripslashes($it['it_info_value']));
					if (is_array($info_data)) {
						$gubun = $it['it_info_gubun'];
						$info_array = $item_info[$gubun]['article'];
				?>
						<h3>상품 정보 고시</h3>
						<table id="sit_inf_open">
							<tbody>
								<?php
								foreach ($info_data as $key => $val) {
									$ii_title = $info_array[$key][0];
									$ii_value = $val;
								?>
									<tr>
										<th scope="row"><?php echo $ii_title; ?></th>
										<td><?php echo $ii_value; ?></td>
									</tr>
								<?php } //foreach
								?>
							</tbody>
						</table>
						<!-- 상품정보고시 end -->
				<?php
					} else {
						if ($is_admin) {
							echo '<p>상품 정보 고시 정보가 올바르게 저장되지 않았습니다.<br>config.php 파일의 G5_ESCAPE_FUNCTION 설정을 addslashes 로<br>변경하신 후 관리자 &gt; 상품정보 수정에서 상품 정보를 다시 저장해주세요. </p>';
						}
					}
				} //if
				?>

			</li>
			<!-- 사용후기 시작 { -->
			<li id="sit_use">
				<h2>사용후기</h2>
				<div id="itemuse"><?php include_once(G5_SHOP_PATH . '/itemuse.php'); ?></div>
			</li>
			<!-- } 사용후기 끝 -->

			<!-- 상품문의 시작 { -->
			<li id="sit_qa">
				<h2>상품문의</h2>
				<div id="itemqa"><?php include_once(G5_SHOP_PATH . '/itemqa.php'); ?></div>
			</li>
			<!-- } 상품문의 끝 -->

			<!-- 배송/교환 시작 { -->
			<li id="sit_dex">
				<h2>배송/교환정보</h2>

				<?php if ($default['de_baesong_content']) { // 배송정보 내용이 있다면 
				?>
					<!-- 배송 시작 { -->
					<div id="sit_dvr">
						<h3>배송</h3>
						<?php echo conv_content($default['de_baesong_content'], 1); ?>
					</div>
					<!-- } 배송 끝 -->
				<?php } ?>

				<?php if ($default['de_change_content']) { // 교환/반품 내용이 있다면 
				?>
					<!-- 교환 시작 { -->
					<div id="sit_ex">
						<h3>교환</h3>
						<?php echo conv_content($default['de_change_content'], 1); ?>
					</div>
					<!-- } 교환 끝 -->
				<?php } ?>

			</li>
			<!-- } 배송/교환  끝 -->
		</ul>
	</div>
	<script>
		$(function() {
			$(".tab_con>li").hide();
			$(".tab_con>li:first").show();
			$(".tab_tit li button").click(function() {
				$(".tab_tit li button").removeClass("selected");
				$(this).addClass("selected");
				$(".tab_con>li").hide();
				$($(this).attr("rel")).show();
			});
		});
	</script>
</section>

<script>
	jQuery(function($) {
		var change_name = "ct_copy_qty";

		$(document).on("select_it_option_change", "select.it_option", function(e, $othis) {
			var value = $othis.val(),
				change_id = $othis.attr("id").replace("it_option_", "it_side_option_");

			if ($("#" + change_id).length) {
				$("#" + change_id).val(value).attr("selected", "selected");
			}
		});

		$(document).on("select_it_option_post", "select.it_option", function(e, $othis, idx, sel_count, data) {
			var value = $othis.val(),
				change_id = $othis.attr("id").replace("it_option_", "it_side_option_");

			$("select.it_side_option").eq(idx + 1).empty().html(data).attr("disabled", false);

			// select의 옵션이 변경됐을 경우 하위 옵션 disabled
			if ((idx + 1) < sel_count) {
				$("select.it_side_option:gt(" + (idx + 1) + ")").val("").attr("disabled", true);
			}
		});

		$(document).on("add_sit_sel_option", "#sit_sel_option", function(e, opt) {

			opt = opt.replace('name="ct_qty[', 'name="' + change_name + '[');

			var $opt = $(opt);
			$opt.removeClass("sit_opt_list");
			$("input[type=hidden]", $opt).remove();

			$(".sit_sel_option .sit_opt_added").append($opt);

		});

		$(document).on("price_calculate", "#sit_tot_price", function(e, total) {
			$(".sum_section .sit_tot_price").empty().html(number_format(String(total)) + " 원");
		});

		$(".sit_side_option").on("change", "select.it_side_option", function(e) {
			var idx = $("select.it_side_option").index($(this)),
				value = $(this).val();

			if (value) {
				if (typeof(option_add) != "undefined") {
					option_add = true;
				}

				$("select.it_option").eq(idx).val(value).attr("selected", "selected").trigger("change");
			}
		});

		$(".sit_side_option").on("change", "select.it_side_supply", function(e) {
			var value = $(this).val();

			if (value) {
				if (typeof(supply_add) != "undefined") {
					supply_add = true;
				}

				$("select.it_supply").val(value).attr("selected", "selected").trigger("change");
			}
		});

		$(".sit_opt_added").on("click", "button", function(e) {
			e.preventDefault();

			var $this = $(this),
				mode = $this.text(),
				$sit_sel_el = $("#sit_sel_option"),
				li_parent_index = $this.closest('li').index();

			if (!$sit_sel_el.length) {
				alert("el 에러");
				return false;
			}

			switch (mode) {
				case "증가":
					$sit_sel_el.find("li").eq(li_parent_index).find(".sit_qty_plus").trigger("click");
					break;
				case "감소":
					$sit_sel_el.find("li").eq(li_parent_index).find(".sit_qty_minus").trigger("click");
					break;
				case "삭제":
					$sit_sel_el.find("li").eq(li_parent_index).find(".sit_opt_del").trigger("click");
					break;
			}

		});

		$(document).on("sit_sel_option_success", "#sit_sel_option li button", function(e, $othis, mode, this_qty) {
			var ori_index = $othis.closest('li').index();

			switch (mode) {
				case "증가":
				case "감소":
					$(".sit_opt_added li").eq(ori_index).find("input[name^=ct_copy_qty]").val(this_qty);
					break;
				case "삭제":
					$(".sit_opt_added li").eq(ori_index).remove();
					break;
			}
		});

		$(document).on("change_option_qty", "input[name^=ct_qty]", function(e, $othis, val, force_val) {
			var $this = $(this),
				ori_index = $othis.closest('li').index(),
				this_val = force_val ? force_val : val;

			$(".sit_opt_added").find("li").eq(ori_index).find("input[name^=" + change_name + "]").val(this_val);
		});

		$(".sit_opt_added").on("keyup paste", "input[name^=" + change_name + "]", function(e) {
			var $this = $(this),
				val = $this.val(),
				this_index = $("input[name^=" + change_name + "]").index(this);

			$("input[name^=ct_qty]").eq(this_index).val(val).trigger("keyup");
		});

		$(".sit_order_btn").on("click", "button", function(e) {
			e.preventDefault();

			var $this = $(this);

			if ($this.hasClass("sit_btn_cart")) {
				$("#sit_ov_btn .sit_btn_cart").trigger("click");
			} else if ($this.hasClass("sit_btn_buy")) {
				$("#sit_ov_btn .sit_btn_buy").trigger("click");
			}
		});

		if (window.location.href.split("#").length > 1) {
			let id = window.location.href.split("#")[1];
			$("#btn_" + id).trigger("click");
		};
	});
</script>