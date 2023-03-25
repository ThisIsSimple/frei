<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="' . G5_SHOP_CSS_URL . '/style.css">', 0);
?>
<div id="frei-item-form" class="fixed bottom-0 left-0 right-0 z-30 w-full bg-transparent px-8">
	<form name="fitem" method="post" action="<?php echo $action_url; ?>" onsubmit="return fitem_submit(this);">
		<input type="hidden" name="it_id[]" value="<?php echo $it_id; ?>">
		<input type="hidden" name="sw_direct">
		<input type="hidden" name="url">

		<div class="grid grid-cols-2 gap-4">
			<!-- 상품 요약정보 및 구매 시작 { -->
			<section class="2017_renewal_itemform col-start-2 col-end-2 text-primary p-3">
				<h2 id="sit_title" class="font-righteous"><?php echo stripslashes($it['it_name']); ?></h2>
				<!-- <p id="sit_desc"><?php echo $it['it_basic']; ?></p> -->
				<!-- <?php if ($is_orderable) { ?>
					<p id="sit_opt_info">
						상품 선택옵션 <?php echo $option_count; ?> 개, 추가옵션 <?php echo $supply_count; ?> 개
					</p>
				<?php } ?> -->

				<div class="sit_info hidden">
					<table class="sit_ov_tbl">
						<tbody>
							<?php if (!$it['it_use']) { // 판매가능이 아닐 경우 
							?>
								<tr>
									<th scope="row">판매가격</th>
									<td>판매중지</td>
								</tr>
							<?php } else if ($it['it_tel_inq']) { // 전화문의일 경우 
							?>
								<tr>
									<th scope="row">판매가격</th>
									<td>전화문의</td>
								</tr>
							<?php } else { // 전화문의가 아닐 경우
							?>
								<?php if ($it['it_cust_price']) { ?>
									<tr>
										<th scope="row">시중가격</th>
										<td><?php echo display_price($it['it_cust_price']); ?></td>
									</tr>
								<?php } // 시중가격 끝 
								?>

								<tr class="tr_price">
									<th scope="row">판매가격</th>
									<td>
										<strong><?php echo display_price(get_price($it)); ?></strong>
										<input type="hidden" id="it_price" value="<?php echo get_price($it); ?>">
									</td>
								</tr>
							<?php } ?>
							<!-- 
							<?php if ($it['it_maker']) { ?>
								<tr>
									<th scope="row">제조사</th>
									<td><?php echo $it['it_maker']; ?></td>
								</tr>
							<?php } ?>

							<?php if ($it['it_origin']) { ?>
								<tr>
									<th scope="row">원산지</th>
									<td><?php echo $it['it_origin']; ?></td>
								</tr>
							<?php } ?>

							<?php if ($it['it_brand']) { ?>
								<tr>
									<th scope="row">브랜드</th>
									<td><?php echo $it['it_brand']; ?></td>
								</tr>
							<?php } ?>

							<?php if ($it['it_model']) { ?>
								<tr>
									<th scope="row">모델</th>
									<td><?php echo $it['it_model']; ?></td>
								</tr>
							<?php } ?> -->

							<?php
							/* 재고 표시하는 경우 주석 해제
	            <tr>
	                <th scope="row">재고수량</th>
	                <td><?php echo number_format(get_it_stock_qty($it_id)); ?> 개</td>
	            </tr>
	            */
							?>

							<tr>
								<th><?php echo $ct_send_cost_label; ?></th>
								<td><?php echo $sc_method; ?></td>
							</tr>
							<?php if ($it['it_buy_min_qty']) { ?>
								<tr>
									<th>최소구매수량</th>
									<td><?php echo number_format($it['it_buy_min_qty']); ?> 개</td>
								</tr>
							<?php } ?>
							<?php if ($it['it_buy_max_qty']) { ?>
								<tr>
									<th>최대구매수량</th>
									<td><?php echo number_format($it['it_buy_max_qty']); ?> 개</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<?php
				if ($option_item) {
				?>
					<!-- 선택옵션 시작 { -->
					<section class="sit_option">
						<h3>선택옵션</h3>

						<?php // 선택옵션
						echo $option_item;
						?>
					</section>
					<!-- } 선택옵션 끝 -->
				<?php
				}
				?>

				<?php
				if ($supply_item) {
				?>
					<!-- 추가옵션 시작 { -->
					<section class="sit_option">
						<h3>추가옵션</h3>
						<?php // 추가옵션
						echo $supply_item;
						?>
					</section>
					<!-- } 추가옵션 끝 -->
				<?php
				}
				?>

				<?php if ($is_orderable) { ?>
					<!-- 선택된 옵션 시작 { -->
					<section id="sit_sel_option">
						<h3>선택된 옵션</h3>
						<?php
						if (!$option_item) {
							if (!$it['it_buy_min_qty'])
								$it['it_buy_min_qty'] = 1;
						?>
							<ul id="sit_opt_added">
								<li class="sit_opt_list">
									<input type="hidden" name="io_type[<?php echo $it_id; ?>][]" value="0">
									<input type="hidden" name="io_id[<?php echo $it_id; ?>][]" value="">
									<input type="hidden" name="io_value[<?php echo $it_id; ?>][]" value="<?php echo $it['it_name']; ?>">
									<input type="hidden" class="io_price" value="0">
									<input type="hidden" class="io_stock" value="<?php echo $it['it_stock_qty']; ?>">
									<!-- <div class="opt_name">
										<span class="sit_opt_subj"><?php echo $it['it_name']; ?></span>
									</div> -->
									<div class="flex justify-between items-center border-y-2 border-primary py-3">
										<div class="opt_count">
											<label for="ct_qty_<?php echo $i; ?>" class="mr-3">수량</label>
											<button type="button" class="sit_qty_minus" data-type="감소"><i class="fa fa-minus" aria-hidden="true"></i></button>
											<input type="text" name="ct_qty[<?php echo $it_id; ?>][]" value="<?php echo $it['it_buy_min_qty']; ?>" id="ct_qty_<?php echo $i; ?>" class="num_input text-center" size="5">
											<button type="button" class="sit_qty_plus" data-type="증가"><i class="fa fa-plus" aria-hidden="true"></i></button>
											<!-- <span class="sit_opt_prc">+0원</span> -->
										</div>
										<!-- 총 구매액 -->
										<div id="sit_tot_price"></div>
									</div>
								</li>
							</ul>
							<script>
								$(function() {
									price_calculate();
								});
							</script>
						<?php } ?>
					</section>
					<!-- } 선택된 옵션 끝 -->
				<?php } ?>

				<?php if ($is_soldout) { ?>
					<p id="sit_ov_soldout">상품의 재고가 부족하여 구매할 수 없습니다.</p>
				<?php } ?>

				<div class="flex py-3">
					<?php if ($is_orderable) { ?>
						<button type="submit" onclick="document.pressed=this.value;" value="장바구니" class="w-full">장바구니 담기</button>
						<span class="mx-3">|</span>
						<button type="submit" onclick="document.pressed=this.value;" value="바로구매" class="w-full">바로 주문하기</button>
					<?php } ?>
					<?php if (!$is_orderable && $it['it_soldout'] && $it['it_stock_sms']) { ?>
						<a href="javascript:popup_stocksms('<?php echo $it['it_id']; ?>');" id="sit_btn_alm">재입고알림</a>
					<?php } ?>
					<?php if ($naverpay_button_js) { ?>
						<div class="itemform-naverpay"><?php echo $naverpay_request_js . $naverpay_button_js; ?></div>
					<?php } ?>
				</div>
			</section>
			<!-- } 상품 요약정보 및 구매 끝 -->
		</div>
	</form>
</div>

<script>
	// 스크롤에 따라서 옵션 선택 추척 변경
	$(function() {
		const handleScroll = () => {
			if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 150) {
				$('#frei-item-form').removeClass("fixed px-8")
				$('#frei-item-form').addClass("absolute")
			} else {
				$('#frei-item-form').addClass("fixed px-8")
				$('#frei-item-form').removeClass("absolute")
			}
		}
		$(window).on('scroll', handleScroll)
	})
