$(document).ready(function() {
	var array = [
		'Make sure to share this site with your friends!',
		'Will code for experience!', 
		'Coded this website in HTML & CSS! (And Javascript)'
	]
	var number = Math.floor(Math.random() * array.length);	
	$('figcaption').append(array[number]);
});