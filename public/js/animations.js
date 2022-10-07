
window.addEventListener('refresh', function()
{
	let i = 0;
	var book = document.querySelectorAll('.card')[0];

	while (book = document.querySelectorAll('.card')[i])
	{
		var altura = window.innerHeight;
		var distancia = book.getBoundingClientRect().top;

		book.classList.add('appear');
		
		book.classList.remove('appear');
		i++;
	}
})

//Fade Scroll Books Animations
window.addEventListener('scroll', function()
{
	let i = 0;
	var img = document.querySelectorAll('.card')[0];

	while (img = document.querySelectorAll('.card')[i])
	{
		var altura = window.innerHeight;
		var distancia = img.getBoundingClientRect().top;

		if (distancia < altura)
		img.classList.add('appear');
		else
		img.classList.remove('appear');
		i++;
	}
})
