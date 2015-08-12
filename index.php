<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Shakespear Monkey</title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/styles.css" />

	</head>
	<body>
		
		<div id="main" class="fluid-container">
			<div class="row">
				
				<div id="info" class="col-md-4 col-md-push-8">
					
					<div id="monkey">
						<img src="img/monkey.jpg"/>
					</div>
					
				</div>
			
				<div id="content" class="col-md-8 col-md-pull-4">
					<div id="page-1" class="page">
						
						<h1>Shakespear Monkey</h1>
						<h2>One day, this Monkey will write Hamlet ! <small>Maybe...</small></h2>
						
					</div>
				</div>
				
			</div>
		</div>
		
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script>
			
			// Initialisation
			$(document).ready(function(){
				
				var current_page = $('#page-1');
				var count_page = 1;
				var current_paragraph = null;
				var count_letter = 0;
				
				// Init
				resizeA4();
				write();
				
				// On Resize
				window.onresize = function(){
					resizeA4();
				};
			
				function write() {
					
					if(sheetIsFull(current_page)) {
						count_page++;
						current_page = $('<div>', {'class':'page', 'id':'page-'+count_page});
						current_paragraph = null;
						$('#content').append(current_page);
						resizeA4();
					}
					
					if(current_paragraph === null) {
						current_paragraph = $('<p>');
						var css_ratio = current_page.width() / 1000;
						current_paragraph.css('font-size', (120 * css_ratio)+'%').css('margin', '0 0 '+(15 * css_ratio)+'px 0');
						current_page.append(current_paragraph);
					}
					
					
					if(Math.random() < (0.02/1000*current_paragraph.text().length))
					{
						current_paragraph = null;
					} else {
						
						var letters = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz-\'';
						var ponctuation = '              .:,;!?';
						var letter = '';
						
						if(Math.random() < (0.2/20*count_letter)) {
							letter = ponctuation[Math.round(Math.random()*ponctuation.length)];
							if(letter != ' ') letter += ' ';
							count_letter = 0;
						} else {
							letter = letters[Math.round(Math.random()*letters.length)];
						}
						
						current_paragraph.text(current_paragraph.text()+letter);
						count_letter++;
					}
					
					setTimeout(function(){
						write();
					}, Math.random()*(300 - 100) + 100);
				}
				
				function sheetIsFull(page)
				{
					var total_height = 0;
					total_height += parseFloat($(page).css('padding-top'));
					total_height += parseFloat($(page).css('padding-bottom'));
					page.find('> *').each(function(){
						total_height += $(this).height();
						total_height += parseFloat($(this).css('margin-top'));
						total_height += parseFloat($(this).css('margin-bottom'));
					});
					
					console.log(total_height);
					
					return total_height > page.height();
				}
				
				function resizeA4()
				{
					var ratio = 42.0 / 29.7;
					$('.page').each(function(){
						$(this).height($(this).width() * ratio);
						var css_ratio = $(this).width() / 1000;
						$(this).find('h1').css('font-size', (330 * css_ratio)+'%').css('margin', '0 0 '+(20 * css_ratio)+'px 0');
						$(this).find('h2').css('font-size', (170 * css_ratio)+'%').css('margin', '0 0 '+(15 * css_ratio)+'px 0');
						$(this).find('p').css('font-size', (120 * css_ratio)+'%').css('margin', '0 0 '+(15 * css_ratio)+'px 0');
						$(this).css('padding', (80 * css_ratio)+'px '+(60 * css_ratio)+'px');
					});
				}
				
			});
			
		</script>
		
	</body>
</html>