</script>

<script>
	$(function() {
		// 상품이미지 첫번째 링크
		$("#sit_pvi_big a:first").addClass("visible");

		// 상품이미지 미리보기 (썸네일에 마우스 오버시)
		$("#sit_pvi .img_thumb").bind("mouseover focus", function() {
			var idx = $("#sit_pvi .img_thumb").index($(this));
			$("#sit_pvi_big a.visible").removeClass("visible");
			$("#sit_pvi_big a:eq(" + idx + ")").addClass("visible");
		});

		// 상품이미지 크게보기
		$(".popup_item_image").click(function() {
			var url = $(this).attr("href");
			var top = 10;
			var left = 10;
			var opt = 'scrollbars=yes,top=' + top + ',left=' + left;
			popup_window(url, "largeimage", opt);

			return false;
		});
	});

	function fsubmit_check(f) {
		// 판매가격이 0 보다 작다면
		if (document.getElementById("it_price").value < 0) {
			alert("전화로 문의해 주시면 감사하겠습니다.");
			return false;
		}

		if ($(".sit_opt_list").length < 1) {
			alert("상품의 선택옵션을 선택해 주십시오.");
			return false;
		}

		var val, io_type, result = true;
		var sum_qty = 0;
		var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
		var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
		var $el_type = $("input[name^=io_type]");

		$("input[name^=ct_qty]").each(function(index) {
			val = $(this).val();

			if (val.length < 1) {
				alert("수량을 입력해 주십시오.");
				result = false;
				return false;
			}

			if (val.replace(/[0-9]/g, "").length > 0) {
				alert("수량은 숫자로 입력해 주십시오.");
				result = false;
				return false;
			}

			if (parseInt(val.replace(/[^0-9]/g, "")) < 1) {
				alert("수량은 1이상 입력해 주십시오.");
				result = false;
				return false;
			}

			io_type = $el_type.eq(index).val();
			if (io_type == "0")
				sum_qty += parseInt(val);
		});

		if (!result) {
			return false;
		}

		if (min_qty > 0 && sum_qty < min_qty) {
			alert("선택옵션 개수 총합 " + number_format(String(min_qty)) + "개 이상 주문해 주십시오.");
			return false;
		}

		if (max_qty > 0 && sum_qty > max_qty) {
			alert("선택옵션 개수 총합 " + number_format(String(max_qty)) + "개 이하로 주문해 주십시오.");
			return false;
		}

		return true;
	}

	// 바로구매, 장바구니 폼 전송
	function fitem_submit(f) {
		f.action = "<?php echo $action_url; ?>";
		f.target = "";

		if (document.pressed == "장바구니") {
			f.sw_direct.value = 0;
		} else { // 바로구매
			f.sw_direct.value = 1;
		}

		// 판매가격이 0 보다 작다면
		if (document.getElementById("it_price").value < 0) {
			alert("전화로 문의해 주시면 감사하겠습니다.");
			return false;
		}

		if ($(".sit_opt_list").length < 1) {
			alert("상품의 선택옵션을 선택해 주십시오.");
			return false;
		}

		var val, io_type, result = true;
		var sum_qty = 0;
		var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
		var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
		var $el_type = $("input[name^=io_type]");

		$("input[name^=ct_qty]").each(function(index) {
			val = $(this).val();

			if (val.length < 1) {
				alert("수량을 입력해 주십시오.");
				result = false;
				return false;
			}

			if (val.replace(/[0-9]/g, "").length > 0) {
				alert("수량은 숫자로 입력해 주십시오.");
				result = false;
				return false;
			}

			if (parseInt(val.replace(/[^0-9]/g, "")) < 1) {
				alert("수량은 1이상 입력해 주십시오.");
				result = false;
				return false;
			}

			io_type = $el_type.eq(index).val();
			if (io_type == "0")
				sum_qty += parseInt(val);
		});

		if (!result) {
			return false;
		}

		if (min_qty > 0 && sum_qty < min_qty) {
			alert("선택옵션 개수 총합 " + number_format(String(min_qty)) + "개 이상 주문해 주십시오.");
			return false;
		}

		if (max_qty > 0 && sum_qty > max_qty) {
			alert("선택옵션 개수 총합 " + number_format(String(max_qty)) + "개 이하로 주문해 주십시오.");
			return false;
		}

		return true;
	}
</script>
<?php /* 2017 리뉴얼한 테마 적용 스크립트입니다. 기존 스크립트를 오버라이드 합니다. */ ?>
<script src="<?php echo G5_JS_URL; ?>/shop.override.js"></script>