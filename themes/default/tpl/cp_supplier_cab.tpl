<?if(isset($_SESSION['errm'])){	foreach($_SESSION['errm'] as $msg){		if(!is_array($msg)){?>			<div class="msg-error">				<p><?=$msg?></p>			</div>		<?}?>		<script type="text/javascript">			$('html, body').animate({				scrollTop: 0			}, 500, "easeInOutCubic");		</script>	<?}}?><div id="supplier_cab" class="cabinet_content row">	<?if($cabinet_page == 'settings'){?>		<div id="kalendar_content" data-type="modal">			<div class="modal-container">				<table border="0" cellpadding="0" width="100%">					<colgroup>						<col width="50%">						<col width="50%">					</colgroup>					<tr>						<th>Дата</th>						<th>Рабочий день</th>					</tr>				</table>				<div class="table_wrapp">					<table border="0" cellpadding="0" width="100%">						<colgroup>							<col width="50%">							<col width="50%">						</colgroup>						<?foreach($cal as $c){?>							<tr>								<td>									<p><?=$c['date_dot']?>, <span<?if(isset($c['red'])){?> class="color-red"<?}?>><?=$c['d_word']?></span></p>								</td>								<td>									<p>										<input id="day<?=$c['date_']?>" type="checkbox" <?if($c['active'] == 0){?>disabled="disabled"<?}?> <?if($c['day']){?>checked="checked"<?}?> onchange="SwitchSupplierDate('<?=$c['date_dot']?>')">									</p>								</td>							</tr>						<?}?>					</table>				</div>			</div>		</div>		<div class="sett_cabinet col-md-12">			<div id="popup_msg" class="history">				<div class="msg-warning">					<p>Пожалуйста подождите, осуществляется пересчет цен ассортимента.</p>				</div>			</div>			<div class="cabinet_block fleft">				<div class="dollar">					<form action="" method="post" onsubmit="RecalcSupplierCurrency();return false;">						<label for="currency_rate">Личный курс доллара</label>						<input type="text" name="currency_rate" id="currency_rate" value="<?=$supplier['currency_rate']?>">						<!-- <button type="button" class="recalculate btn-m-blue fright" onclick="RecalcSupplierCurrency();">Перерасчитать</button> -->						<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" onclick="RecalcSupplierCurrency();">Пересчитать</button>						<input type="hidden" id="currency_rate_old" value="<?=$supplier['currency_rate']?>">					</form>					<p class="checksum">Контрольная сумма - <b><?=$check_sum['checksum']?> грн</b></p>				</div>				<div class="calendar clearfix">					<label>Дата последней отметки о рабочем дне:						<span id="next_update_date">							<?if($supplier['next_update_date']){								$tarr = explode("-",$supplier['next_update_date']);								echo $tarr[2].".".$tarr[1].".".$tarr[0];							}else{								echo "Нет";							}?>						</span>					</label>					<button type="button" id="kalendar" name="update_calendar1" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Отправить</button>					<button type="button" id="kalendar" class="open_modal btn-m-blue fright" data-target="kalendar_content">Календарь</button>				</div>				<form class="work_days_add" action="<?=$GLOBALS['URL_request']?>" method="post">					<label for="start_date" class="fleft">С даты:						<input type="date" name="start_date" id="start_date" value="<?=date("Y-m-d", time());?>"/>					</label>					<label for="num_days" class="fleft">Количество дней (от 10 до 90):						<input type="number" name="num_days" id="num_days" min="10" max="90" value="90" pattern="[0-9]{2}"/>					</label>					<button type="submit" name="update_calendar1" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Отправить</button>				</form>			</div>			<div class="form_block fright">				<form action="<?=Link::Custom('cabinet', 'price');?>" method="post">					<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Форма сверки цен</button>				</form>				<form action="<?=Link::Custom('cabinet', 'price1');?>" method="post">					<button name="price" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Новая форма с ценами</button>					<button name="no-price" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Новая форма без цен</button>					<button name="wide" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Сверх-новая форма с ценами</button>				</form>			</div>		</div>	<?}	if($cabinet_page == 'assortment'){?>		<?if(isset($cnt) && $cnt >= 30){?>			<div class="sort_page_top col-md-12">				<a href="<?=Link::Custom('cabinet', 'assortment');?>limitall/"<?=(isset($_GET['limit'])&&$_GET['limit']=='all')?'class="active"':null?>>Показать все</a>			</div>		<?}?>		<div class="col-md-12">			<input type="hidden" name="currency_rate" id="currency_rate" value="<?=$supplier['currency_rate'];?>">			<table width="100%" cellspacing="0" border="1" class="supplier_assort_table thead table">				<colgroup>					<col width="57%">					<col width="10%">					<col width="10%">					<col width="10%">					<col width="10%">					<col width="3%">				</colgroup>				<thead>					<tr>						<th>Название</th>						<th>Остаток товара</th>						<th>Минимальное<br>количество</th>						<th class="price_1">							<p>Цена отпускная мин. к-ва</p>							<div class="switcher_container">								<div id="switcher" class="only_price <?=(isset($supplier['single_price']) && $supplier['single_price'] == 1)?'On':'Off'?> fright">									<div class="switch animate"></div>								</div>Единая цена								<!-- <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-2">									<input type="checkbox" id="switch-2" class="mdl-switch__input">									<span class="mdl-switch__label"></span>								</label> -->							</div>						</th>						<th class="price_2">Цена отпускная ящиком</th>						<th>$</th>					</tr>				</thead>			</table>			<table width="100%" cellspacing="0" border="1" class="table table_tbody">				<colgroup>					<col width="3%">					<col width="10%">					<col width="44%">					<col width="10%">					<col width="10%">					<col width="10%">					<col width="10%">					<col width="3%">				</colgroup>				<tbody>					<?if(count($list)){						foreach($list as $i){?>							<tr id="tr_mopt_<?=$i['id_product']?>" class="<?=isset($_SESSION['Assort']['products'][$i['id_product']]['active']) && $_SESSION['Assort']['products'][$i['id_product']]['active']?'available':'notavailable'?>">								<td class="removeFromAssort">									<a href="#" onclick="DelFromAssort(<?=$i['id_product']?>);return false;" class="icon-font" id="remove<?=$i['id_product']?>" title="Удалить"><i class="material-icons">close</i></a>									<div class="mdl-tooltip" for="remove<?=$i['id_product']?>">Удалить</div>								</td>								<td class="photo_cell">									<?if($i['image'] != ''){?>										<a href="<?=file_exists($GLOBALS['PATH_root'].$i['image'])?_base_url.htmlspecialchars($i['image']):'/efiles/_thumb/nofoto.jpg'?>">											<img alt="" height="90" src="http://xt.ua<?=str_replace("/original/", "/thumb/", $i['image'])?>">											<!-- <img alt="" height="90" src="<?=file_exists($GLOBALS['PATH_root'].str_replace("/original/", "/thumb/", $i['image']))?_base_url.htmlspecialchars(str_replace("/original/", "/thumb/", $i['image'])):'/efiles/_thumb/nofoto.jpg'?>"> -->										</a>									<?}else{?>										<a href="<?=_base_url.htmlspecialchars($i['img_1'])?>">											<img alt="" height="90" src="http://xt.ua<?=htmlspecialchars(str_replace("/efiles/", "/efiles/_thumb/", $i['img_1']))?>">											<!-- <img alt="" height="90" src="<?=_base_url.htmlspecialchars(str_replace("/efiles/", "/efiles/_thumb/", $i['img_1']))?>"> -->										</a>									<?}?>								</td>								<td class="name_cell" data-idproduct="<?=$i['id_product']?>">									<a href="<?=Link::Product($i['translit']);?>">										<?=G::CropString($i['name'])?>									</a>									<!-- <a href="#" class="err_mark btn_js" data-name="err_mark"><i class="material-icons" id="edit<?=$i['id_product']?>">edit</i></a> -->									<p class="sub">арт. <?=$i['art']?>										<?if(is_array($price_products) && in_array($i['id_product'], $price_products)){?>											<span class="pricelist_item">Товар в прайс-листе</span>										<?}?>									</p>									<?if((isset($i['min_opt_price']) == true && $_SESSION['Assort']['products'][$i['id_product']]['price_opt_otpusk'] > 0 && $_SESSION['Assort']['products'][$i['id_product']]['price_opt_otpusk'] > $i['min_opt_price']) || (isset($i['min_mopt_price']) == true && $_SESSION['Assort']['products'][$i['id_product']]['price_mopt_otpusk'] > 0 && $_SESSION['Assort']['products'][$i['id_product']]['price_mopt_otpusk'] > $i['min_mopt_price'])){?>										<p style="color:#f00;">Ваш товар заблокирован для продажи.<br>Рекомендованная цена:										<?if($_SESSION['Assort']['products'][$i['id_product']]['price_mopt_otpusk'] > 0 && $_SESSION['Assort']['products'][$i['id_product']]['price_mopt_otpusk'] > $i['min_mopt_price']){											echo "от миним. к-ва <".($i['min_mopt_price']-0.01)." грн.";										}										if(($_SESSION['Assort']['products'][$i['id_product']]['price_opt_otpusk'] > 0 && $_SESSION['Assort']['products'][$i['id_product']]['price_opt_otpusk'] > $i['min_opt_price']) && ($_SESSION['Assort']['products'][$i['id_product']]['price_mopt_otpusk'] > 0 && $_SESSION['Assort']['products'][$i['id_product']]['price_mopt_otpusk'] > $i['min_mopt_price'])){											echo ", ";										}										if($_SESSION['Assort']['products'][$i['id_product']]['price_opt_otpusk'] > 0 && $_SESSION['Assort']['products'][$i['id_product']]['price_opt_otpusk'] > $i['min_opt_price']){											echo "от ящика <".($i['min_opt_price']-0.01)." грн.";										}?>										</p>									<?}?>								</td>								<td>									<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-<?=$i['id_product']?>">										<input type="checkbox" name="product_limit_checkbox" id="checkbox-<?=$i['id_product']?>" class="mdl-checkbox__input" data-id-product="<?=$i['id_product']?>" data-koef="<?=$supplier['koef_nazen_mopt']?>" data-supp="<?=$i['sup_comment']?>" <?=isset($_SESSION['Assort']['products'][$i['id_product']]['product_limit']) && $_SESSION['Assort']['products'][$i['id_product']]['product_limit'] > 0?'checked':null;?>>									</label>									<!-- <a href="#" onclick="$('#product_limit_mopt_<?=$i['id_product']?>').val(parseInt($('#product_limit_mopt_<?=$i['id_product']?>').val())+1000000000); toAssort(<?=$i['id_product']?>, 0, <?=$supplier['koef_nazen_mopt']?>, '<?=$i['sup_comment']?>'); return false;">Вкл</a><br> -->									<input type="hidden" id="product_limit_mopt_<?=$i['id_product']?>" value="<?=isset($_SESSION['Assort']['products'][$i['id_product']]['product_limit'])?$_SESSION['Assort']['products'][$i['id_product']]['product_limit']:"0"?>" class="input_table">									<!-- <a href="#" onclick="$('#product_limit_mopt_<?=$i['id_product']?>').val(0); toAssort(<?=$i['id_product']?>, 0, <?=$supplier['koef_nazen_mopt']?>, '<?=$i['sup_comment']?>'); return false;">Выкл</a> -->								</td>								<td>									<p id="min_mopt_qty_<?=$i['id_product']?>"><?=$i['min_mopt_qty']?> <?=$i['units']?><?=$i['qty_control']?" *":null?></p>								</td>								<td class="price_1">									<?if($i['inusd'] == 1){?>										<input type="text" id="price_mopt_otpusk_<?=$i['id_product']?>" value="<?=isset($_SESSION['Assort']['products'][$i['id_product']]['price_mopt_otpusk_usd'])?round($_SESSION['Assort']['products'][$i['id_product']]['price_mopt_otpusk_usd'], 3):"0"?>" class="usd_price input_table" onchange="toAssort(<?=$i['id_product']?>, 0,  <?=$supplier['koef_nazen_mopt']?>, '<?=$i['sup_comment']?>')">									<?}else{?>										<input type="text" id="price_mopt_otpusk_<?=$i['id_product']?>" value="<?=isset($_SESSION['Assort']['products'][$i['id_product']]['price_mopt_otpusk'])?round($_SESSION['Assort']['products'][$i['id_product']]['price_mopt_otpusk'], 2):"0"?>" class="uah_price input_table" onchange="toAssort(<?=$i['id_product']?>, 0,  <?=$supplier['koef_nazen_mopt']?>, '<?=$i['sup_comment']?>')">									<?}?>								</td>								<td class="price_2">									<?if($i['inusd'] == 1){?>										<input type="text" id="price_opt_otpusk_<?=$i['id_product']?>" value="<?=isset($_SESSION['Assort']['products'][$i['id_product']]['price_opt_otpusk_usd'])?round($_SESSION['Assort']['products'][$i['id_product']]['price_opt_otpusk_usd'], 3):"0"?>" class="usd_price input_table" onchange="toAssort(<?=$i['id_product']?>, 1, <?=$supplier['koef_nazen_opt']?>, '<?=$i['sup_comment']?>')">									<?}else{?>										<input type="text" id="price_opt_otpusk_<?=$i['id_product']?>" value="<?=isset($_SESSION['Assort']['products'][$i['id_product']]['price_opt_otpusk'])?round($_SESSION['Assort']['products'][$i['id_product']]['price_opt_otpusk'], 2):"0"?>" class="uah_price input_table" onchange="toAssort(<?=$i['id_product']?>, 1, <?=$supplier['koef_nazen_opt']?>, '<?=$i['sup_comment']?>')">									<?}?>								</td>								<td>									<form>										<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="inusd-<?=$i['id_product']?>">											<input type="checkbox" name="product_limit" id="inusd-<?=$i['id_product']?>" class="mdl-checkbox__input inusd<?=$i['id_product']?>" <?=$i['inusd'] == 1?'checked':null;?> value="1">										</label>										<!-- <input type="checkbox" <?=$i['inusd'] == 1?'checked="checked"':'';?> class="inusd<?=$i['id_product']?>" style="float: none !important; margin: 0 auto;"  onclick="SetInUSD(<?=$i['id_product']?>, <?=$supplier['koef_nazen_mopt']?>, <?=$supplier['koef_nazen_opt']?>, '<?=$i['sup_comment']?>'); return false;" value="1"> -->									</form>								</td>							</tr>						<?}					}?>				</tbody>			</table>			<!-- <style>				@import url("//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css");			</style>			<div class="dialog_duplicate hidden" title="Отметка дубля">				<input type="hidden" name="id">				<p>Отметить товар <span></span> как дубль.</p>				<br>				<input type="text" name="duplicate_comment" placeholder="Артикул основного товара">				<button class="btn-m-green" onclick="">Отправить</button>			</div> -->			<div id="err_mark" data-type="modal">				<div class="modal_container">					<h4>Отметка об ошибке</h4>					<hr>					<p>Увидели ошибку или дубль товара,<br>напишите, пожалуйста.</p>					<form action="" method="post">						<input type="hidden" name="id_product">						<textarea name="feedback_text" id="feedback_text" cols="30" rows="8" required></textarea>						<button type="submit" name="sub_com" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Отправить</button>					</form>				</div>			</div>			<?if(isset($cnt) && $cnt >= 30){?>				<div class="sort_page">					<a href="<?=Link::Custom('cabinet', 'assortment');?>limitall"<?=(isset($_GET['limit'])&&$_GET['limit']=='all')?'class="active"':null?>>Показать все</a>				</div>			<?}?>			<?=isset($GLOBALS['paginator_html'])?$GLOBALS['paginator_html']:null?>			<div class="add_functions fleft">				<div class="add_items1">					<p>Цены в гривнах, &#8372;</p>					<hr>					<form action="<?=$GLOBALS['URL_request']?>export" method="post">						<button type="submit" class="export_excel btn-m-blue">Экспортировать в Excel</button>					</form>					<hr>					<form action="<?=$GLOBALS['URL_request']?>" method="post" enctype="multipart/form-data">						<button type="submit" name="smb_import" class="import_excel btn-m-blue">Импортировать</button>						<input type="file" name="import_file" required="required" class="file_select">					</form>				</div>			</div>			<div class="add_functions fright">				<div class="add_items1">					<p>Цены в долларах, $</p>					<hr>					<form action="<?=$GLOBALS['URL_request']?>export_usd" method="post">						<button type="submit" class="export_excel btn-m-green">Экспортировать в Excel</button>					</form>					<hr>					<form action="<?=$GLOBALS['URL_request']?>" method="post" enctype="multipart/form-data">						<button type="submit" name="smb_import_usd" class="import_excel btn-m-green">Импортировать</button>						<input type="file" name="import_file" required="required" class="file_select">					</form>				</div>			</div>			<?if(isset($total_updated)){?><br>Обновлено: <?=$total_updated?><?}?>			<?if(isset($total_added)){?><br>Добавленио: <?=$total_added?><?}?>		</div>	<?}?></div><script>	<?if($supplier['single_price'] == 0){?>		TogglePriceColumns("Off");	<?}else{?>		TogglePriceColumns("On");	<?}?>	$(function(){		$('[class^="duplicate_check_"]').on('click', function(e){			e.preventDefault();			$('.dialog_duplicate').dialog('open');			var id = $(this).prop('class').replace(/[^0-9\.]+/g, '');			var art = $(this).next().val();			$('.dialog_duplicate input[name="id"]').val(id);			$('.dialog_duplicate p span').text(art);			var onclick='ToggleDuplicate('+id+',<?=$_SESSION["member"]["id_user"]?>, $(\'.dialog_duplicate input[name="duplicate_comment"]\').val());$(\'.dialog_duplicate\').dialog(\'close\');$(\'.duplicate_check_'+id+'\').prop(\'checked\', true);$(\'.duplicate_check_'+id+'\').prop(\'disabled\', true);';			$('.dialog_duplicate button').attr('onclick', onclick);		});		$('.switch').click(function(){			var single_price;			if($(this).closest('#switcher').hasClass('Off')){				if(window.confirm('Для каждого товара, вместо двух цен, будет установлена единая цена.\nПроверьте, пожалуйста, цены после выполнения.')){					$(this).closest('#switcher').toggleClass('On').toggleClass('Off');					if($(this).closest('#switcher').hasClass('On')){						// document.cookie = "onlyprice=On;";						TogglePriceColumns('On');						single_price = 1;					}else{						// document.cookie = "onlyprice=Off;";						TogglePriceColumns('Off');						single_price = 0;					}				}			}else{				$(this).closest('#switcher').toggleClass('On').toggleClass('Off');				if($(this).closest('#switcher').hasClass('On')){					// document.cookie = "onlyprice=On;";					TogglePriceColumns('On');					single_price = 1;				}else{					// document.cookie = "onlyprice=Off;";					TogglePriceColumns('Off');					single_price = 0;				}			}			$.ajax({				url: '/ajaxsuppliers',				type: "POST",				dataType : "json",				data:({					"action": 'toggle_single_price',					"id_supplier": '<?=$supplier['id_user'];?>',					"single_price": single_price				}),			});		});		$('td.price_1 input').keyup(function(){			var id = $(this).attr('id').replace(/\D+/g,"");			if($('#switcher').hasClass('On')){				$('#price_opt_otpusk_'+id).val($(this).val());				$(this).blur(function(){					$('#price_opt_otpusk_'+id).change();				});			}		});		$('.err_mark').on('click', function() {			var id = $(this).closest('.name_cell').attr('data-idproduct');			$('#err_mark [name="id_product"]').val(id);		});	});	function TogglePriceColumns(action){		if(action == 'On'){			$('.price_1').css({				"width": "20%"			});			$('th.price_1 p').text('Цена отпускная');			$('.price_2').css({				"display": "none"			});			$('.switcher_container').css({				"width": "100%"			});			$.each($('td.price_1 input'), function(){				var id = $(this).attr('id').replace(/\D+/g,"");				if($('#price_opt_otpusk_'+id).val() !== $('#price_mopt_otpusk_'+id).val()){					if($('#price_opt_otpusk_'+id).val() == '0,00'){						$('#price_opt_otpusk_'+id).val($('#price_mopt_otpusk_'+id).val()).change();					}else{						$('#price_mopt_otpusk_'+id).val($('#price_opt_otpusk_'+id).val()).change();					}				}			});		}else{			$('.price_1').css({				"width": "10%"			});			$('th.price_1 p').text('Цена отпускная мин. к-ва');			$('.price_2').css({				"display": "table-cell"			});			$('.switcher_container').css({				"width": "200%"			});			$.each($('td.price_1 input'), function(){				var id = $(this).attr('id').replace(/\D+/g,"");			});		}	}	//Фиксация Заголовка таблицы	$(window).scroll(function(){			console.log($('.supplier_assort_table').offset().top - $('header').outerHeight());		if($(this).scrollTop() >= 86){			if(!$('.supplier_assort_table.thead').hasClass('fixed_thead')){				var width = $('.table_tbody').width();				$('.supplier_assort_table.thead').css("width", width).addClass('fixed_thead');				$('.table_tbody').css("margin-top", "65px");			}		}else{			if($('.supplier_assort_table.thead').hasClass('fixed_thead')){				$('.supplier_assort_table.thead').removeClass('fixed_thead');				$('.table_tbody').css("margin-top", "0");			}		}	});</script>