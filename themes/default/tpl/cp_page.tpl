<div id="content">
	<!--<?if($GLOBALS['CurrentController'] == 'main'){?>
		<input type="checkbox" id="read_more" class="hidden">
		<div class="content_page">
			<?=$data['new_content']?>
		</div>
		<?if(strlen($data['new_content']) >= 500){?>
			<label for="read_more">Читать полностью</label>
		<?}?>
	<?}else{?>
		<div class="content_page">
			<?=$data['new_content']?>
		</div>
	<?}?>
	<?if(isset($sdescr)){
		echo $sdescr;
	}?>-->

	<!-- Страница "Доставка" -->
	<!-- <div id="page_delivery" class="page_delivery hidden">
		<div class="blockline">
			<img class="delivery1 forflex" src="/themes/default/images/page/delivery/delivery1.png" alt="">
			<h1>Доставка</h1>
		</div>
		<div class="blockline flexwrapp">
			<div class="forflex blockOfText">
				<h4>Доставка транспортной <br>компанией</h4>
				<div>
					<p>Отправим удобным перевозчиком:</p>
					<p>1. Запомните ТТН и номер отделения</p>
					<p>2. При получении проверьте товар</p>
					<p>3. Оплатите услуги перевозчика</p>
				</div>
			</div>
			<div class="forflex">
				<img class="delivery4" src="/themes/default/images/page/delivery/delivery4.png" alt="">
			</div>
		</div>
		<div class="blockline flexwrapp flexWrapReverse">
			<video id="movie" width="495" height="278" src="/themes/default/images/page/delivery/delivery3.mp4" autoplay loop></video>
			<div class="forflex blockOfText ">
				<h4>XT доставка</h4>
				<p>Наша логистика работает за счёт <br>собственного автопарка.</p>
			</div>
		</div>
		<div class="blockline flexwrapp">
			<div class="forflex blockOfText">
				<h4>Самовывоз</h4>
				<p>Производится с парковочных стоянок <br>ТЦ Барабашово, а еще у нас бесплатная <br>доставка товара до парковки.</p>
			</div>
			<div class="forflex">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1282.2924160061052!2d36.29807765817873!3d50.00039271893146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTDCsDAwJzAxLjQiTiAzNsKwMTcnNTcuMCJF!5e0!3m2!1sru!2sru!4v1455287401346" width="495" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
		<div class="blockline">
			<img class="delivery5" src="/themes/default/images/page/delivery/delivery5.png" alt="">
		</div>
	</div> -->

	<!-- Страница "Справка" -->
	<!-- <div id="page_information" class="page_information ">
		<div class="blockline">
			<img class="info0" src="/themes/default/images/page/info/info0.png" alt="">
			<h1>Справка</h1>
		</div>
		<div class="blockline flexwrapp">
			<div id="infoBlock1" class="info_block forflex" data-target="ppp1">
				<img src="/themes/default/images/page/info/info1.png" alt="someimg">
				<h4>Гарантия и<br>сервис</h4>
			</div>
			<div id="infoBlock2" class="info_block forflex" data-target="ppp2">
				<img src="/themes/default/images/page/info/info2.png" alt="someimg">
				<h4>Вопросы и<br>ответы</h4>
			</div>
			<div id="infoBlock3" class="info_block forflex" data-target="ppp3">
				<img src="/themes/default/images/page/info/info3.png" alt="someimg">
				<h4>Оплата и<br>доставка</h4>
			</div>
		</div>
		<div class="blockforline hidden">
			<div class="block1"></div>
			<div class="block2"></div>
		</div>
		<div id="info_text_block_service" class="ppp1 blockline flexwrapp hidden">
			<section class="ac-container">
				<div>
					<input id="ab-1" name="accordion-1" type="checkbox" />
					<label for="ab-1">На какие товары предоставляется гарантия?</label>
					<article class="ac-large">
						<p>На товары в нашем магазине предоставляется гарантия, подтверждающая обязательства по отсутствию в товаре заводских дефектов. Гарантия предоставляется на срок от 2-х недель до 36 месяцев в зависимости от сервисной политики производителя. Срок гарантии указан в описании каждого товара на нашем сайте. Подтверждением гарантийных обязательств служит гарантийный талон производителя, или гарантийный талон "ROZETKA — online супермаркет продвинутой электроники".
						Пожалуйста, проверьте комплектность и отсутствие дефектов в товаре при его получении (комплектность определяется описанием изделия или руководством по его эксплуатации).</p>
					</article>
				</div>
				<div>
					<input id="ab-2" name="accordion-1" type="checkbox" />
					<label for="ab-2">Куда обращаться за гарантийным обслуживанием?</label>
					<article class="ac-large">
						<p>Гарантийным обслуживанием занимаются сервисные центры, авторизованные производителями.
						Адреса и телефоны сервисных центров вы можете найти на гарантийном талоне или по адресу — полный список сервисных центров.

						Право на бесплатное гарантийное обслуживание дает гарантийный талон, в котором указываются:

						модель;
						серийный номер;
						гарантийный срок;
						дата продажи товара.

						Пожалуйста, сохраняйте его в течение всего срока эксплуатации.

						Срок ремонта определяется авторизованным СЦ, в случае возникновения проблем с сервис-партнером, вы можете обратиться в точку продажи.</p>
					</article>
				</div>
				<div>
					<input id="ab-3" name="accordion-1" type="checkbox" />
					<label for="ab-3">Я могу обменять или вернуть товар?</label>
					<article class="ac-large">
						<p>Да, вы можете обменять или вернуть товар в течение 14 дней после покупки. Это право гарантирует вам «Закон о защите прав потребителя».

						Чтобы использовать эту возможность, пожалуйста убедитесь что:

						- товар, не был в употреблении и не имеет следов использования: царапин, сколов, потёртостей, на счётчике телефона не более 5 минут разговоров, программное обеспечение не подвергалось изменениям и т. п.;
						- товар полностью укомплектован и не нарушена целостность упаковки;
						- сохранены все ярлыки и заводская маркировка.

						Если товар не работает, обмен или возврат товара производится только при наличии заключения сервисного центра, авторизованного производителем, о том, что условия эксплуатации не нарушены.</p>
					</article>
				</div>
				<div>
					<input id="ab-4" name="accordion-1" type="checkbox" />
					<label for="ab-4">Где и как можно произвести обмен или возврат?</label>
					<article class="ac-large">
						<p>Обменять или вернуть товар можно в нашем сервисном отделе по адресу:

						г. Киев, улица Ярославская, 57 c понедельника по пятницу с 10-00 до 19-00, в субботу — с 10-00 до 17-00.

						Сервисный отдел раздела "Бытовая техника и интерьер" находится по адресу г. Киев, улица Фрунзе, 40.


						При возврате товара нужно иметь при себе паспорт. Мы вернем деньги в день возврата товара или, в случае отсутствия денег в кассе, не позже, чем через 7 дней.

						Если вы живете не в Киеве, можете отправить товар обратно тем же способом, которым вы его получили, например с помощью "Новой Почты". Если у товара сохранён товарный вид и упаковка, мы обменяем его вам или вернём деньги.</p>
					</article>
				</div>
				<div>
					<input id="ab-5" name="accordion-1" type="checkbox" />
					<label for="ab-5">Сервисный центр не может отремонтировать мой товар в гарантийный период</label>
					<article class="ac-large">
						<p>Если в гарантийный период товар, который вы у нас купили, вышел из строя по вине производителя и не может быть отремонтирован в авторизованном сервисном центре, мы обменяем товар на аналогичный или вернём деньги.

						Для этого, пожалуйста, предоставьте нам:

						- товар с полной комплектацией;
						- гарантийный талон;
						- документ подтверждающий оплату;
						- заключение сервисного центра с отметкой о том, что товар имеет «существенный недостаток».</p>
					</article>
				</div>
				<div>
					<input id="ab-6" name="accordion-1" type="checkbox" />
					<label for="ab-6">В каких случаях гарантия не предоставляется?</label>
					<article class="ac-large">
						<p>Сервисный центр может отказать в гарантийном ремонте если:

						- нарушена сохранность гарантийных пломб;
						- есть механические или иные повреждения, которые возникли вследствие умышленных или неосторожных действий покупателя или третьих лиц;
						- нарушены правила использования, изложенные в эксплуатационных документах;
						- было произведено несанкционированное вскрытие, ремонт или изменены внутренние коммуникации и компоненты товара, изменена конструкция или схемы товара;
						- неправильно заполнен гарантийный талон;
						- серийный или IMEI номер, находящийся в памяти изделия, изменён, стёрт или не может быть установлен.

						Гарантийные обязательства не распространяются на следующие неисправности:

						- естественный износ или исчерпание ресурса;
						- случайные повреждения, причиненные клиентом или повреждения, возникшие вследствие небрежного отношения или использования (воздействие жидкости, запыленности, попадание внутрь корпуса посторонних предметов и т. п.);
						- повреждения в результате стихийных бедствий (природных явлений);
						- повреждения, вызванные аварийным повышением или понижением напряжения в электросети или неправильным подключением к электросети;
						- повреждения, вызванные дефектами системы, в которой использовался данный товар, или возникшие в результате соединения и подключения товара к другим изделиям;
						- повреждения, вызванные использованием товара не по назначению или с нарушением правил эксплуатации.

						Согласно статьи 9 Закона Украины «О защите прав потребителей». Кабинетом Министров Украины утвержден перечень товаров надлежащего качества, которые не подлежат обмену или возврату.

						К таким товарам относятся:

						перопуховые изделия
						детские игрушкимягкие
						детские игрушки резиновые надувные
						перчатки
						тюлегардинные и кружевные полотна
						белье нательное
						белье постельное
						чулочно-носочныеизделия
						печатные издания
						диски для лазерных систем считывания с записью
						товары для новорожденных (пеленки, соски, бутылочки для кормления т.д.)
						товары для личной гигиены (например: эпиляторы, электробритвы, машинки для стрижки волос)
						продовольственные товары (детское питание и т.д.)</p>
					</article>
				</div>
				<label><a class="a_question" href="#">Не нашли ответ на свой вопрос?</a></label>
			</section>
		</div>
		<div id="info_text_block_answers" class="ppp2 blockline flexwrapp hidden">
			<section class="ac-container">
				<div>
					<input id="ac-1" name="accordion-2" type="checkbox" />
					<label for="ac-1">Какой у вас график работы?</label>
					<article class="ac-large">
						<p>Мы работаем по следующему графику:</p>

						<p>Call-центр:</p>

						<p>- понедельник — пятница: с 8-00 до 21-00; </p>
						<p>- суббота: с 9-00 до 20-00; </p>
						<p>- воскресенье: с 10-00 до 19-00.</p>

						<p>Магазины в г. Киев, ул. Ярославская, 57 и г. Одесса, ул. Балковская, 199:</p>

						<p>- понедельник — пятница: с 10-00 до 21-00; </p>
						<p>- суббота: с 10-00 до 19-00; </p>
						<p>- воскресенье: с 10-00 до 17-00.</p>
					</article>
				</div>
				<div>
					<input id="ac-2" name="accordion-2" type="checkbox" />
					<label for="ac-2">Я хочу обменять или вернуть товар. Какой график работы у сервисного отдела?</label>
					<article class="ac-small">
						<p>Сервисный отдел работает: c понедельника по пятницу с 10-00 до 19-00, в субботу — с 10-00 до 17-00. По адресу: г. Киев, улица Ярославская, 57</p>
					</article>
				</div>
				<div>
					<input id="ac-3" name="accordion-2" type="checkbox" />
					<label for="ac-3">На сайте указано, что товара нет в наличии, можно ли его заказать?</label>
					<article class="ac-small">
						<p>Вы можете оставить свой адрес электронной почты и мы пришлем Вам уведомление, как только товар появится в наличии.</p>
					</article>
				</div>
				<div>
					<input id="ac-4" name="accordion-2" type="checkbox" />
					<label for="ac-4">Какие преимущества дает регистрация?</label>
					<article class="ac-small">
						<p>Регистрация позволяет вам:
							- просматривать историю своих заказов;
							- получать по электронной почте рассылку о новинках и акциях Розетки.
							Логином для входа (т. е. полем, по которому система сможет вас распознать) является адрес электронной почты.
						</p>
					</article>
				</div>
				<div>
					<input id="ac-5" name="accordion-2" type="checkbox" />
					<label for="ac-5">Как отменить заказ?</label>
					<article class="ac-small">
						<p>Вы можете отменить заказ по телефону (044) 537-0-222 или (044) 503-80-80.</p>
					</article>
				</div>
				<div>
					<input id="ac-6" name="accordion-2" type="checkbox" />
					<label for="ac-6">Что делать, если оплаченный товар не доставлен?</label>
					<article class="ac-small">
						<p>Мы страхуем весь товар, который отправляем в другие города. В случае отсутствия (по каким-либо причинам) Вашего товара в офисе перевозчика, мы в течение 2 — 3 дней отправим Вам новый товар.</p>
					</article>
				</div>
				<div>
					<input id="ac-7" name="accordion-2" type="checkbox" />
					<label for="ac-7">Какая гарантия, что после предоплаты заказа я его получу?</label>
					<article class="ac-medium">
						<p>У вас остаются два документа, которые подтверждают наше с Вами сотрудничество: выписанная нами счет-фактура и документ об оплате, который предоставляет банк. При перечислении денег у нас возникает долговое обязательство перед Вами. Оно погашается только после подписания накладной, которую Вам привезет курьер.

						Таким образом, у Вас есть все рычаги влияния на нас: суд, общество защиты прав потребителей и прочие. Также Ваши интересы защищает закон "О защите прав потребителей".</p>
					</article>
				</div>
				<div>
					<input id="ac-8" name="accordion-2" type="checkbox" />
					<label for="ac-8">Какая гарантия, что отправляемый товар не подменят в пути?</label>
					<article class="ac-small">
						<p>Любой товар сопровождается заполненным гарантийным талоном, в котором указан его серийный номер. Таким образом, любая подмена исключена.</p>
					</article>
				</div>
				<label><a class="a_question" href="#">Не нашли ответ на свой вопрос?</a></label>
			</section>
		</div>
		<div id="info_text_block_delivery" class="ppp3 blockline flexwrapp hidden">
			<section class="ac-container">
				<div>
					<input id="ad-1" name="accordion-3" type="checkbox" />
					<label for="ad-1">Куда и на каких условиях осуществляется доставка?</label>
					<article class="ac-large">
						<p>Условия доставки зависят от региона. Мы доставляем товары по всей Украине, кроме АР Крым и некоторых регионов Донецкой и Луганской областей.

						Вы также можете сами забрать заказ в нашем магазине в г. Киев, в точках в крупных городах и в отделениях Новой Почты.

						Условия доставки бытовой техники и товаров от других продавцов несколько отличаются от остальных товаров.</p>
					</article>
				</div>
				<div>
					<input id="ad-2" name="accordion-3" type="checkbox" />
					<label for="ad-2">Как я могу оплатить свой заказ?</label>
					<article class="ac-small">
						<p>Сейчас доступны такие способы оплаты:
							- наличная оплата;
							- безналичная оплата
							- оплата картами Visa и MasterCard

							<a>Мы постарались также дать ответы на другие вопросы, касающиеся оплаты.</a></p>
					</article>
				</div>
				<div>
					<input id="ad-3" name="accordion-3" type="checkbox" />
					<label for="ad-3">Как осуществляется доставка по Киеву?</label>
					<article class="ac-small">
						<p>Доставка в пределах Киева при заказе на сумму свыше 1500 грн бесплатна
							Стоимость доставки товаров до 1500 грн составляет 35 грн.

							Товары из разделов "Активный отдых и туризм", "Дом, сад", "Музыкальные инструменты", "Детский мир", "Одежда и обувь", "Косметика и парфюмерия" доставляются бесплатно при сумме заказа от 500 грн.

							Товары из раздела "Бытовая техника и интерьер" по Киеву доставляются бесплатно при сумме заказа от 1500 грн, стоимость доставки заказов до 1500 грн составляет 35 грн. Доставка товаров из данного раздела по Киеву и Украине осуществляется отдельно от доставки товаров из других разделов сайта.

							Наш курьер продемонстрирует работоспособность товара (для устройств, работающих автономно) и оформит все необходимые документы:

							- гарантийный талон;
							- документ, подтверждающий оплату.

							Время доставки:

							- понедельник — пятница: с 9:00 до 21:00;
							- суббота — с 10:00 до 19:00;
							- воскресенье: с 10:00 до 17:00.</p>
					</article>
				</div>
				<div>
					<input id="ad-4" name="accordion-3" type="checkbox" />
					<label for="ad-4">Как осуществляется доставка по Киевской области?</label>
					<article class="ac-small">
						<p>Стоимость доставки — 35 грн

							Стоимость доставки бытовой техники составляет 4 грн. за км, от черты Киева, в одну сторону (расстояние до 30 км).

							Сроки доставки по Киевской области озвучивает менеджер при оформлении заказа.</p>
					</article>
				</div>
				<div>
					<input id="ad-5" name="accordion-3" type="checkbox" />
					<label for="ad-5">Как осуществляется доставка по Украине?</label>
					<article class="ac-small">
						<p>- Новая Почта
							- Точки выдачи в областных центрах
							- Мист Экспресс

							<a>Подробнее о доставке по Украине
							</a>
							Стоимость доставки товаров из раздела "Бытовая техника и интерьер" определяется по тарифам компаний-перевозчиков: <a>узнать подробнее</a>.</p>
					</article>
				</div>
				<div>
					<input id="ad-6" name="accordion-3" type="checkbox" />
					<label for="ad-6">Можно ли приехать к вам в офис?</label>
					<article class="ac-small">
						<p>Да, наши магазины расположены по адресу
							г. Киев, ул. Ярославская, 57
							Для товаров из раздела "Бытовая техника и интерьер" только г. Киев, ул.Фрунзе, 40
							Вы сможете посмотреть товары вживую и купить то, что понравится. Если Вы хотите какой-то конкретный товар, можно предварительно уточнить его наличие по телефону. Если этого товара не окажется в магазине, мы доставим его со склада к Вашему приходу</p>
					</article>
				</div>
				<div>
					<input id="ad-7" name="accordion-3" type="checkbox" />
					<label for="ad-7">Как можно оплатить заказ наличными?</label>
					<article class="ac-medium">
						<p>Оплата наличными при получении товара возможна во всех населенных пунктах на территории Украины.
						Оплата производится исключительно в национальной валюте.
						В подтверждение оплаты мы выдаем Вам товарный чек.</p>
					</article>
				</div>
				<div>
					<input id="ad-8" name="accordion-3" type="checkbox" />
					<label for="ad-8">Как оплатить товар по безналичному расчету? Являетесь ли вы плательщиком НДС?</label>
					<article class="ac-small">
						<p>Вы можете оплатить заказ банковским переводом либо с помощью платежных карт Visa и MasterCard любого банка.

						Позвоните или напишите нам и мы отправим Вам счет-фактуру по электронной почте или по факсу. Мы являемся плательщиками НДС и налога на прибыль на общих основаниях.

						При получении товара вы получите все необходимые документы:

						- гарантийный талон;
						- расходную накладную;
						- налоговую накладную.

						Оплатить заказ картами Visa и MasterCard можно только при оформлении заказа через сайт</p>
					</article>
				</div>
				<div>
					<input id="ad-9" name="accordion-3" type="checkbox" />
					<label for="ad-9">Что нужно для получения товара, оплаченного по безналичному расчету?</label>
					<article class="ac-small">
						<p>Для частных лиц:

							- паспорт.

							Для юридических лиц и СПД:

							- доверенность, выписанная на предъявителя
							- копия свидетельства плательщика НДС (если есть).

							Без оформления доверенности товар может получить директор предприятия лично, с заверением расходных накладных круглой печатью предприятия</p>
					</article>
				</div>
				<div>
					<input id="ad-10" name="accordion-3" type="checkbox" />
					<label for="ad-10">Возможна ли оплата заказа банковской картой?</label>
					<article class="ac-small">
						<p>Вы можете оплатить заказ онлайн любой картой Visa и MasterCard любого банка без комиссии.
						Оплата с помощью платежных карт осуществляется следующим способом:
						во время оформления заказа на сайте, Вам будет предложено сделать выбор способа оплаты. В графе "Оплата" вам нужно выбрать «Visa/MasterCard». После этого Вы будете переадресованы на страницу системы безопасных платежей ПриватБанка, где Вам необходимо будет подтвердить оплату.
						Пожалуйста, обратите внимание, получить товар, оплаченный платежной картой, может только тот клиент, на ФИО которого оформлен заказ, поэтому при получении заказа обязательно нужно иметь при себе паспорт.</p>
					</article>
				</div>
				<label><a class="a_question" href="#">Не нашли ответ на свой вопрос?</a></label>
			</section>
		</div>

		<div class="blockline">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit adipisci pariatur, nihil laboriosam fugit, laborum. Quisquam, iure blanditiis voluptatibus, quibusdam deserunt nobis vero quaerat cupiditate, animi consequatur sed vel facilis.</p>
			<p>Qui, magni, adipisci molestiae temporibus nulla aperiam optio doloribus commodi velit delectus beatae et eligendi. Quae quia, voluptates illum sint dolorem mollitia iste nostrum rem. Provident corrupti esse reiciendis molestiae.</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit adipisci pariatur, nihil laboriosam fugit, laborum. Quisquam, iure blanditiis voluptatibus, quibusdam deserunt nobis vero quaerat cupiditate, animi consequatur sed vel facilis.</p>
			<p>Qui, magni, adipisci molestiae temporibus nulla aperiam optio doloribus commodi velit delectus beatae et eligendi. Quae quia, voluptates illum sint dolorem mollitia iste nostrum rem. Provident corrupti esse reiciendis molestiae.</p>
		</div>

		<div id="question" data-type="modal">
			<div class="modal_container blockForForm">
				<div class="mdl-card__supporting-text">
					<p>Вы можете задать свой вопрос и получить ответ по электронной почте</p>
					<form action="">
						<div class="mdl-textfield mdl-js-textfield">
							<input class="mdl-textfield__input" type="text" id="sample1">
							<label class="mdl-textfield__label" for="sample1">Email...</label>
						</div><br>
						<div class="mdl-textfield mdl-js-textfield">
							<textarea class="mdl-textfield__input" type="text" rows= "3" id="sample5" ></textarea>
							<label class="mdl-textfield__label" for="sample5">Вопрос...</label>
						</div><br>
					</form>
				</div>
				<div class="mdl-card__actions mdl-card--border">
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Задать вопрос</button>
				</div>
			</div>
		</div>
	</div> -->

	<!-- Страница "Оплата" -->
	<div id="page_payment" class="page_payment " >
		<div class="blockline">
			<img class="payment0" src="/themes/default/images/page/payment/payment0.png" alt="">
			<h1>Оплата</h1>
		</div>

		<!-- Аккордеон оплата -->
		<div id="info_text_block_answers" class="ppp2 blockline flexwrapp">
			<section class="ac-container">
				<div>
					<input id="ac-1" name="accordion-2" type="checkbox" />
					<label for="ac-1">
						<img src="/themes/default/images/page/payment/payment1.png" alt="someimg">
						<h4>Он-лайн оплата</h4>
					</label>
					<article class="ac-large">
						<div>
							<img src="/themes/default/images/page/payment/privat24.png" alt="">
							<h5>Система проведения платежей Приват24</h5>
							<p>0,5% или по тарифам карты, кредитка 3%</p>
						</div>
						<div>
							<img src="/themes/default/images/page/payment/paypal.png" alt="">
							<h5>Система проведения платежей PayPal</h5>
							<p>1% от суммы или мин 5 грн, если карта зарубежного банка то 1,95 дол + 1%</p>
						</div>
						<div>
							<img src="/themes/default/images/page/payment/webmoney.png" alt="">
							<h5>WebMoney</h5>
							<p>по курсу на момент оплаты + 1%</p>
						</div>
					</article>
				</div>
				<div>
					<input id="ac-2" name="accordion-2" type="checkbox" />
					<label for="ac-2">
						<img src="/themes/default/images/page/payment/payment2.png" alt="someimg">
						<h4>Офф-лайн оплата</h4>
					</label>
					<article class="ac-large">
						<div class="forflex">
							<h5>Пополнение карточного счёта через терминал</h5>
							<p>согласно тарифов банка 0,5%</p>
						</div>
						<div class="forflex">
							<h5>Пополнение карточного счёта в отделении банка</h5>
							<p>согласно тарифов банка (ПриватБанк 2грн. + 0,5% от суммы)</p>
						</div>
					</article>
				</div>
				<div>
					<input id="ac-3" name="accordion-2" type="checkbox" />
					<label for="ac-3">
						<img src="/themes/default/images/page/payment/payment3.png" alt="someimg">
						<h4>Наличный расчёт</h4>
					</label>
					<article class="ac-large">
						<div class="forflex">
							<h5>Наложенный платеж (Новая Почта, Интайм, Деливери, Автолюкс)</h5>
							<p>20грн. + 2% в качестве комиссии перевозчику</p>
						</div>
						<div class="forflex">
							<h5>Оплата наличными при доставке (доставка нашим транспортом)</h5>
							<p>без переплат</p>
						</div>
						<div class="forflex">
							<h5>Наличный расчет (оплата в точке выдачи)</h5>
							<p>без переплат</p>
						</div>
					</article>
				</div>
				<div>
					<input id="ac-4" name="accordion-2" type="checkbox" />
					<label for="ac-4">
						<img src="/themes/default/images/page/payment/payment4.png" alt="someimg">
						<h4>Безналичный расчёт</h4>
					</label>
					<article class="ac-large">
						<h5>Безналичный расчёт, без НДС</h5>
						<p>1% обналичка, 4% заморозка цен</p>
					</article>
				</div>
				<!-- <div>
					<input id="ac-5" name="accordion-2" type="checkbox" />
					<label for="ac-5">Как отменить заказ?</label>
					<article class="ac-small">
						<p>Вы можете отменить заказ по телефону (044) 537-0-222 или (044) 503-80-80.</p>
					</article>
				</div>
				<div>
					<input id="ac-6" name="accordion-2" type="checkbox" />
					<label for="ac-6">Что делать, если оплаченный товар не доставлен?</label>
					<article class="ac-small">
						<p>Мы страхуем весь товар, который отправляем в другие города. В случае отсутствия (по каким-либо причинам) Вашего товара в офисе перевозчика, мы в течение 2 — 3 дней отправим Вам новый товар.</p>
					</article>
				</div>
				<div>
					<input id="ac-7" name="accordion-2" type="checkbox" />
					<label for="ac-7">Какая гарантия, что после предоплаты заказа я его получу?</label>
					<article class="ac-medium">
						<p>У вас остаются два документа, которые подтверждают наше с Вами сотрудничество: выписанная нами счет-фактура и документ об оплате, который предоставляет банк. При перечислении денег у нас возникает долговое обязательство перед Вами. Оно погашается только после подписания накладной, которую Вам привезет курьер.

						Таким образом, у Вас есть все рычаги влияния на нас: суд, общество защиты прав потребителей и прочие. Также Ваши интересы защищает закон "О защите прав потребителей".</p>
					</article>
				</div>
				<div>
					<input id="ac-8" name="accordion-2" type="checkbox" />
					<label for="ac-8">Какая гарантия, что отправляемый товар не подменят в пути?</label>
					<article class="ac-small">
						<p>Любой товар сопровождается заполненным гарантийным талоном, в котором указан его серийный номер. Таким образом, любая подмена исключена.</p>
					</article>
				</div>
				<label><a class="a_question" href="#">Не нашли ответ на свой вопрос?</a></label-->
			</section>
		</div>
		<!-- Аккордеон оплата конец-->

	<div id="PaymentBlockMain">
		<div class="blockline flexwrapp">
			<div id="paymentBlock1" class="payment_block forflex" data-target="ppp1">
				<img src="/themes/default/images/page/payment/payment1.png" alt="someimg">
				<h4>Он-лайн <br>оплата</h4>
			</div>
			<div id="paymentBlock2" class="payment_block forflex" data-target="ppp2">
				<img src="/themes/default/images/page/payment/payment2.png" alt="someimg">
				<h4>Офф-лайн <br>оплата</h4>
			</div>
			<div id="paymentBlock3" class="payment_block forflex" data-target="ppp3">
				<img src="/themes/default/images/page/payment/payment3.png" alt="someimg">
				<h4>Наличный <br>расчёт</h4>
			</div>
			<div id="paymentBlock4" class="payment_block forflex" data-target="ppp4">
				<img src="/themes/default/images/page/payment/payment4.png" alt="someimg">
				<h4>Безналичный <br>расчёт</h4>
			</div>
		</div>

		<div class="blockforline hidden">
			<div class="block1"></div>
			<div class="block2"></div>
		</div>

		<div id="info_text_block_on_line" class="ppp1 blockline styleFortext hidden">
			<div>
				<img src="/themes/default/images/page/payment/privat24.png" alt="">
				<h5>Система проведения платежей Приват24</h5>
				<p>0,5% или по тарифам карты, кредитка 3%</p>
			</div>
			<div>
				<img src="/themes/default/images/page/payment/paypal.png" alt="">
				<h5>Система проведения платежей PayPal</h5>
				<p>1% от суммы или мин 5 грн, если карта зарубежного банка то 1,95 дол + 1%</p>
			</div>
			<div>
				<img src="/themes/default/images/page/payment/webmoney.png" alt="">
				<h5>WebMoney</h5>
				<p>по курсу на момент оплаты + 1%</p>
			</div>
		</div>
		<div id="info_text_block_off_line" class="ppp2 blockline styleFortext hidden">
			<div class="forflex">
				<h5>Пополнение карточного счёта через терминал</h5>
				<p>согласно тарифов банка 0,5%</p>
			</div>
			<div class="forflex">
				<h5>Пополнение карточного счёта в отделении банка</h5>
				<p>согласно тарифов банка (ПриватБанк 2грн. + 0,5% от суммы)</p>
			</div>
		</div>
		<div id="info_text_block_payment_1" class="ppp3 blockline styleFortext hidden">
			<div class="forflex">
				<h5>Наложенный платеж (Новая Почта, Интайм, Деливери, Автолюкс)</h5>
				<p>20грн. + 2% в качестве комиссии перевозчику</p>
			</div>
			<div class="forflex">
				<h5>Оплата наличными при доставке (доставка нашим транспортом)</h5>
				<p>без переплат</p>
			</div>
			<div class="forflex">
				<h5>Наличный расчет (оплата в точке выдачи)</h5>
				<p>без переплат</p>
			</div>
		</div>
		<div id="info_text_block_payment_2" class="ppp4 blockline styleFortext hidden">
			<h5>Безналичный расчёт, без НДС</h5>
			<p>1% обналичка, 4% заморозка цен</p>
		</div>
	</div>
		<!-- <div class="blockline">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit adipisci pariatur, nihil laboriosam fugit, laborum. Quisquam, iure blanditiis voluptatibus, quibusdam deserunt nobis vero quaerat cupiditate, animi consequatur sed vel facilis.</p>
			<p>Qui, magni, adipisci molestiae temporibus nulla aperiam optio doloribus commodi velit delectus beatae et eligendi. Quae quia, voluptates illum sint dolorem mollitia iste nostrum rem. Provident corrupti esse reiciendis molestiae.</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit adipisci pariatur, nihil laboriosam fugit, laborum. Quisquam, iure blanditiis voluptatibus, quibusdam deserunt nobis vero quaerat cupiditate, animi consequatur sed vel facilis.</p>
			<p>Qui, magni, adipisci molestiae temporibus nulla aperiam optio doloribus commodi velit delectus beatae et eligendi. Quae quia, voluptates illum sint dolorem mollitia iste nostrum rem. Provident corrupti esse reiciendis molestiae.</p>
		</div> -->
	</div>

	<!-- Страница "O нас" -->
	<!-- <div id="page_about_us" class="page_about_us ">
		<div class="blockline">
			<img class="about1" src="/themes/default/images/page/about/about1.png" alt="">
			<h1>Немного о нас</h1>
			<p>XT - служба снабжения,<br>поставляющая товары непродовольственной<br>группы на предприятия, в магазины и<br>домашние хозяйства.</p>
		</div>
		<div class="blockline">
			<h4>Что мы создали</h4>
			<p>1500 человек со всей Украины ежедневно покупают на XT, а так же мы ежедневно поставляем товары в 42 предприятия.</p>
			<div class="second_line_img">
				<img class="about2" src="/themes/default/images/page/about/about2.png" alt="">
				<p class="text1">
					<span>7,000</span><br>оптовых клиентов регулярно производят закупки на XT
				</p>
				<p class="text2">
					<span>140,000</span><br>товаров в ассортименте
				</p>
			</div>
		</div>
		<div class="blockline">
			<h4>Что мы ценим</h4>
			<p>Мы стремимся к простоте и прозрачности. Работая с XT клиент всегда уверен в соответствии каталога складу, а доставка - всегда своевременна. Ещё, мы действительно гордимся нашими оптовыми скидками.</p>
			<img class="about3" src="/themes/default/images/page/about/about3.png" alt="">
		</div>
		<div class="blockline">
			<h4>Наша миссия</h4>
			<p>Опираясь на многолетний опыт, качественно и быстро решаем задачи снабжения каждой компании, создавая комфортные условия для бизнеса.</p>
			<div class="members hidden">
				<div class="member">
					<div class="divForPhoto"><img src="" alt=""></div>
					<p class="person">Виталий Пасичник</p>
					<p class="person_post">Основатель<br>компании</p>
				</div>
				<div class="member">
					<div class="divForPhoto"><img src="" alt=""></div>
					<p class="person">Николай Козлов</p>
					<p class="person_post">Заместитель<br>директора</p>
				</div>
				<div class="member">
					<div class="divForPhoto"><img src="" alt=""></div>
					<p class="person">Елена Пальчик</p>
					<p class="person_post">Финансовый<br>директор</p>
				</div>
				<div class="member">
					<div class="divForPhoto"><img src="" alt=""></div>
					<p class="person">Валентина Игушева</p>
					<p class="person_post">Руководитель отдела<br>кадров</p>
				</div>
				<div class="member">
					<div class="divForPhoto"><img src="" alt=""></div>
					<p class="person">Диана Жердева</p>
					<p class="person_post">Motion graphics<br>дизайнер</p>
				</div>
				<div class="member">
					<div class="divForPhoto"><img src="" alt=""></div>
					<p class="person">Оксана Вишневская</p>
					<p class="person_post">Старший менеджер по<br>продажам</p>
				</div>
				<div class="member">
					<div class="divForPhoto"><img src="" alt=""></div>
					<p class="person">Виталий Чуприна</p>
					<p class="person_post">Руководитель отдела<br>логистики</p>
				</div>
				<div class="member">
					<div class="divForPhoto"><img src="" alt=""></div>
					<p class="person">Наталья Ясинская</p>
					<p class="person_post">Главный<br>бухгалтер</p>
				</div>
				<div class="member">
					<div class="divForPhoto"><img src="" alt=""></div>
					<p class="person">Владимир Моисеенко</p>
					<p class="person_post">Системный<br>администратор</p>
				</div>
				<div class="member">
					<div class="divForPhoto"><img src="" alt=""></div>
					<p class="person">Алена Гвоздик</p>
					<p class="person_post">Руководитель отдела<br> продаж</p>
				</div>
			</div>
		</div>
		<div class="blockline">
			<img class="about4" src="/themes/default/images/page/about/about4.png" alt="">
			<h4>Мы стараемся ради Вас!<br>Присоединяйтесь!</h4>
		</div>
	</div> -->


	<!-- Страница "Поставки магазинам" -->
 	<!-- <div id="page_supply" class="page_supply four_pages hidden">
		<div class="blockline">
			<img class="main_img forflex" src="/themes/default/images/page/supply/supply0.png" alt="">
			<h1>Поставки магазинам</h1>
		</div>
		<div class="blockline">
			<a href="#" class="pos-left btn_plus">
				<span>+</span><p>Как это работает</p>
			</a>
			<div class="container flexwrapp">
				<div class="forflex blockOfText">
					<h4>Закупайте своевременно</h4>
					<p>Используйте нашу статистику, чтобы не прогадать сезон.</p>
				</div>
				<video class="forflex" width="495" height="278" src="/themes/default/images/page/supply/supply1.mp4" autoplay loop>
				</video>
			</div>
		</div>
		<div class="invisibleblock blockline">
			<div class="flexwrapp">
				<div class="info_circle forflex">
					<h5>Выбор<br>сезона</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Выберите сезон на графике</p>
				</div>
				<div class="info_circle forflex">
					<h5>Просмотр<br>товаров</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Мы покажем информацию о сезонном спросе</p>
				</div>
			</div>
		</div>
		<div class="blockline">
			<a href="#" class="pos-right btn_plus">
				<span>+</span><p>Как это работает</p>
			</a>
			<div class="container flexwrapp flexWrapReverse">
				<video class="forflex" width="495" height="278" src="/themes/default/images/page/supply/supply2.mp4" autoplay loop>
				</video>
				<div class="forflex blockOfText ">
					<h4>Экономьте на опте</h4>
					<p>Выберите свой бюджет и получите лучшую скидку на размере чека.</p>
				</div>
			</div>
		</div>
		<div class="invisibleblock">
			<div class="flexwrapp">
				<div class="info_circle forflex">
					<h5>Выбор<br>скидки</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Для изменения цен на сайте используйте палитру скидок</p>
				</div>
				<div class="info_circle forflex">
					<h5>Контроль<br>бюджета</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Выбирайте скидку, исходя из своего бюджета</p>
				</div>
			</div>
		</div>
		<div class="blockline">
			<a href="#" class="pos-left btn_plus">
				<span>+</span><p>Как это работает</p>
			</a>
			<div class="container flexwrapp">
				<div class="forflex blockOfText">
					<h4>Покупайте вместе</h4>
					<p>Расширяйте чек вместе с друзьями и получайте ещё большую скидку.</p>
				</div>
				<video class="forflex" width="495" height="278" src="/themes/default/images/page/supply/supply3.mp4" autoplay loop>
				</video>
			</div>
		</div>
		<div class="invisibleblock">
			<div class="flexwrapp">
				<div class="info_circle forflex">
					<h5>Добавление<br>друга</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Используйте вкладку "Участники" в информации о Вашем заказе</p>
				</div>
			</div>
		</div>
		<div class="blockline">
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Перейти к каталогу для магазинов</button>
		</div>
	</div> -->

	<!-- Страница "Обеспечение быта" -->
	<!-- <div id="page_provision" class="page_provision four_pages hidden">
		<div class="blockline">
			<img class="main_img forflex" src="/themes/default/images/page/provision/provision0.png" alt="">
			<h1>Обеспечение быта</h1>
		</div>
		<div class="blockline">
			<a href="#" class="pos-left btn_plus">
				<span>+</span><p>Как это работает</p>
			</a>
			<div class="container flexwrapp">
				<div class="forflex blockOfText">
					<h4>Оптовые цены</h4>
					<p>150 000 товаров для Вашего дома дешевле чем в ближайшем магазине.</p>
				</div>
				<video class="forflex" width="495" height="278" src="/themes/default/images/page/provision/provision1.mp4" autoplay loop>
				</video>
			</div>
		</div>
		<div class="invisibleblock blockline">
			<div class="flexwrapp">
				<div class="info_circle forflex">
					<h5>Каталог</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Здесь есть всё для дома</p>
				</div>
				<div class="info_circle forflex">
					<h5>Оптовая скидка</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Получайте скидку на количестве</p>
				</div>
			</div>
		</div>
		<div class="blockline">
			<a href="#" class="pos-right btn_plus">
				<span>+</span><p>Как это работает</p>
			</a>
			<div class="container flexwrapp flexWrapReverse">
				<div class="forflex"><img class="provision2" src="/themes/default/images/page/provision/provision2.png" alt=""></div>
				<div class="forflex blockOfText ">
					<h4>Поштучная покупка</h4>
					<p>Здесь нет минимального чека, отправим даже пару перчаток.</p>
				</div>
			</div>
		</div>
		<div class="invisibleblock">
			<div class="flexwrapp">
				<div class="info_circle forflex">
					<h5>Выбор<br>скидки</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Для изменения цен на сайте используйте палитру скидок</p>
				</div>
				<div class="info_circle forflex">
					<h5>Контроль<br>бюджета</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Выбирайте скидку, исходя из своего бюджета</p>
				</div>
			</div>
		</div>
		<div class="blockline">
			<a href="#" class="pos-left btn_plus">
				<span>+</span><p>Как это работает</p>
			</a>
			<div class="container flexwrapp">
				<div class="forflex blockOfText">
					<h4>Покупайте вместе</h4>
					<p>Приглашайте друзей к заказу и получайте настоящие оптовые скидки.</p>
				</div>
				<video width="495" height="278" src="/themes/default/images/page/provision/provision3.mp4" autoplay loop></video>
			</div>
		</div>
		<div class="invisibleblock">
			<div class="flexwrapp">
				<div class="info_circle">
					<h5>Коллективная покупка</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Используйте вкладку "Участники" в информации о Вашем заказе</p>
				</div>
			</div>
		</div>
		<div class="blockline">
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Перейти к каталогу для магазинов</button>
		</div>
	</div> -->

	<!-- Страница "Скидки" -->
	<!-- <div id="page_discounts" class="page_discounts four_pages hidden">
		<div class="blockline">
			<img class="main_img forflex" src="/themes/default/images/page/discounts/discounts0.png" alt="">
			<h1>Скидки</h1>
		</div>
		<div class="blockline">
			<a href="#" class="pos-left btn_plus">
				<span>+</span><p>Как это работает</p>
			</a>
			<div class="container flexwrapp">
				<div class="forflex blockOfText">
					<h4>Скидка на упаковке</h4>
					<p>Покупайте продукцию упаковками и получайте оптовую скидку до 5%.</p>
				</div>
				<div class="forflex"><img src="/themes/default/images/page/discounts/discounts1.png" alt=""></div>
			</div>
		</div>
		<div class="invisibleblock blockline">
			<div class="flexwrapp">
				<div class="info_circle forflex">
					<h5>Каталог</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Здесь есть всё для дома</p>
				</div>
				<div class="info_circle forflex">
					<h5>Оптовая скидка</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Получайте скидку на количестве</p>
				</div>
			</div>
		</div>
		<div class="blockline">
			<div class="container flexwrapp flexWrapReverse">
				<div class="forflex"><img src="/themes/default/images/page/discounts/discounts2.png" alt=""></div>
				<div class="forflex blockOfText">
					<h4>Скидка на паллету</h4>
					<p>Покупайте продукцию от 10,000 грн. и получайте скидку.</p>
				</div>
			</div>
		</div>
		<div class="invisibleblock blockline">
		</div>
		<div class="blockline">
			<a href="#" class="pos-left btn_plus">
				<span>+</span><p>Как это работает</p>
			</a>
			<div class="container flexwrapp">
				<div class="forflex blockOfText ">
					<h4>Скидка на размере чека</h4>
					<p>Выберите свой бюджет и получите дополнительную скидку на размере чека до 21%.</p>
				</div>
				<video class="forflex" id="" width="495" height="278" src="/themes/default/images/page/discounts/discounts3.mp4" autoplay loop>
				</video>
			</div>
		</div>
		<div class="invisibleblock">
			<div class="flexwrapp">
				<div class="info_circle forflex">
					<h5>Выбор<br>скидки</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Для изменения цен на сайте используйте палитру скидок</p>
				</div>
				<div class="info_circle forflex">
					<h5>Контроль<br>бюджета</h5>
					<div class="info_circle_img"><img src="" alt=""></div>
					<p>Выбирайте скидку, исходя из своего бюджета</p>
				</div>
			</div>
		</div>
		<div class="blockline">
			<a href="#" class="pos-right btn_plus">
				<span>+</span><p>Как это работает</p>
			</a>
			<div class="container flexwrapp flexWrapReverse">
				<video width="495" height="278" src="/themes/default/images/page/discounts/discounts4.mp4" autoplay loop></video>
				<div class="forflex blockOfText">
					<h4>Программа лояльности</h4>
					<p>Зарегестрированный пользователь получает бонусы за покупки и расходует их по своему усмотрению.</p>
				</div>
			</div>
		</div>
		<div class="invisibleblock">
			<div class="flexwrapp block_circles two_inline">
				<div class="info_circle forflex">
					<h5>1</h5>
					<img src="/themes/default/images/page/discounts/circle1.png" alt="">
					<p>Оформите заказ на 500 грн</p>
				</div>
				<div class="info_circle forflex">
					<h5>2</h5>
					<img src="/themes/default/images/page/discounts/circle2.png" alt="">
					<p>Активируйте бонусную карту в кабинете</p>
				</div>
			</div>
			<div class="flexwrapp block_circles two_inline">
				<div class="info_circle forflex">
					<h5>3</h5>
					<img src="/themes/default/images/page/discounts/circle3.png" alt="">
					<p>Получите первые 20 грн. на счет</p>
				</div>
				<div class="info_circle forflex">
					<h5>4</h5>
					<img src="/themes/default/images/page/discounts/circle4.png" alt="">
					<p>Получите несгораемый 1% от суммы заказа, оформленного в течении 30 дней</p>
				</div>
			</div>
			<div class="flexwrapp block_circles two_inline">
				<div class="info_circle forflex">
					<h5>5</h5>
					<img src="/themes/default/images/page/discounts/circle5.png" alt="">
					<p>Получите 2% от суммы третьего заказа, оформленного в течении 30 дней</p>
				</div>
				<div class="info_circle forflex">
					<h5>6</h5>
					<img src="/themes/default/images/page/discounts/circle6.png" alt="">
					<p>Получите 3% от суммы четвертого и более заказа, оформленного в течении 30 дней</p>
				</div>
			</div>
		</div>
	</div> -->

	<!-- Страница "Снабжение предприятий" -->
	<!-- <div id="page_provision_companies" class="page_provision_companies four_pages hidden">
		<div class="blockline">
			<img class="main_img forflex" src="/themes/default/images/page/provision_companies/provision_companies0.png" alt="">
			<h1>Снабжение предприятий</h1>
		</div>
		<div class="blockline">
			<a href="#" class="pos-left btn_plus">
				<span>+</span><p>Как это работает</p>
			</a>
			<div class="container flexwrapp">
				<div class="forflex blockOfText">
					<h4>Рибейт</h4>
					<p>Это когда отдел снабжения получает частичный возврат средств от поставщика.</p>
				</div>
				<div class="forflex"><img src="/themes/default/images/page/provision_companies/provision_companies1.png" alt=""></div>
			</div>
		</div>
		<div class="invisibleblock blockline">
			<div class="flexwrapp three_inline">
				<div class="info_circle forflex">
					<img src="/themes/default/images/page/provision_companies/rebate1.png" alt="">
					<p>Поставщик наценивает товар</p>
				</div>
				<div class="info_circle forflex">
					<img src="/themes/default/images/page/provision_companies/rebate2.png" alt="">
					<p>Вы выделяете бюджет на закупку товара</p>
				</div>
				<div class="info_circle forflex">
					<img src="/themes/default/images/page/provision_companies/rebate3.png" alt="">
					<p>Закупщик получает откат за фильтрацию</p>
				</div>
			</div>
		</div>
		<div class="blockline ">
			<a href="#" class="pos-right btn_plus">
				<span>+</span><p>Как это работает</p>
			</a>
			<div class="container flexwrapp flexWrapReverse">
				<div class="forflex"><img src="/themes/default/images/page/provision_companies/provision_companies2.png" alt=""></div>
				<div class="forflex blockOfText ">
					<h4>Халатность</h4>
					<p>Это когда поставщик использует своё положение для нарушения договора о поставках.</p>
				</div>
			</div>
		</div>
		<div class="invisibleblock">
			<div class="flexwrapp three_inline">
				<div class="info_circle forflex">
					<h5>Скорость</h5>
					<img src="/themes/default/images/page/provision_companies/circle_speed.png" alt="">
					<p>Всегда виноваты курьеры</p>
				</div>
				<div class="info_circle forflex">
					<h5>Качество</h5>
					<img src="/themes/default/images/page/provision_companies/circle_kachestvo.png" alt="">
					<p>Всегда виноват производитель</p>
				</div>
				<div class="info_circle forflex">
					<h5>Цена</h5>
					<img src="/themes/default/images/page/provision_companies/circle_price.png" alt="">
					<p>Всегда виноват курс валют</p>
				</div>
			</div>
		</div>
		<div class="blockline">
			<a href="#" class="pos-left btn_plus">
				<span>+</span><p>Как это работает</p>
			</a>
			<div class="container flexwrapp">
				<div class="forflex blockOfText">
					<h4>Работа с ХT</h4>
					<p>Это когда ценообразование прозрачно, а договор подкреплён репутацией.</p>
				</div>
				<div class="forflex"><img src="/themes/default/images/page/provision_companies/provision_companies3.png" alt=""></div>
			</div>
		</div>
		<div class="invisibleblock">
			<div class="flexwrapp two_inline">
				<div class="info_circle forflex">
					<h5>Скорость</h5>
					<img src="/themes/default/images/page/provision_companies/circle_speed.png" alt="">
					<p>Своя логистика, контракты с крупнейшими перевозчиками. Мы доставляем в срок</p>
				</div>
				<div class="info_circle forflex">
					<h5>Внимательность</h5>
					<img src="/themes/default/images/page/provision_companies/circle_attention.png" alt="">
					<p>Предпродажная подготовка гарантирует отсутствие брака и качественную упаковку</p>
				</div>
			</div>
			<div class="flexwrapp two_inline">
				<div class="info_circle forflex">
					<h5>Клиент-сервис</h5>
					<img src="/themes/default/images/page/provision_companies/circle_comfort.png" alt="">
					<p>Внедрение в предприятие, плановые выезды и удалёное сопровождение 24/7</p>
				</div>
				<div class="info_circle forflex">
					<h5>Бюджет</h5>
					<img src="/themes/default/images/page/provision_companies/circle_money.png" alt="">
					<p>Не только предоставим необходимое по лучшим ценам, но и предложим аналоги еще дешевле</p>
				</div>
			</div>
		</div>
		<div class="blockline flexwrapp flexColumn">
			<button class="forflex mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Загрузить свою смету</button>
			<button class="forflex mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">Перейти к каталогу для предприятий</button>
		</div>
	</div> -->

	<!-- Страница "Контакты" -->
	<!-- <div id="page_contacts" class="page_contacts hidden">
		<div class="blockline">
			<video width="495" height="278" src="/themes/default/images/page/contacts/contacts2.mp4" autoplay loop></video>
			<h1>Контакты</h1>
		</div>
		<div class="blockline flexwrapp">
			<div class="forflex blockOfText">
				<h4>Как связатся с нами</h4>
				<div class="subBlockOfText">
					<p>Отдел продаж:</p>

						<p class="pCenter">(057) 780-38-61</p>
						<p class="pCenter">(099) 563-28-17</p>

						<p class="pCenter">(067) 577-39-07</p>
						<p class="pCenter">(063) 425-91-83</p>



					<p>График роботы:</p>
					<p class="pCenter">Пн-Пт: с 8:00 до 21:00</p>
					<p class="pCenter">Сб: с 8:00 до 20:00</p>
					<p class="pCenter">Вс: с 10:00 до 18:00</p>
					<p>*Заказы, сделанные в нерабочее время вашего менеджера, обрабатываются с началом следующего рабочего дня</p>
				</div>
			</div>
			<div class="forflex">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1282.2924160061052!2d36.29807765817873!3d50.00039271893146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTDCsDAwJzAxLjQiTiAzNsKwMTcnNTcuMCJF!5e0!3m2!1sru!2sru!4v1455287401346"  frameborder="0" style="border:0" allowfullscreen></iframe>
				<p class="pIcon"><i class="material-icons">room</i>г. Харьков, ТЦ Барабашово, Площадка Свояк, Торговое Место 130</p>
			</div>
		</div>
		<div class="blockline">
			<div class="flexwrapp three_inline">
				<div class="info_circle forflex">
					<h5>ПАРТНЕРАМ</h5>
					<img src="/themes/default/images/page/contacts/contacts1.png" alt="">
					<p>Все Ваши пожелания и предложения по сотрудничеству отправляйте на E-mail:</p>
					<p class="pEmail">partner@x-torg.com</p>
				</div>
				<div class="info_circle forflex">
					<h5>ЛОГИСТИКА</h5>
					<img src="/themes/default/images/page/contacts/contacts2.png" alt="">
					<p>Вы хотите предложить нам услуги грузоперевозок </p>
					<p class="pEmail">logistika@x-torg.com</p>
				</div>
				<div class="info_circle forflex">
					<h5>МАРКЕТИНГ</h5>
					<img src="/themes/default/images/page/contacts/contacts3.png" alt="">
					<p>Отдел маркетинга и рекламы</p>
					<p class="pEmail">marketolog@x-torg.com</p>
				</div>
			</div>
		</div>
	</div> -->




	<!-- Страница "Как стать дилером" -->
	<!-- <div id="become_a_dealer" class="become_a_dealer hidden">
		<div class="dealer_line_first  mdl-grid">
			<h4 class="mdl-cell mdl-cell--12-col">Если Вы умеете</h4>
			<ul class="abilities_list mdl-cell mdl-cell--5-col">
				<li>Определять границы территории</li>
				<li>Понимать потребности клиента</li>
				<li>Снабжать торговые точки прайсами</li>
				<li>Собирать заказы</li>
				<li>Доставлять товар</li>
				<li>Правильно расходовать топливо</li>
			</ul>
			<div class="mdl-cell mdl-cell--5-col">
				<img class="car_pic" src="/themes/default/images/page/deliveryCar.png"/ alt="машина xt">
			</div>
		</div>

		<h4>Мы предоставим</h4>

		<div class="services">
			<div class="services_item">
				<p>Ассортимент</p>
				<div class="circleForImg"></div>
			</div>

			<div class="services_item">
				<p>Дилерские цены</p>
				<div class="circleForImg"></div>
			</div>

			<div class="services_item">
				<p>Свободный график</p>
				<div class="circleForImg"></div>
			</div>

			<div class="services_item">
				<p>Бесплатное обучение</p>
				<div class="circleForImg"></div>
			</div>

			<div class="services_item">
				<p>Независимость от склада</p>
				<div class="circleForImg"></div>
			</div>

			<div class="services_item">
				<p>Готовый план действий</p>
				<div class="circleForImg"></div>
			</div>

		</div>
		<button class="mdl-cell mdl-cell--12-col">Присоединяйтесь к нам!</button>
	</div> -->




