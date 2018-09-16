<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="匹配问卷" />
<title>匹配度调查</title>
<link href="css/questionnaire.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery.min.js"></script>
</head>
<body>
<div id="container">
	<h1 id="h1Title">匹配度调查问卷</h1>
	<div id="surveydescription">
		<span>亲爱的各位用户：<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;这是由山东大学（威海）乐行青春调研团发起的项目--填写问卷有利于用户之间互相了解，营造一个良好的约伴游平台，需要你我的共同努力。</span>
	</div>
	<form action="send_questionnaire.php" method="get" id="fieldset" class="fieldset">
		<div class="question">
			<h4 class="title">Q1.你的睡眠水平是几级？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q1_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q1" id="q1_1" value="1" class="magic-radio"/>
						<label for="q1_1">突然开灯就会醒</label>
					</li>
					<li>
						<input type="radio" name="q1" id="q1_2" value="2" class="magic-radio"/>
						<label for="q1_2">有细微的声音就会醒</label>
					</li>
					<li>
						<input type="radio" name="q1" id="q1_3" value="3" class="magic-radio"/>
						<label for="q1_3">手机震动几下就会醒</label>
					</li>
					<li>
						<input type="radio" name="q1" id="q1_4" value="4" class="magic-radio"/>
						<label for="q1_4">手机铃声加震动都不会醒，基本睡着了就接不到电话</label>
					</li>
					<li>
						<input type="radio" name="q1" id="q1_5" value="5" class="magic-radio"/>
						<label for="q1_5">楼上装修也吵不醒</label>
					</li>
					<li>
						<input type="radio" name="q1" id="q1_6" value="6" class="magic-radio"/>
						<label for="q1_6">被猫在胸口踩来踩去，最后一屁股坐在脸上都不醒</label>
					</li>
					<li>
						<input type="radio" name="q1" id="q1_7" value="7" class="magic-radio"/>
						<label for="q1_7">基本上只要睡着以后，被人抬走了都没知觉</label>
					</li>
					
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q2.在卫生方面，你觉得自己是个什么样的人？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q2_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q2" id="q2_1" value="1" class="magic-radio"/>
						<label for="q2_1">可以说是非常平易近人了，单单是让别人不嫌弃我已经是耗尽全力，逍遥自在没啥讲究</label>
					</li>
					<li>
						<input type="radio" name="q2" id="q2_2" value="2" class="magic-radio"/>
						<label for="q2_2">能接受好朋友吃过的食物，卫生要堆到不行了才会打扫，衣服要攒多了一起洗</label>
					</li>
					<li>
						<input type="radio" name="q2" id="q2_3" value="3" class="magic-radio"/>
						<label for="q2_3">对于卫生不是特别在意，能接受一周洗一次衣服以及认识的人用自己的杯子等私人物品</label>
					</li>
					<li>
						<input type="radio" name="q2" id="q2_4" value="4" class="magic-radio"/>
						<label for="q2_4">定期打扫卫生，头油不油都按时洗，能记得经常换床单，衣服即使不太脏，也会及时清洗</label>
					</li>
					<li>
						<input type="radio" name="q2" id="q2_5" value="5" class="magic-radio"/>
						<label for="q2_5">不吃朋友甚至家人咬过的水果，挺介意别人碰自己的东西，特别是床上用品，出门住酒店也会觉得不卫生，不喜欢吃外面的东西</label>
					</li>
					<li>
						<input type="radio" name="q2" id="q2_6" value="6" class="magic-radio"/>
						<label for="q2_6">会习惯性的清洁，擦拭自己要用的东西，甚至会用酒精，觉得地毯很脏，与亲近的人相处时也会因为对方的卫生习惯而感到膈应，每天会多次洗手甚至洗澡</label>
					</li>
					<li>
						<input type="radio" name="q2" id="q2_7" value="7" class="magic-radio"/>
						<label for="q2_7">有洁癖，自己苛刻的卫生习惯已经对生活造成了一定的困扰</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q3.如果你在物质方面存在洁癖，那你的洁癖程度是怎样的？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q3_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q3" id="q3_1" value="1" class="magic-radio"/>
						<label for="q3_1">硬币和笔掉地上会捡起来用水冲，或者用纸巾沾水擦</label>
					</li>
					<li>
						<input type="radio" name="q3" id="q3_2" value="2" class="magic-radio"/>
						<label for="q3_2">避免碰到蚊子、飞蛾等间接污染源</label>
					</li>
					<li>
						<input type="radio" name="q3" id="q3_3" value="3" class="magic-radio"/>
						<label for="q3_3">洗完手关水龙头时另一手会提前接水，等关完水后往碰了水龙头的那只手上浇，不喜欢洗干净的手马上碰其它东西，开门的话用手肘开</label>
					</li>
					<li>
						<input type="radio" name="q3" id="q3_4" value="4" class="magic-radio"/>
						<label for="q3_4">觉得垃圾桶和抽水马桶的空气会飞到脸上头发上手上胳膊上超级恶心</label>
					</li>
					<li>
						<input type="radio" name="q3" id="q3_5" value="5" class="magic-radio"/>
						<label for="q3_5">觉得鞋子踩在地上都是不干净的</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q4.你觉得自己是个什么样的人？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q4_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q4" id="q4_1" value="1" class="magic-radio"/>
						<label for="q4_1">很善于帮助他们了解自己的情绪</label>
					</li>
					<li>
						<input type="radio" name="q4" id="q4_2" value="2" class="magic-radio"/>
						<label for="q4_2">会帮助朋友做符合逻辑的决定</label>
					</li>
					<li>
						<input type="radio" name="q4" id="q4_3" value="3" class="magic-radio"/>
						<label for="q4_3">对生活和工作充满热忱，有很多想法且很有灵性</label>
					</li>
					<li>
						<input type="radio" name="q4" id="q4_4" value="4" class="magic-radio"/>
						<label for="q4_4">心思细腻，完美精确，而且为人可靠</label>
					</li>
					<li>
						<input type="radio" name="q4" id="q4_5" value="5" class="magic-radio"/>
						<label for="q4_5">关心别人永远多过关心自己，患得患失</label>
					</li>
					<li>
						<input type="radio" name="q4" id="q4_6" value="6" class="magic-radio"/>
						<label for="q4_6">热情助人，积极行善，遇到聊得来的人会将自己的心事和过去全盘脱出</label>
					</li>
					<li>
						<input type="radio" name="q4" id="q4_7" value="7" class="magic-radio"/>
						<label for="q4_7">为人比较冷淡，对方不主动，自己也不会主动，无论是在交流还是其他方面</label>
					</li>
					<li>
						<input type="radio" name="q4" id="q4_8" value="8" class="magic-radio"/>
						<label for="q4_8">喜欢一个人独处，不习惯和陌生人交流</label>
					</li>
					<li>
						<input type="radio" name="q4" id="q4_9" value="9" class="magic-radio"/>
						<label for="q4_9">很热情的愿意与别人分享自己的所获所得</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q5.在日常生活中，对一些要做的事，你通常是怎样的？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q5_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q5" id="q5_1" value="1" class="magic-radio"/>
						<label for="q5_1">能清楚的记得并做出计划，然后付诸行动</label>
					</li>
					<li>
						<input type="radio" name="q5" id="q5_2" value="2" class="magic-radio"/>
						<label for="q5_2">清楚的记得，但是由于拖延症等等通常选择不去实施</label>
					</li>
					<li>
						<input type="radio" name="q5" id="q5_3" value="3" class="magic-radio"/>
						<label for="q5_3">看事情的重要性有选择性的忘记</label>
					</li>
					<li>
						<input type="radio" name="q5" id="q5_4" value="4" class="magic-radio"/>
						<label for="q5_4">常会忘记，但在重要的事情上毫不含糊</label>
					</li>
					<li>
						<input type="radio" name="q5" id="q5_5" value="5" class="magic-radio"/>
						<label for="q5_5">不管事情有多重要，只有在别人提醒的情况下才能想起</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q6.在人际交往时，你更倾向于？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q6_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q6" id="q6_1" value="1" class="magic-radio"/>
						<label for="q6_1">你希望在人际关系中占主导地位，常常引导话题或者活动的举办和进行等</label>
					</li>
					<li>
						<input type="radio" name="q6" id="q6_2" value="2" class="magic-radio"/>
						<label for="q6_2">顺其自然，不温不火，相对被动</label>
					</li>
					<li>
						<input type="radio" name="q6" id="q6_3" value="3" class="magic-radio"/>
						<label for="q6_3">希望交往的双方是平等的，处于相同地位</label>
					</li>
					<li>
						<input type="radio" name="q6" id="q6_4" value="4" class="magic-radio"/>
						<label for="q6_4">处于被动的一方，没有主见，不喜欢自己做决定</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q7.在旅游的过程中，你更倾向于？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q7_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q7" id="q7_1" value="1" class="magic-radio"/>
						<label for="q7_1">喜欢拍照留念，捕捉生命中的精彩点滴</label>
					</li>
					<li>
						<input type="radio" name="q7" id="q7_2" value="2" class="magic-radio"/>
						<label for="q7_2">探寻生命中的真谛和意义，认为旅行就是丰富人生</label>
					</li>
					<li>
						<input type="radio" name="q7" id="q7_3" value="3" class="magic-radio"/>
						<label for="q7_3">认为旅行就是享受生活，能放松就怎么舒服怎么来</label>
					</li>
					<li>
						<input type="radio" name="q7" id="q7_4" value="4" class="magic-radio"/>
						<label for="q7_4">旅行依旧是生活和工作的一部分，尽可能的将其与自己的学习与生活联系起来，进而学习一个新的知识和领域</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q8.如果你打算出游，但是没有决定要去哪儿，那你更倾向于什么样的旅游目的地？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q8_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q8" id="q8_1" value="1" class="magic-radio"/>
						<label for="q8_1">充满民俗风情的小镇</label>
					</li>
					<li>
						<input type="radio" name="q8" id="q8_2" value="2" class="magic-radio"/>
						<label for="q8_2">人文气息浓厚的城市（博物馆，科技馆，艺术馆，古建筑等）</label>
					</li>
					<li>
						<input type="radio" name="q8" id="q8_3" value="3" class="magic-radio"/>
						<label for="q8_3">充满商业气息的现代化大都市</label>
					</li>
					<li>
						<input type="radio" name="q8" id="q8_4" value="4" class="magic-radio"/>
						<label for="q8_4">保留着古代建筑的静谧小城（胡同，小巷）</label>
					</li>
					<li>
						<input type="radio" name="q8" id="q8_5" value="5" class="magic-radio"/>
						<label for="q8_5">有着大自然的神奇创造的自然风光景区</label>
					</li>
					<li>
						<input type="radio" name="q8" id="q8_6" value="6" class="magic-radio"/>
						<label for="q8_6">以美食而闻名的城市</label>
					</li>
					<li>
						<input type="radio" name="q8" id="q8_7" value="7" class="magic-radio"/>
						<label for="q8_7">有着朴素而热情的居民，能充分放松自己的地方</label>
					</li>
					<li>
						<input type="radio" name="q8" id="q8_8" value="8" class="magic-radio"/>
						<label for="q8_8">少数名族聚居地，体验不一样的文化和风俗习惯</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q9.出去旅游你更喜欢与什么样的人一起？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_checkbox_group" id="q9_div">
				<ul class="ul_checkbox_group">
					<li>
						<input type="checkbox" name="q9[]" id="q9_1" value="1" class="magic-checkbox"/>
						<label for="q9_1">比较喜欢和爱拍照，爱摄影的人一起出去</label>
					</li>
					<li>
						<input type="checkbox" name="q9[]" id="q9_2" value="2" class="magic-checkbox"/>
						<label for="q9_2">能聊天的， 不要闷着这不要那不要的人</label>
					</li>
					<li>
						<input type="checkbox" name="q9[]" id="q9_3" value="3" class="magic-checkbox"/>
						<label for="q9_3">喜欢吃，可以为了吃东西跑远路的</label>
					</li>
					<li>
						<input type="checkbox" name="q9[]" id="q9_4" value="4" class="magic-checkbox"/>
						<label for="q9_4">和随和的人，因为喜欢自己安排事情</label>
					</li>
					<li>
						<input type="checkbox" name="q9[]" id="q9_5" value="5" class="magic-checkbox"/>
						<label for="q9_5">喜欢和比较玩的开的，爽快，大大咧咧，不在意细节的人</label>
					</li>
					<li>
						<input type="checkbox" name="q9[]" id="q9_6" value="6" class="magic-checkbox"/>
						<label for="q9_6">喜欢和很有主见的，细心的人</label>
					</li>
					<li>
						<input type="checkbox" name="q9[]" id="q9_7" value="7" class="magic-checkbox"/>
						<label for="q9_7">能有共同话题，聊得来，比较合拍的人</label>
					</li>
					<li>
						<input type="checkbox" name="q9[]" id="q9_8" value="8" class="magic-checkbox"/>
						<label for="q9_8">没有特殊要求，只要对的上眼都可以</label>
					</li>
					<li>
						<input type="checkbox" name="q9[]" id="q9_9" value="9" class="magic-checkbox"/>
						<label for="q9_9">有共同兴趣爱好</label>
					</li>
					<li>
						<input type="checkbox" name="q9[]" id="q9_10" value="10" class="magic-checkbox"/>
						<label for="q9_10">能合理安排路线，并做好一切安排，自己不用担心路途以及住宿问题</label>
					</li>
					<li>
						<input type="checkbox" name="q9[]" id="q9_11" value="11" class="magic-checkbox"/>
						<label for="q9_11">和方向感好的人</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q10.在你旅游的过程中，你更倾向于去什么样的地方玩？或者更倾向于参观什么地方？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q10_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q10" id="q10_1" value="1" class="magic-radio"/>
						<label for="q10_1">历史遗迹，博物馆之类</label>
					</li>
					<li>
						<input type="radio" name="q10" id="q10_2" value="2" class="magic-radio"/>
						<label for="q10_2">美术馆，艺术展览厅等</label>
					</li>
					<li>
						<input type="radio" name="q10" id="q10_3" value="3" class="magic-radio"/>
						<label for="q10_3">音乐会，演唱会等</label>
					</li>
					<li>
						<input type="radio" name="q10" id="q10_4" value="4" class="magic-radio"/>
						<label for="q10_4">主题公园，欢乐谷，游乐场等</label>
					</li>
					<li>
						<input type="radio" name="q10" id="q10_5" value="5" class="magic-radio"/>
						<label for="q10_5">商场，美食街，酒吧娱乐场所等</label>
					</li>
					<li>
						<input type="radio" name="q10" id="q10_6" value="6" class="magic-radio"/>
						<label for="q10_6">自然风景区，动植物保护区（海洋馆，动物园）</label>
					</li>
					<li>
						<input type="radio" name="q10" id="q10_7" value="7" class="magic-radio"/>
						<label for="q10_7">野外探险</label>
					</li>
					
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q11.你最讨厌别人做什么事？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q11_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q11" id="q11_1" value="1" class="magic-radio"/>
						<label for="q11_1">不尊重别人的作息</label>
					</li>
					<li>
						<input type="radio" name="q11" id="q11_2" value="2" class="magic-radio"/>
						<label for="q11_2">迟到，不守信用</label>
					</li>
					<li>
						<input type="radio" name="q11" id="q11_3" value="3" class="magic-radio"/>
						<label for="q11_3">做任何事情都高高在上，以自我为中心</label>
					</li>
					<li>
						<input type="radio" name="q11" id="q11_4" value="4" class="magic-radio"/>
						<label for="q11_4">对任何事情和物品都非常挑剔</label>
					</li>
					<li>
						<input type="radio" name="q11" id="q11_5" value="5" class="magic-radio"/>
						<label for="q11_5">蹭吃蹭喝</label>
					</li>
					<li>
						<input type="radio" name="q11" id="q11_6" value="6" class="magic-radio"/>
						<label for="q11_6">铺张浪费</label>
					</li>
					<li>
						<input type="radio" name="q11" id="q11_7" value="7" class="magic-radio"/>
						<label for="q11_7">不爱护环境，乱丢垃圾等</label>
					</li>
					
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q12.你的宗教信仰是？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q12_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q12" id="q12_1" value="1" class="magic-radio"/>
						<label for="q12_1">伊斯兰教</label>
					</li>
					<li>
						<input type="radio" name="q12" id="q12_2" value="2" class="magic-radio"/>
						<label for="q12_2">基督教</label>
					</li>
					<li>
						<input type="radio" name="q12" id="q12_3" value="3" class="magic-radio"/>
						<label for="q12_3">佛教</label>
					</li>
					<li>
						<input type="radio" name="q12" id="q12_4" value="4" class="magic-radio"/>
						<label for="q12_4">其他</label>
					</li>
					<li>
						<input type="radio" name="q12" id="q12_5" value="5" class="magic-radio"/>
						<label for="q12_5">无</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q13.你这次旅行的预计消费？（除去交通费用）</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q13_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q13" id="q13_1" value="1" class="magic-radio"/>
						<label for="q13_1">100到200每天</label>
					</li>
					<li>
						<input type="radio" name="q13" id="q13_2" value="2" class="magic-radio"/>
						<label for="q13_2">200到300每天</label>
					</li>
					<li>
						<input type="radio" name="q13" id="q13_3" value="3" class="magic-radio"/>
						<label for="q13_3">300到400每天</label>
					</li>
					<li>
						<input type="radio" name="q13" id="q13_4" value="4" class="magic-radio"/>
						<label for="q13_4">400及以上每天</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q14.你的饮食习惯是？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q14_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q14" id="q14_1" value="1" class="magic-radio"/>
						<label for="q14_1">无辣不欢</label>
					</li>
					<li>
						<input type="radio" name="q14" id="q14_2" value="2" class="magic-radio"/>
						<label for="q14_2">甜食党</label>
					</li>
					<li>
						<input type="radio" name="q14" id="q14_3" value="3" class="magic-radio"/>
						<label for="q14_3">盐党</label>
					</li>
					<li>
						<input type="radio" name="q14" id="q14_4" value="4" class="magic-radio"/>
						<label for="q14_4">口味偏淡</label>
					</li>
					<li>
						<input type="radio" name="q14" id="q14_5" value="5" class="magic-radio"/>
						<label for="q14_5">口味适中</label>
					</li>
					<li>
						<input type="radio" name="q14" id="q14_6" value="6" class="magic-radio"/>
						<label for="q14_6">不挑食</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q15.你偏向选择哪种住宿类型？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q15_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q15" id="q15_1" value="1" class="magic-radio"/>
						<label for="q15_1">野营地</label>
					</li>
					<li>
						<input type="radio" name="q15" id="q15_2" value="2" class="magic-radio"/>
						<label for="q15_2">青旅（单双人间）</label>
					</li>
					<li>
						<input type="radio" name="q15" id="q15_3" value="3" class="magic-radio"/>
						<label for="q15_3">青旅（合宿）（男女混宿）</label>
					</li>
					<li>
						<input type="radio" name="q15" id="q15_4" value="4" class="magic-radio"/>
						<label for="q15_4">民宿/家庭旅馆</label>
					</li>
					<li>
						<input type="radio" name="q15" id="q15_5" value="5" class="magic-radio"/>
						<label for="q15_5">经济型酒店</label>
					</li>
					<li>
						<input type="radio" name="q15" id="q15_6" value="6" class="magic-radio"/>
						<label for="q15_6">酒店式公寓</label>
					</li>
					</li>
					<li>
						<input type="radio" name="q15" id="q15_7" value="7" class="magic-radio"/>
						<label for="q15_7">五星级酒店</label>
					</li>
				</ul>
			</div>
		</div>
		<div class="question">
			<h4 class="title">Q16.你认为你是一个什么样的人？</h4>
			<span class="required">&nbsp;*</span>
			<div class="div_ul_radio_group" id="q16_div">
				<ul class="ul_radio_group">
					<li>
						<input type="radio" name="q16" id="q16_1" value="1" class="magic-radio"/>
						<label for="q16_1">热心助人，比较尊重别人的意见</label>
					</li>
					<li>
						<input type="radio" name="q16" id="q16_2" value="2" class="magic-radio"/>
						<label for="q16_2">以自我为中心，不太会考虑别人的感受</label>
					</li>
					<li>
						<input type="radio" name="q16" id="q16_3" value="3" class="magic-radio"/>
						<label for="q16_3">比较随和，凡事好商量</label>
					</li>
				</ul>
			</div>
		</div>
		
		
		<!--......-->
		<div id="button_container">
			<button id="bt">提交</button>
		<div/>
		<script type="text/javascript">
			//检查必填项是否完成，有BUG，复选框的再次选中可以
			$(document).ready(function() {
				//第i题未选中，则isCheck[i]=0;反之为1
				var isCheck = [0,0,0,0,0,0,0,0,0,0,0,0,0];
				$("#bt").click(function(){
					var isBreak=false;
					for(i=0;i<13;i++){
						if(i==2){		//非必填项目
							continue;
						}
						
						if(isCheck[i]!=1)	//某一项未填
						{	
							var arr = document.getElementsByClassName("question");
							if(arr[i].classList.toString().indexOf("error")==-1)
								arr[i].classList.add("error");
						}
						else{
							var arr = document.getElementsByClassName("question");
							
								arr[i].classList.remove("error");
							
							
						}	
					}
					for(i=0;i<13;i++){
						if(i==2)		//跳过非必填
							continue;
						if(isCheck[i]!=1){
							isBreak=true;
							break;
						}
					}
					if(isBreak==true){
						return false;
					}
				});
				
				$("input").click(function(){
					var num = $(this).attr("name").replace("[]","");
					num = num.substr(1,num.length);
					isCheck[num-1] = 1;
				});
				
				
			});
		</script>
		
		<div class="clear"></div>
	</form>
	
	<div id="copyright">
		<span>乐行青春</span>
	</div>
</div>
</body>
</html>
