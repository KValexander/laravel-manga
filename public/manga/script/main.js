var out, css;

// Добавление заднего фона, в случае наличия
// =========================================
function background_image(url) {
	$("body").css("background", "url('" + url + "') #FFF fixed top center no-repeat");
	$("body").css("background-size", "cover");

	$("div#mask").html(`<div class = "background_mask"></div>`);
	css = `
		<style>
			div.background_mask {
			    top: 0;
			    left: 0;
			    opacity: 0.5;
			    position: fixed;
			    z-index: -1;
			    width: 100%;
			    height: 100%;
			    background: url('https://anivisual.net/img/pat1.png');
			}
		</style>
	`;
	$(".background_mask").html(css);
}

// Вызов сообщения
// =================
function call_message(message) {
	out = `
		<div class = "message">
			<h3>${message}</h3>
			<p><input type="button" value = "Закрыть" onclick = "callback_message()"></p>
		</div>
	`;
	css = `
		<style>
			div.message {
				display: none;
				background: white;
				width:400px;
				min-height:100px;
				position: fixed;
				padding: 20px;
				z-index: 100;
				top:50%;
				left:50%;
				margin:-200px 0 0 -200px;
				border: solid 1px black;
				text-align: center;
			}
			div.message h3 {
				margin: 20px 0 30px 0;
			}
		</style>
	`;
	$("div#message").html(out).append(css);
	$("div.message").fadeIn(100);
	$('div.message').css({margin:'-'+($('div.message').height() / 2)+'px 0 0 -'+($('div.message').width() / 2)+'px'});
}

function callback_message(message) {
	$("div.message").fadeOut(100);
	$("div#message").html("");
}

// Вызов увеличенного изображения
// ================================
function call_image(url) {
	out = `
		<div class = "increase_img" onclick="callback_image()" onmouseleave="callback_image()"><img src="${url}" alt="${url}"></div>
		<div class="increase_img_overlay" onclick="callback_image()"></div>
	`;
	css = `
		<style>
			div.increase_img {
				position: fixed;
				display: none;
				padding: 5px;
				min-width: 20vh;
				max-width: 65vh;
				background: #252b37;
				min-height: 10px;
				top: 50%;
				left: 50%;
				text-align: center;
				border-radius: 5px;
				z-index: 101;
			}
			div.increase_img_overlay{
			  display: none;
			  background: rgba(0,0,0,.5);
			  width: 100%;
			  height: 100%;
			  position: fixed;
			  top: 0;
			  left: 0;
			  z-index: 1;
			}
			div.increase_img img {
				margin: 0;
				padding: 0;
				width: 100%;
			}
		</style>
	`;
	$("div#image").append(out).append(css);

	$("div.increase_img_overlay").fadeIn(300);
	$("div.increase_img").fadeIn(300, function() {
		$("div.increase_img").css("display", "block");
	});
	setTimeout(function() {
		$('div.increase_img').css({margin:'-'+($('div.increase_img').height() / 2)+'px 0 0 -'+($('div.increase_img').width() / 2)+'px'});
	}, 30);
}
function callback_image() {
	$("div.increase_img_overlay").fadeOut(300);
	$("div.increase_img").fadeOut(300, function() {
		$("div.increase_img").css("display", "none");
		$("div#image").html("");
	});
}