<script type="text/javascript">
// 	$('.payment_block').click(function (e) {
// 		var target = $('.'+$(this).data('target')),
// 			eq = $(this).index();
// 		if($(this).hasClass('active')){
// 			$('.payment_block').removeClass('active').find('img').css('-webkit-filter', 'grayscale(100%)');
// 			$('[id^="info_text_block_"], .blockforline').addClass('hidden');
// 		}else{
// 			target.removeClass('hidden');
// 			$('.blockforline').removeClass('hidden');
// 			$('[class^="ppp"]').addClass('hidden')
// 			$('.payment_block').removeClass('active').find('img').css('-webkit-filter', 'grayscale(100%)');
// 			$(this).addClass('active');
// 			target.removeClass('hidden')
// 			$(this).find('img').css('-webkit-filter', 'grayscale(0%)');
// 			$(".block1, .block2").css({"left": left2[eq]});
// 		}
// 	});
</script>









<!--<script type="text/javascript">
		$(document).ready(function () {
			var left = {
				0: '18%',
				1: '48%',
				2: '77%'
			}
			var left2 = {
				0: '15%',
				1: '37%',
				2: '58%',
				3: '80%'
			}
			$('.info_block').click(function (e) {
				var target = $('.'+$(this).data('target')),
					eq = $(this).index();
				if($(this).hasClass('active')){
					$('.info_block').removeClass('active').find('img').css('-webkit-filter', 'grayscale(100%)');
					$('[id^="info_text_block_"], .blockforline').addClass('hidden');
				}else{
					target.removeClass('hidden');
					$('.blockforline').removeClass('hidden');
					$('[class^="ppp"]').addClass('hidden')
					$('.info_block').removeClass('active').find('img').css('-webkit-filter', 'grayscale(100%)');
					$(this).addClass('active');
					target.removeClass('hidden')
					$(this).find('img').css('-webkit-filter', 'grayscale(0%)');
					$(".block1, .block2").css({"left": left[eq]});
				}
					// $(".block2").css({"left": left[eq]});
			});

			$('.a_question').click(function(event) {
				openObject('question');
			});

			$('.payment_block').click(function (e) {
				var target = $('.'+$(this).data('target')),
					eq = $(this).index();
				if($(this).hasClass('active')){
					$('.payment_block').removeClass('active').find('img').css('-webkit-filter', 'grayscale(100%)');
					$('[id^="info_text_block_"], .blockforline').addClass('hidden');
				}else{
					target.removeClass('hidden');
					$('.blockforline').removeClass('hidden');
					$('[class^="ppp"]').addClass('hidden')
					$('.payment_block').removeClass('active').find('img').css('-webkit-filter', 'grayscale(100%)');
					$(this).addClass('active');
					target.removeClass('hidden')
					$(this).find('img').css('-webkit-filter', 'grayscale(0%)');
					$(".block1, .block2").css({"left": left2[eq]});
				}
					// $(".block2").css({"left": left[eq]});
			});

			var posBasic = 0;
			// Для страницы "Поставки магазинам"
			$('.btn_plus').click(function (e){
				e.preventDefault();
				var target = $(this).closest('.blockline').next(),
					contentCenter = posBasic;
				if($(this).hasClass('active')){
					target.slideUp();
					$(this).removeClass('active');
				}else{
					if($(this).hasClass('pos-right')){
						posBasic = $(this).css('right');
					}else{
						posBasic = $(this).css('left');
					}
					target.slideDown();
					$(this).addClass('active');
					$('html, body').stop().animate({
						'scrollTop': target.offset().top - ($('header').outerHeight()*1.5 + $(this).find('span').outerHeight())
					}, 900);
					contentCenter = $("#content").width()/2 - $(this).find('span').width()/2;
				}
				console.log(posBasic);
				if($(this).hasClass('pos-right')){
					$(this).css({
						'right': contentCenter
					});
				}else{
					$(this).css({
						'left': contentCenter
					});
				}
			});
			// $('.btn_plus').click(function (e) {
			// 	e.preventDefault();
			// 	var target = $($(this).data('target')),
			// 		halfDocWidth = ($("#content").width())/2,
			// 		halfaWidth = ($(this).width())/2,
			// 		contentCenter = halfDocWidth - halfaWidth;
			// 		// console.log(halfDocWidth);
			// 		// console.log(halfaWidth);
			// 		// console.log(contentCenter);
			// 	$(".btn_plus p").hide();
			//   	if ($(this).hasClass('active')) {
			// 		target.stop(true, true).slideUp();
			// 		if ($(document).width() > 1535) {
			// 			$(this).animate({
			// 				top: '-=120',
			// 				left: 0,
			// 				// left: 'calc(50% - 24px)',
			// 			}, 500, function() {
			// 				// $(this).css('transform', 'rotate(0deg)');
			// 				$(".btn_plus p").show();
			// 			});
			// 		}else {
			// 			$(this).animate({
			// 				top: '-=100',
			// 				left: '-=contentCenter',
			// 			}, 500, function() {
			// 				// $(this).css('transform', 'rotate(0deg)');
			// 				$(".btn_plus p").show();
			// 			});
			// 		}
			// 		$(this).removeClass('active');
			// 		// $(this).css('transform', 'rotate(0deg)');
			//   } else {
			// 	target.stop(true, true).slideDown("slow");
			// 	if ($(document).width() > 1535) {
			// 		$(this).animate({
			// 			top: '+=120',
			// 			// left: 'calc(50% - 24px)',
			// 			left: contentCenter,
			// 		}, 500, function() {
			// 			// $(this).css('transform', 'rotate(45deg)');
			// 		});
			// 	}else {
			// 		$(this).animate({
			// 			top: '+=100',
			// 			left: '+=contentCenter',
			// 		}, 500, function() {
			// 			// $(this).css('transform', 'rotate(45deg)');
			// 		});
			// 	}
			// 	$(this).addClass('active');
			// 	// $(this).css('transform', 'rotate(45deg)');
			//   }
			// });

			// $('a[href^="#"]').bind('click.smoothscroll',function (e) {
			// 	e.preventDefault();

			// 	// var target = $(this.hash);
			// 	// $('html, body').stop().animate({
			// 	// 	'scrollTop': target.offset().top - ($('header').outerHeight()*2 + 15)
			// 	// }, 900, 'swing');
			// });



			/// для анимации кнопки

			// $(this).animate({
			// 	    left: '+=500',
			// 	  }, 1000, function() {
			// 	    // Закончили анимацию.
			// 	  });


			// $('#infoBlock1').click(function (e) {
			//     $('#infoBlock1').removeClass('hidden');
			//      	$('#infoBlock1 img').css('-webkit-filter', 'grayscale(0%)');
			//      	$('#infoBlock2 img').css('-webkit-filter', 'grayscale(100%)');
			//      	$('#infoBlock3 img').css('-webkit-filter', 'grayscale(100%)');
			//     $('#info_text_block_service').removeClass('hidden');
			//     $('#info_text_block_answers').addClass('hidden');
			//     $('#info_text_block_delivery').addClass('hidden');
			//     	$(".block1").animate({"left": "18%"}, "slow");
			//     	$(".block2").animate({"left": "18%"}, "slow");
			// });
			// $('#infoBlock2').click(function (e) {
			//     $('.blockforline').removeClass('hidden');
			//     	$('#infoBlock2 img').css('-webkit-filter', 'grayscale(0%)');
			//     	$('#infoBlock1 img').css('-webkit-filter', 'grayscale(100%)');
			//     	$('#infoBlock3 img').css('-webkit-filter', 'grayscale(100%)');
			//     $('#info_text_block_answers').removeClass('hidden');
			//     $('#info_text_block_service').addClass('hidden');
			//     $('#info_text_block_delivery').addClass('hidden');
			//     	$(".block1").animate({"left": "48%"}, "slow");
			//     	$(".block2").animate({"left": "48%"}, "slow");
			// });
			// $('#infoBlock3').click(function (e) {
			//     $('.blockforline').removeClass('hidden');
			//     	$('#infoBlock3 img').css('-webkit-filter', 'grayscale(0%)');
			//     	$('#infoBlock1 img').css('-webkit-filter', 'grayscale(100%)');
			//     	$('#infoBlock2 img').css('-webkit-filter', 'grayscale(100%)');
			//     $('#info_text_block_delivery').removeClass('hidden');
			//     $('#info_text_block_service').addClass('hidden');
			//     $('#info_text_block_answers').addClass('hidden');
			//     	$(".block1").animate({"left": "77%"}, "slow");
			//     	$(".block2").animate({"left": "77%"}, "slow");
			// });
			// $(':not(.info_block)').click(function (e) {
			// 	$('#infoBlock1 img').css('-webkit-filter', 'grayscale(100%)');
			// 	$('#infoBlock2 img').css('-webkit-filter', 'grayscale(100%)');
			// 	$('#infoBlock3 img').css('-webkit-filter', 'grayscale(100%)');
			// });
		});
	</script> -->

</div><!--id="content"-->

